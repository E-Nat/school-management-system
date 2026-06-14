<?php
require_once 'config.php';
require_once 'functions.php';

// Get webhook payload
$input = file_get_contents('php://input');
$payload = json_decode($input, true);

if (!$payload) {
    logMessage("Invalid webhook payload", "ERROR");
    http_response_code(400);
    exit('Invalid payload');
}

// Determine webhook source (GitHub or GitLab)
$isGitHub = isset($_SERVER['HTTP_X_GITHUB_EVENT']);
$isGitLab = isset($_SERVER['HTTP_X_GITLAB_EVENT']);

if (!$isGitHub && !$isGitLab) {
    logMessage("Unknown webhook source", "ERROR");
    http_response_code(400);
    exit('Unknown source');
}

// Verify webhook secret
if ($isGitHub) {
    $signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
    $secret = GITHUB_WEBHOOK_SECRET;
    
    if (!verifyGitHubSignature($input, $signature, $secret)) {
        logMessage("Invalid GitHub webhook signature", "ERROR");
        http_response_code(401);
        exit('Invalid signature');
    }
    
    // Check if it's a push event
    $event = $_SERVER['HTTP_X_GITHUB_EVENT'];
    if ($event !== 'push') {
        logMessage("Ignored GitHub event: $event", "INFO");
        http_response_code(200);
        exit('Event ignored');
    }
    
    $branch = str_replace('refs/heads/', '', $payload['ref'] ?? '');
    $repoName = $payload['repository']['name'] ?? 'Unknown';
    $committer = $payload['pusher']['name'] ?? 'Unknown';
    $commitMsg = $payload['head_commit']['message'] ?? 'No message';
    
    $notification = "🔄 <b>GitHub Push Received</b>\n\n";
    $notification .= "📦 Repo: <code>$repoName</code>\n";
    $notification .= "🌿 Branch: <code>$branch</code>\n";
    $notification .= "👤 By: $committer\n";
    $notification .= "💬 Message: $commitMsg\n\n";
    $notification .= "🔄 Auto-deploying...";
    
} elseif ($isGitLab) {
    $token = $_SERVER['HTTP_X_GITLAB_TOKEN'] ?? '';
    $secret = GITLAB_WEBHOOK_SECRET;
    
    if ($token !== $secret) {
        logMessage("Invalid GitLab webhook token", "ERROR");
        http_response_code(401);
        exit('Invalid token');
    }
    
    $branch = str_replace('refs/heads/', '', $payload['ref'] ?? '');
    $repoName = $payload['project']['name'] ?? 'Unknown';
    $committer = $payload['user_name'] ?? 'Unknown';
    $commitMsg = $payload['commits'][0]['message'] ?? 'No message';
    
    $notification = "🔄 <b>GitLab Push Received</b>\n\n";
    $notification .= "📦 Repo: <code>$repoName</code>\n";
    $notification .= "🌿 Branch: <code>$branch</code>\n";
    $notification .= "👤 By: $committer\n";
    $notification .= "💬 Message: $commitMsg\n\n";
    $notification .= "🔄 Auto-deploying...";
}

// Send notification to all admins
foreach (ADMIN_IDS as $adminId) {
    sendTelegramMessage($adminId, $notification);
}

// Run deployment
logMessage("Auto-deployment triggered by webhook");
$deployResult = runDeploy(ADMIN_IDS[0] ?? null);

if ($deployResult) {
    logMessage("Auto-deployment completed successfully");
} else {
    logMessage("Auto-deployment failed", "ERROR");
}

http_response_code(200);
echo 'Webhook processed';

function verifyGitHubSignature($payload, $signature, $secret) {
    if (empty($signature) || empty($secret)) {
        return false;
    }
    
    $expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);
    return hash_equals($expected, $signature);
}
?>
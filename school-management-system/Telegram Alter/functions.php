<?php
function logMessage($message, $type = 'INFO') {
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] [$type] $message" . PHP_EOL;
    file_put_contents(LOG_FILE, $logEntry, FILE_APPEND);
}

function sendTelegramMessage($chatId, $message, $parseMode = 'HTML') {
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => $parseMode
    ];
    
    $ch = curl_init(API_URL . 'sendMessage');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

function isAdmin($userId) {
    return in_array($userId, ADMIN_IDS);
}

function runDeploy($chatId) {
    $output = [];
    $returnVar = 0;
    
    sendTelegramMessage($chatId, "🚀 <b>Deployment Started</b>\n\nRunning deployment script...");
    
    $command = "cd " . REPO_PATH . " && " . DEPLOY_SCRIPT . " 2>&1";
    exec($command, $output, $returnVar);
    
    $response = implode("\n", array_slice($output, -20)); // Last 20 lines
    
    if ($returnVar === 0) {
        $message = "✅ <b>Deployment Successful!</b>\n\n<code>" . htmlspecialchars($response) . "</code>";
    } else {
        $message = "❌ <b>Deployment Failed!</b>\n\nError Code: $returnVar\n\n<code>" . htmlspecialchars($response) . "</code>";
    }
    
    sendTelegramMessage($chatId, $message);
    logMessage("Deployment completed with code: $returnVar", $returnVar === 0 ? 'INFO' : 'ERROR');
    
    return $returnVar === 0;
}

function gitPull($chatId) {
    $output = [];
    $returnVar = 0;
    
    sendTelegramMessage($chatId, "📥 <b>Git Pull Started</b>");
    
    $command = "cd " . REPO_PATH . " && git pull 2>&1";
    exec($command, $output, $returnVar);
    
    $response = implode("\n", $output);
    
    if ($returnVar === 0) {
        $message = "✅ <b>Git Pull Successful!</b>\n\n<code>" . htmlspecialchars($response) . "</code>";
    } else {
        $message = "❌ <b>Git Pull Failed!</b>\n\n<code>" . htmlspecialchars($response) . "</code>";
    }
    
    sendTelegramMessage($chatId, $message);
    return $returnVar === 0;
}

function getStatus() {
    $status = [];
    
    // Check if directory exists
    $status['directory'] = is_dir(REPO_PATH) ? '✅' : '❌';
    
    // Check git repo
    $status['git'] = is_dir(REPO_PATH . '/.git') ? '✅' : '❌';
    
    // Get current branch
    if ($status['git'] === '✅') {
        $branch = trim(shell_exec("cd " . REPO_PATH . " && git branch --show-current 2>&1"));
        $status['branch'] = $branch ?: 'Unknown';
        
        // Get last commit
        $lastCommit = trim(shell_exec("cd " . REPO_PATH . " && git log -1 --oneline 2>&1"));
        $status['last_commit'] = $lastCommit ?: 'Unknown';
    } else {
        $status['branch'] = 'N/A';
        $status['last_commit'] = 'N/A';
    }
    
    // Check deploy script
    $status['deploy_script'] = file_exists(REPO_PATH . '/' . DEPLOY_SCRIPT) ? '✅' : '❌';
    
    return $status;
}
?>
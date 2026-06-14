<?php
require_once 'config.php';
require_once 'functions.php';

$content = file_get_contents('php://input');
$update = json_decode($content, true);

if (!$update) {
    logMessage("Invalid update received", "ERROR");
    exit;
}

logMessage("Received update: " . json_encode($update));

// Handle callback queries
if (isset($update['callback_query'])) {
    $callback = $update['callback_query'];
    $chatId = $callback['message']['chat']['id'];
    $messageId = $callback['message']['message_id'];
    $data = $callback['data'];
    $userId = $callback['from']['id'];
    
    if (!isAdmin($userId)) {
        sendTelegramMessage($chatId, "⛔ You are not authorized to use this bot.");
        exit;
    }
    
    if ($data === 'deploy') {
        runDeploy($chatId);
    } elseif ($data === 'git_pull') {
        gitPull($chatId);
    } elseif ($data === 'status') {
        showStatusMenu($chatId);
    }
    
    // Answer callback query
    $ch = curl_init(API_URL . 'answerCallbackQuery');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['callback_query_id' => $callback['id']]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
    
    exit;
}

// Handle regular messages
if (isset($update['message'])) {
    $message = $update['message'];
    $chatId = $message['chat']['id'];
    $text = trim($message['text'] ?? '');
    $userId = $message['from']['id'];
    
    if (!isAdmin($userId)) {
        sendTelegramMessage($chatId, "⛔ You are not authorized to use this bot.");
        exit;
    }
    
    if ($text === '/start') {
        $welcome = "🤖 <b>CI/CD Bot</b>\n\n";
        $welcome .= "Welcome to the CI/CD deployment bot!\n\n";
        $welcome .= "<b>Available Commands:</b>\n";
        $welcome .= "/deploy - Run deployment\n";
        $welcome .= "/gitpull - Pull latest changes\n";
        $welcome .= "/status - Check system status\n";
        $welcome .= "/menu - Show menu buttons\n";
        $welcome .= "/help - Show this help\n\n";
        $welcome .= "<b>Made for automated deployments</b>";
        
        sendTelegramMessage($chatId, $welcome);
    }
    elseif ($text === '/deploy') {
        runDeploy($chatId);
    }
    elseif ($text === '/gitpull') {
        gitPull($chatId);
    }
    elseif ($text === '/status') {
        showStatusMenu($chatId);
    }
    elseif ($text === '/menu') {
        showMenuButtons($chatId);
    }
    elseif ($text === '/help') {
        $help = "📚 <b>Help Guide</b>\n\n";
        $help .= "<b>Commands:</b>\n";
        $help .= "/deploy - Full deployment (pull + run script)\n";
        $help .= "/gitpull - Just pull from git\n";
        $help .= "/status - Check system status\n";
        $help .= "/menu - Show interactive buttons\n\n";
        $help .= "<b>Webhook:</b>\n";
        $help .= "GitHub/GitLab webhooks are supported at: webhook.php";
        
        sendTelegramMessage($chatId, $help);
    }
    else {
        sendTelegramMessage($chatId, "Unknown command. Use /help for available commands.");
    }
}

function showMenuButtons($chatId) {
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => '🚀 Deploy', 'callback_data' => 'deploy'],
                ['text' => '📥 Git Pull', 'callback_data' => 'git_pull']
            ],
            [
                ['text' => '📊 Status', 'callback_data' => 'status']
            ]
        ]
    ];
    
    $data = [
        'chat_id' => $chatId,
        'text' => "🔧 <b>CI/CD Control Panel</b>\n\nSelect an action:",
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode($keyboard)
    ];
    
    $ch = curl_init(API_URL . 'sendMessage');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

function showStatusMenu($chatId) {
    $status = getStatus();
    
    $message = "📊 <b>System Status</b>\n\n";
    $message .= "📁 Directory: {$status['directory']}\n";
    $message .= "🔀 Git Repo: {$status['git']}\n";
    $message .= "🌿 Branch: <code>{$status['branch']}</code>\n";
    $message .= "📝 Last Commit: <code>{$status['last_commit']}</code>\n";
    $message .= "📜 Deploy Script: {$status['deploy_script']}\n";
    
    sendTelegramMessage($chatId, $message);
}
?>
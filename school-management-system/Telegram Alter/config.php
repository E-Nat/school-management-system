<?php
// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// Bot Configuration
define('BOT_TOKEN', $_ENV['BOT_TOKEN'] ?? '');
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
define('WEBHOOK_URL', $_ENV['WEBHOOK_URL'] ?? '');
define('ADMIN_IDS', explode(',', $_ENV['ADMIN_IDS'] ?? ''));
define('LOG_FILE', __DIR__ . '/logs/bot.log');

// CI/CD Configuration
define('REPO_PATH', $_ENV['REPO_PATH'] ?? '/var/www/html');
define('DEPLOY_SCRIPT', $_ENV['DEPLOY_SCRIPT'] ?? './deploy.sh');
define('GITHUB_WEBHOOK_SECRET', $_ENV['GITHUB_WEBHOOK_SECRET'] ?? '');
define('GITLAB_WEBHOOK_SECRET', $_ENV['GITLAB_WEBHOOK_SECRET'] ?? '');
?>
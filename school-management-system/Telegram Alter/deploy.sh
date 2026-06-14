#!/bin/bash

# Example deployment script
# Place this in your repository root

echo "Starting deployment at $(date)"
echo "Current directory: $(pwd)"

# Example: Install dependencies
if [ -f "composer.json" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-dev --optimize-autoloader
fi

if [ -f "package.json" ]; then
    echo "Installing NPM dependencies..."
    npm install --production
    npm run build
fi

# Example: Clear cache
if [ -f "artisan" ]; then
    echo "Running Laravel migrations..."
    php artisan migrate --force
    echo "Clearing cache..."
    php artisan cache:clear
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Example: Restart services
echo "Restarting PHP-FPM..."
sudo systemctl reload php8.2-fpm || true

echo "Deployment completed at $(date)"
echo "=========================================="
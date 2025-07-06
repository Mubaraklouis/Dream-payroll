#!/bin/sh
set -e

echo "Starting entrypoint script..."

# Check if .env file exists
if [ ! -f .env ]; then
    echo "ERROR: .env file not found!"
    exit 1
fi

# Print .env file location for verification
echo "Verifying .env file location..."
pwd
ls -la .env
echo "The .env file is located at: $(pwd)/.env"

# Generate app key if not set
if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Create symlink for storage
echo "Creating storage symlink..."
php artisan storage:link --force

# Clear and rebuild cache
echo "Clearing and rebuilding cache..."
php artisan optimize:clear
php artisan optimize

# Verify permissions
echo "Verifying permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Display environment info (without secrets)
echo "Environment information:"
php artisan --version
php -v

echo "Entrypoint script completed successfully."

# Execute the command passed to docker run
exec "$@"

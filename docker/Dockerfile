FROM php:8.3-alpine

# Accept build arguments for secrets (used if .env isn't copied)
ARG DB_CONNECTION=mysql
ARG DB_HOST=127.0.0.1
ARG DB_PORT=3306
ARG DB_DATABASE=laravel
ARG DB_USERNAME=root
ARG DB_PASSWORD=

ARG MAIL_MAILER=smtp
ARG MAIL_HOST=mailhog
ARG MAIL_PORT=1025
ARG MAIL_USERNAME=null
ARG MAIL_PASSWORD=null
ARG MAIL_ENCRYPTION=null

ARG GOOGLE_CLIENT_ID=
ARG GOOGLE_CLIENT_SECRET=
ARG GITHUB_CLIENT_ID=
ARG GITHUB_CLIENT_SECRET=

# Install system dependencies
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    mariadb-client \
    mariadb-dev \
    oniguruma-dev \
    nodejs \
    npm \
    autoconf \
    g++ \
    make

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --no-scripts --no-interaction --optimize-autoloader

# Copy the rest of the application
COPY . .

# If .env doesn't exist, create it from build arguments
RUN if [ ! -f .env ]; then \
    echo "Creating .env file from build arguments..." && \
    echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=http://localhost" >> .env && \
    echo "DB_CONNECTION=${DB_CONNECTION}" >> .env && \
    echo "DB_HOST=${DB_HOST}" >> .env && \
    echo "DB_PORT=${DB_PORT}" >> .env && \
    echo "DB_DATABASE=${DB_DATABASE}" >> .env && \
    echo "DB_USERNAME=${DB_USERNAME}" >> .env && \
    echo "DB_PASSWORD=${DB_PASSWORD}" >> .env && \
    echo "MAIL_MAILER=${MAIL_MAILER}" >> .env && \
    echo "MAIL_HOST=${MAIL_HOST}" >> .env && \
    echo "MAIL_PORT=${MAIL_PORT}" >> .env && \
    echo "MAIL_USERNAME=${MAIL_USERNAME}" >> .env && \
    echo "MAIL_PASSWORD=${MAIL_PASSWORD}" >> .env && \
    echo "MAIL_ENCRYPTION=${MAIL_ENCRYPTION}" >> .env && \
    echo "GOOGLE_CLIENT_ID=${GOOGLE_CLIENT_ID}" >> .env && \
    echo "GOOGLE_CLIENT_SECRET=${GOOGLE_CLIENT_SECRET}" >> .env && \
    echo "GITHUB_CLIENT_ID=${GITHUB_CLIENT_ID}" >> .env && \
    echo "GITHUB_CLIENT_SECRET=${GITHUB_CLIENT_SECRET}" >> .env; \
fi

# Make sure the .env file has proper permissions
RUN chmod 644 .env

# Run composer scripts now that the .env is available
RUN composer dump-autoload --optimize

# Install Node.js dependencies and build assets
RUN npm install && npm run build

# Add entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Make sure storage directory is writable
RUN mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Generate app key if not present
RUN php artisan key:generate --force

EXPOSE 8000

# Use the entrypoint script to ensure environment is properly setup before serving
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

FROM php:8.1-apache

# Enable mysqli + PDO
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy project files
COPY . /var/www/html/

# Remove old index.html so index.php is served
RUN rm -f /var/www/html/index.html

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

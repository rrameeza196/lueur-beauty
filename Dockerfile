FROM php:8.1-apache

# Disable extra MPM modules, enable only prefork
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true \
    && a2enmod mpm_prefork 2>/dev/null || true

# Enable mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Remove old index.html
RUN rm -f /var/www/html/index.html

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]

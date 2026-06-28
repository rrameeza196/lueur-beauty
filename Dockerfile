FROM php:8.1-apache

RUN a2dismod mpm_event 2>/dev/null || true
RUN a2enmod mpm_prefork 2>/dev/null || true
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN a2enmod rewrite

COPY . /var/www/html/
RUN rm -f /var/www/html/index.html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]

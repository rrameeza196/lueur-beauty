FROM php:8.1-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2dismod mpm_event || true
RUN a2enmod mpm_prefork rewrite mysqli
RUN docker-php-ext-install mysqli

COPY . /var/www/html/
RUN rm -f /var/www/html/index.html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]

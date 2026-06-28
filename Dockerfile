FROM php:8.1-apache

RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

RUN sed -i 's/^#LoadModule mpm_prefork/LoadModule mpm_prefork/' /etc/apache2/mods-available/mpm_prefork.conf 2>/dev/null || true

RUN rm -f /etc/apache2/mods-enabled/mpm_event.conf \
    && rm -f /etc/apache2/mods-enabled/mpm_event.load \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.conf \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.load \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load

RUN a2enmod rewrite

COPY . /var/www/html/
RUN rm -f /var/www/html/index.html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]

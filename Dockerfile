FROM php:8.1-fpm-alpine

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apk add --no-cache nginx supervisor

COPY . /var/www/html/
RUN rm -f /var/www/html/index.html
RUN mkdir -p /run/nginx
RUN chown -R www-data:www-data /var/www/html

COPY nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /etc/supervisor/conf.d
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

FROM php:7.1.29-cli-alpine3.8
COPY ./app /app
COPY ./app/resolf.conf /etc/resolf.conf
WORKDIR /app
RUN docker-php-ext-install sockets
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN composer install
CMD [ "php", "./run.php" ]
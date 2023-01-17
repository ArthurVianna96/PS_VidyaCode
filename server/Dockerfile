FROM php:8-alpine
WORKDIR /app/server
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
COPY . .
CMD php -S 0.0.0.0:3000 
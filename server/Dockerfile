FROM php:8-alpine
WORKDIR /app/server
RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
COPY . .
CMD php -S 0.0.0.0:3000 
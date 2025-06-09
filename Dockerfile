FROM php:8.2-cli

RUN apt-get update
RUN apt-get install -y git libzip-dev zip

RUN docker-php-ext-install zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /src
WORKDIR /src

# Forcer git à utiliser HTTPS au lieu de SSH
RUN git config --global url."https://github.com/".insteadOf "git@github.com:"

# install the dependencies
RUN composer install -o --prefer-dist && chmod a+x builds/expose-server

ENV port=8080
ENV domain=localhost
ENV username=username
ENV password=password
ENV exposeConfigPath=/src/config/expose-server.php
ENV EXPOSE_MAIN_HOSTNAME=""

COPY docker-entrypoint.sh /usr/bin/
RUN chmod 755 /usr/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]

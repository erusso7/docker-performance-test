FROM php:7

RUN apt-get update \
    && apt-get install -y \
        git \
        unzip

ADD https://getcomposer.org/composer.phar /usr/bin/composer

ADD app/ /app/

WORKDIR /app

RUN chmod +x /usr/bin/composer \
    && composer install

CMD ["./entrypoint.sh"]
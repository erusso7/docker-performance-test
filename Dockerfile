FROM php:7

ADD . /app

WORKDIR /app

CMD ["./entrypoint.sh"]
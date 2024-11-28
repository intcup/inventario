FROM php:7.0-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli
WORKDIR /app
COPY html .
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]

# Dockerfile
FROM php:8.1-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev libonig-dev npm unzip
RUN docker-php-ext-install mysqli pdo mbstring pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

WORKDIR /app
COPY . /app

RUN composer install
RUN npm install

EXPOSE 8000
COPY start.sh /start.sh

RUN chmod +x /start.sh

CMD ["/start.sh"]

FROM php:8.1-fpm

# Установка Git и zip
RUN apt-get update \
    && apt-get install -y git zip unzip postgresql-client libpq-dev

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка расширений PHP, необходимых для Laravel и PostgreSQL
RUN docker-php-ext-install pdo_pgsql

# Установка Laravel
WORKDIR /var/www/html
RUN composer global require laravel/installer

# Добавление команды Laravel в PATH
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# Копирование файлов Laravel в контейнер
COPY . .

# Запуск приложения
CMD ["php-fpm"]

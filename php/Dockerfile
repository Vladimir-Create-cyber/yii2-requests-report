FROM php:8.3-fpm

# 1) Ставим системные зависимости
# - libpq-dev нужен, чтобы собрать расширения PostgreSQL (pdo_pgsql/pgsql)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pgsql gd \
    && rm -rf /var/lib/apt/lists/*

# 2) Добавляем Composer внутрь контейнера
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
FROM php:8.4-apache-bookworm

# System dependencies + extensions required by MapOS (mpdf, phpword, gd, mysqli, etc.)
RUN apt-get update && apt-get install -y --no-install-recommends \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libicu-dev \
        libcurl4-openssl-dev \
        libxml2-dev \
        libonig-dev \
        unzip \
        git \
        cron \
        supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        gd \
        curl \
        mysqli \
        zip \
        mbstring \
        xml \
        intl \
        bcmath \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY docker/easypanel/php.ini /usr/local/etc/php/conf.d/zz-mapos.ini
COPY docker/easypanel/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/easypanel/cron-jobs /etc/cron.d/mapos-cron

RUN chmod 0644 /etc/cron.d/mapos-cron \
    && touch /var/log/cron.log && chown www-data:www-data /var/log/cron.log \
    && mkdir -p application/logs uploads assets/userImage install/files \
    && chown -R www-data:www-data /var/www/html \
    && find application uploads assets/userImage install/files -type d -exec chmod 775 {} \;

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

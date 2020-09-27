FROM php:7.2-cli-alpine

RUN apk add --update --no-cache \
        git \
        curl \
        coreutils \
        icu-dev \
        libzip-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        bash

RUN docker-php-source extract \
    # ext-opache
    && docker-php-ext-enable opcache \
    # ext-calendar
    && docker-php-ext-install calendar \
    && docker-php-ext-enable calendar \
    # ext-others
    && docker-php-ext-install intl zip json ctype \
    ## cleanup
    && docker-php-source delete

# install fixuid
RUN curl -SsL https://github.com/boxboat/fixuid/releases/download/v0.5/fixuid-0.5-linux-amd64.tar.gz | tar -C /usr/local/bin -xzf - && \
    chown root:root /usr/local/bin/fixuid && \
    chmod 4755 /usr/local/bin/fixuid && \
    mkdir -p /etc/fixuid && \
    printf "user: www-data\ngroup: www-data\n" > /etc/fixuid/config.yml

COPY --from=composer:2 /usr/bin/composer /usr/bin

WORKDIR /opt/project
COPY . .

ENTRYPOINT ["fixuid", "-q"]

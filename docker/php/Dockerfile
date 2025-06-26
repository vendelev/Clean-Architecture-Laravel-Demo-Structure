ARG PHP_VERSION="8.4.8-cli-bookworm"
ARG UNIT_VERSION="1.34.2"
ARG XDEBUG_VERSION="3.4.4"
ARG LOCALTIME="Europe/Moscow"

FROM composer:2.8.9 AS composer
FROM mlocati/php-extension-installer:2.8.1 AS php-extension-installer

#####
FROM php:${PHP_VERSION} AS unit_builder

RUN <<EOF
  set -e
  apt-get update
  apt-get install -y libpcre2-dev git
  mkdir -p /usr/lib/unit/modules
  git clone https://github.com/nginx/unit.git
  cd unit
  git checkout ${UNIT_VERSION}
  ./configure --prefix=/usr --state=/var/lib/unit --control=unix:/var/run/control.unit.sock --log=/var/log/unit.log --user=www-data --group=www-data --tmp=/tmp --modules=/usr/lib/unit/modules
  ./configure php
  make
  make install
EOF

#####
FROM php:${PHP_VERSION} AS php-base

COPY --from=php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN <<EOF
  set -e
  apt-get update
  apt-get install -y zip unzip tzdata
  rm /etc/localtime
  ln -s /usr/share/zoneinfo/${LOCALTIME} /etc/localtime
  install-php-extensions ldap redis amqp-2.1.2 pgsql pdo_pgsql gd bcmath iconv ctype sockets zip soap intl pcntl curl opcache opentelemetry
  apt-get remove -q -y ${PHPIZE_DEPS} ${BUILD_DEPENDS}
  apt-get clean autoclean
  apt-get autoremove --yes
  rm -rf /var/lib/{apt,dpkg,cache,log,lists}/*
  rm -rf /var/cache/apt/archives /tmp/* /var/tmp/*
EOF

COPY --from=unit_builder /usr/sbin/unitd /usr/sbin/unitd
COPY --from=unit_builder /usr/lib/unit/ /usr/lib/unit/
COPY --from=composer /usr/bin/composer /usr/bin/

COPY --chmod=544 entrypoint.sh /entrypoint.sh
COPY config.json /config.json

RUN ln -s /dev/stdout /var/log/unit.log && mkdir -p /var/lib/unit

WORKDIR /var/www/backend

EXPOSE 80

#####
FROM php-base AS php-dev

ARG UID=1000
ARG GID=1000
ENV UID=${UID}
ENV GID=${GID}

RUN <<EOF
  groupmod --gid=${GID} www-data
  usermod --uid=${UID} --gid=${GID} www-data
EOF

RUN <<EOF
  set -e
  apt-get update
  apt-get install -y sudo postgresql-client git
  apt install -y ${PHPIZE_DEPS} ${BUILD_DEPENDS}
  install-php-extensions xdebug-${XDEBUG_VERSION}
  apt-get remove -q -y ${PHPIZE_DEPS} ${BUILD_DEPENDS}
  apt-get clean
EOF

RUN usermod -aG sudo www-data && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers
RUN mv "${PHP_INI_DIR}/php.ini-development" "${PHP_INI_DIR}/php.ini"
RUN echo "opentelemetry.attr_hooks_enabled = On" >> "${PHP_INI_DIR}/php.ini"
RUN mkdir -p /var/www/backend/public && echo "<?php phpinfo();" > /var/www/backend/public/index.php

USER www-data

CMD [ "sudo", "sh", "-c", "/entrypoint.sh" ]

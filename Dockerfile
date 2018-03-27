FROM php:7-cli

ARG COMPOSER_FLAGS="--prefer-dist --no-interaction"
ARG DEBIAN_FRONTEND=noninteractive
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /code/

COPY docker/composer-install.sh /tmp/composer-install.sh

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libxml2-utils \
	&& rm -r /var/lib/apt/lists/* \
	&& chmod +x /tmp/composer-install.sh \
	&& /tmp/composer-install.sh

## Composer - deps always cached unless changed
# First copy only composer files
COPY composer.* /code/
# Download dependencies, but don't run scripts or init autoloaders as the app is missing
RUN composer install $COMPOSER_FLAGS --no-scripts --no-autoloader
# copy rest of the app
COPY . /code/
# run normal composer - all deps are cached already
RUN composer install $COMPOSER_FLAGS

RUN curl -s -S --fail https://raw.githubusercontent.com/squizlabs/PHP_CodeSniffer/master/phpcs.xsd -o /tmp/phpcs.xsd

CMD /bin/bash

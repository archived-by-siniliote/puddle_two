MAKE_S = $(MAKE) -s

USER_ID = $(shell id -u)
GROUP_ID = $(shell id -g)
NPROCS := 1
OS := $(shell uname)

ECHO = .mk/bin/display-job-title

PROJECT_ROOT = .
PROJECT_BUILD = build
PHPUNIT_COVERAGE = $(PROJECT_BUILD)/phpunit/coverage

URL_WEBSITE = http://localhost

XDEBUG_INI = /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

SERVICE_PHP = php
SERVICE_CADDY = caddy

EXEC = docker compose exec
ifdef NO_TTY
  EXEC = docker compose exec -T
endif

RUN = docker compose run

EXEC_USER = $(EXEC) --user $(USER_ID):$(GROUP_ID)
EXEC_ROOT = $(EXEC) --user 0

EXEC_APP = $(EXEC) $(SERVICE_PHP)
EXEC_APP_ROOT = $(EXEC_ROOT) $(SERVICE_PHP)

COMPOSER = $(EXEC_APP) composer
PHP = $(EXEC_APP) php

PHP_CS_FIXER = $(EXEC_APP) ./bin/php-cs-fixer
PHPUNIT = $(EXEC_APP) ./bin/phpunit

SYMFONY = $(PHP) bin/console

SUPPORTED_COMMANDS =

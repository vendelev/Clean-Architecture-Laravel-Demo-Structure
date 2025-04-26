DOCKER_COMPOSE=docker compose

.ONESHELL:
.PHONY: help

H1=echo === ${1} ===
BR=echo
TAB=echo "\t"

help:
	@$(call H1,Application)
	$(TAB) make install - Собрать и запустить образы, composer install, создание тестовой БД
	$(TAB) make update - Пересобрать и перезапустить образы, composer install
	$(TAB) make test-php - Выполнить PHP проверки

install:
	${DOCKER_COMPOSE} up -d
	cp backend/.env.example backend/.env
	cp backend/.env.example backend/.env.testing
	${DOCKER_COMPOSE} exec php-dev composer install
	${DOCKER_COMPOSE} exec php-dev php artisan key:generate

update:
	${DOCKER_COMPOSE} down
	git pull
	${DOCKER_COMPOSE} build
	${DOCKER_COMPOSE} up -d
	${DOCKER_COMPOSE} exec php-dev composer install

test-php:
	${DOCKER_COMPOSE} exec php-dev composer fix
	${DOCKER_COMPOSE} exec php-dev composer test
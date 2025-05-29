DOCKER_COMPOSE=docker compose

.ONESHELL:
.PHONY: help

H1=echo === ${1} ===
BR=echo
TAB=echo "\t"

help:
	@$(call H1,Application)
	$(TAB) make install - Собрать и запустить базовые образы, composer install, создание тестовой БД
	$(TAB) make update - Пересобрать образы и перезапустить базовые контейнеры, composer install
	$(TAB) make test-php - Выполнить PHP проверки
	$(TAB) make up - Запустить базовые контейнеры
	$(TAB) make down - Выключить базовые контейнеры
	$(TAB) make log-up - Запустить все контейнеры с логированием
	$(TAB) make log-down - Выключить все контейнеры с логированием

install:
	${DOCKER_COMPOSE} build
	${DOCKER_COMPOSE} up -d
	cp backend/.env.example backend/.env
	cp backend/.env.example backend/.env.testing
	${DOCKER_COMPOSE} exec laravel-demo composer install
	${DOCKER_COMPOSE} exec laravel-demo php artisan key:generate
	${DOCKER_COMPOSE} exec laravel-demo composer init-test-db

update:
	${DOCKER_COMPOSE} down
	git pull
	${DOCKER_COMPOSE} build
	${DOCKER_COMPOSE} up -d
	${DOCKER_COMPOSE} exec laravel-demo composer install
	${DOCKER_COMPOSE} exec laravel-demo composer init-test-db

test-php:
	${DOCKER_COMPOSE} exec laravel-demo composer test

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

log-up:
	${DOCKER_COMPOSE} -f docker-compose.yaml -f docker-compose.log.yaml up -d

log-down:
	${DOCKER_COMPOSE} -f docker-compose.yaml -f docker-compose.log.yaml down

doc-up:
	${DOCKER_COMPOSE} -f docker-compose.doc.yaml up -d

doc-down:
	${DOCKER_COMPOSE} -f docker-compose.doc.yaml down
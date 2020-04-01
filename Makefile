.PHONY: up down init srv migrate new-migration require

# Set dir of Makefile to a variable to use later
MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))

PICALLEX := bref
REMOTE_DIR := /var/www
DIR := $(PWD)$(PICALLEX)

up:
	cd laradock && docker-compose up -d nginx php-fpm mysql

down:
	cd laradock && docker-compose down

down-db:
	docker volume rm $$(docker volume ls --filter name=laradock_ -q)

rebuild-db:
	cd laradock && docker-compose build --no-cache mysql

init:
	cd bref && cp .env.example .env

srv:
	cd laradock && docker-compose exec workspace /bin/bash

migrate:
	cd laradock && docker-compose exec workspace php artisan migrate

migrate-back:
	docker run -it --rm \
		-v $(DIR):$(REMOTE_DIR) \
		-w $(REMOTE_DIR) \
		laradock_workspace \
		php artisan migrate

key:
	cd laradock && docker-compose exec workspace php artisan key:generate

MG=''
new-migration:
	docker run -it --rm \
		-v $(DIR):$(REMOTE_DIR) \
		-w $(REMOTE_DIR) \
		laradock_workspace \
		php artisan make:migration $(MG)

PKG=''
require:
	docker run -it --rm \
		-v $(DIR):$(REMOTE_DIR) \
		-w $(REMOTE_DIR) \
		laradock_workspace \
		php -d memory_limit=-1 /usr/local/bin/composer require $(PKG)

composer-install:
	docker run -it --rm \
		-v $(DIR):$(REMOTE_DIR) \
		-w $(REMOTE_DIR) \
		laradock_workspace \
		composer install

composer-dump-autoload:
	cd laradock && docker-compose exec workspace composer dump-autoload
init:
	docker-compose up -d --build
	docker-compose exec kenshu-laravel composer install
	docker-compose exec kenshu-laravel cp .env.example .env
	docker-compose exec kenshu-laravel php artisan key:generate
	docker-compose exec kenshu-laravel php artisan storage:link
	docker-compose exec kenshu-laravel chmod -R 777 storage bootstrap/cache
	docker-compose exec kenshu-laravel npm ci
	@make migrate
build:
	docker-compose build
up:
	docker-compose up -d
down:
	docker-compose down
ps:
	docker-compose ps
migrate:
	docker exec kenshu-laravel php artisan migrate
laravel:
	docker exec -it kenshu-laravel bash
nginx:
	docker exec -it kenshu-nginx ash
mysql:
	docker exec -it kenshu-mysql bash
npm:
	@make npm-install
npm-install:
	docker-compose exec kenshu-nginx npm install
npm-dev:
	docker-compose exec kenshu-nginx npm run dev
npm-watch:
	docker-compose exec kenshu-nginx npm run watch
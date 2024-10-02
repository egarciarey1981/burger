up:
	docker compose up -d

down:
	docker compose down

composer-install:
	docker compose exec backend composer install
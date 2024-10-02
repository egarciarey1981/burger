up:
	docker compose up -d

down:
	docker compose down

composer-install:
	docker compose exec backend composer install

composer-requre:
	docker compose exec backend composer require $(package)

composer-dump-autoload:
	docker compose exec backend composer dump-autoload
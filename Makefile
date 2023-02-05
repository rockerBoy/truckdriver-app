develop:
	docker-compose down && docker-compose up -d php-fpm redis-web && docker-compose ps

develop:
	docker-compose down docker-compose up -d nginx redis-web && docker-compose ps

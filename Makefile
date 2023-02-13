dbinstall:
	docker run -d --name=kategorie_zadanie-mysql --publish 6606:3306 -e MYSQL_ROOT_PASSWORD=1234567 -e MYSQL_ROOT_HOST="%" -d mysql/mysql-server:5.7

dbrun:
	docker start kategorie_zadanie-mysql

dbstart:
	docker container start kategorie_zadanie-mysql

dbcreate:
	docker exec -it kategorie_zadanie-mysql mysql -uroot -p1234567 -e 'CREATE DATABASE kategorie_zadanie;'

serve:
	php artisan serve --port=8088

.PHONY: dbinstall dbrun start dbcreate
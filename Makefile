diagram:
	docker-compose exec php vendor/bin/php-class-diagram --exclude='Shared' --exclude='Kernel.php' --disable-class-properties  src > diagram.puml
	#docker-compose exec php php generate.php


up-database:
	 docker-compose exec php bin/console doctrine:database:drop --force --if-exists
	 docker-compose exec php bin/console doctrine:database:create --if-not-exists
	 docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction
	 docker-compose exec php bin/console doctrine:fixtures:load --no-interaction

diagram:
	docker-compose exec php vendor/bin/php-class-diagram --exclude='Shared' --exclude='Kernel.php' --disable-class-properties  src > diagram.puml
	#docker-compose exec php php generate.php

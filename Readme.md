#Symfony project

Startup:
1. make build
2. make up
3. make bash
4. composer install

Проверка доступности бд:
1. make bash
2. php bin/console doctrine:migration:diff
3. php bin/console doctrine:migration:migrate

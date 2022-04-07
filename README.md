# Docker for backend internships

1. Скопируйте репозиторий командой `git clone git@github.com:olegsv3007/symfony-cinema.git`
2. Перейдите в директорию `docker` командой `cd docker`
3. Скопируйте файл `.env.example` в `.env` командой `cp .env.example .env`
4. Запустите docker контейнеры командой `docker-compose up -d --build`
5. Запустите установку зависимостей composer `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 composer install`
6. Выполните миграции БД `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 ./bin/console doctrine:migrations:migrate`
7. (Опционально) Заполните БД тестовыми данными `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 ./bin/console doctrine:fixtures:load`
8. Вернитесь в рабочую директорию `cd ..`
9. Перейдите на [страницу приветствия Symfony](http://localhost/)

# Тестирование

1. Создать базу данных для тестов `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 bin/console --env=test doctrine:database:create`
2. Создать таблицы для тестовой БД `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 bin/console --env=test doctrine:schema:create`
3. Применить фикстуры к тестовой БД `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 bin/console --env=test doctrine:fixtures:load`
4. Запустить тесты `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 php bin/phpunit`

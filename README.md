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

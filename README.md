# Docker for backend internships

1. Скопируйте репозиторий командой `git clone https://gitlab.com/resolventa/docker-for-backend-internships.git`
2. Перейдите в директорию `docker` командой `cd docker`
3. Скопируйте файл `.env.example` в `.env` командой `cp .env.example .env`
4. Запустите docker контейнеры командой `docker-compose up -d --build`
5. Запустите установку Symfony командой `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 bash install/symfony.sh`
6. Установите снифферы командой `docker exec -itu1000 resolventa_backend_internship_php-fpm_1 bash install/sniffers.sh`
7. Вернитесь в рабочую директорию `cd ..`
8. Перейдите на [страницу приветствия Symfony](http://localhost/)

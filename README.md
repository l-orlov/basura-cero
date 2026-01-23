# basura-cero

### Команда для запуска локально
```
php -d short_open_tag=On -S localhost:8888
```

### Команда для настройки БД локально в docker
```
cd web/db/docker
docker-compose up -d

docker exec -it basura_cero_mariadb bash
/usr/bin/mariadb -u root -p

enter: rootpassword

USE db;
```

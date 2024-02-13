Установка: 
-------------------

```
docker-compose up -d
docker exec -it {название директории где лежит}-backend-1 bash
composer install
php yii migrate
php yii user/create test test test
```

http://localhost:22080/index.php

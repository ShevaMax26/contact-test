## <h2 style="color:#ba363f">Installation</h2>
``` 
    composer install
    php artisan migrate
    php artisan db:seed
    npm install
    npm run dev
```

## Dev tips
```
docker-compose build --no-cache
docker-compose up --build --force-recreate --no-deps
docker-compose up -d --build

docker-compose down

docker-compose up -d

docker exec -it contact_test_app bash

//не заходячи в bash, просто в папці проекту перший раз дати пермішини
chmod -R 777  ./

systemctl restart docker
```

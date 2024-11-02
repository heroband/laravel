## Prepare

```bash
git clone git@gitlab.mobidev.biz:a.khoroshun/laravel-skillsup.git .
```

```bash
cat .env.example >> .env
```

Update variables to your needs.

## Install Project

Run your docker containers
```bash
docker compose up -d
```

Install dependency
```bash
docker compose exec php composer install
```

Change permissions to created project  (only Linux)
```bash
sudo chown $(id -u):$(id -g) ./ -Rf
```

Change permissions to storage folder (only Linux)
```bash
sudo chmod 777 storage/ -Rf
```

Generate app key
```bash
docker compose exec php ./artisan key:generate
```


Restart docker-compose
```bash
docker compose stop
```    
```bash
docker compose up -d
```    
                                                                                           
Migrate database                                                                           
```bash
docker compose exec php ./artisan migrate --seed          
```                                                                                        
                                                                                           

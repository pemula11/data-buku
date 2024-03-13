Website inventaris buku sederhana menggunakan laravel framework


# instalasi

## clone repo

```
git clone https://github.com/pemula11/data-buku.git
```

## init config

```
cp .env.example .env
php artisan key:generate
```

# migrate database

Database name : data-buku

```
php artisan migrate
```

# run 
```
php artisan serve
```

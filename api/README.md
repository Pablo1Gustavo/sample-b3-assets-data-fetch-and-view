
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Sample B3 Assets Data Fetch and View

## Getting Started
First create the database, then use the following commands:
```bash
$ composer install
$ php artisan migrate
$ cp .env.example .env
$ php artisan key:generate
```
After it, add your database credentials to the .env.

## Populate database
You  can populate your database using some fake data using the command `php artisan db:seed` or you can populate the database with real data using `php artisan update:database <days>` where "days" is the interval of days ago to fetch B3 public data.
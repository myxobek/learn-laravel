## Requirements
1. PHP 5.6+
2. Composer
2. MySQL

## Install

1. Download and extract or just clone repository
2. Go to repository folder
3. Install necessary packages

`$ composer install`
4. In MySQL create databases for application and tests (ex. example and example_test) 

```
$ mysql -u root p
mysql> CREATE DATABASE example;
mysql> CREATE DATABASE example_test;
mysql> EXIT;
```
5. Migrate database sample

`$ mysql -u root -p example < database/sample.sql`
6. Create and edit your .env file
```
$ mv .env.example .env
$ nano .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=example
DB_USERNAME=<USERNAME>
DB_PASSWORD=<PASSWORD>

DB_TEST_CONNECTION=mysql
DB_TEST_HOST=127.0.0.1
DB_TEST_PORT=3306
DB_TEST_DATABASE=example_test
DB_TEST_USERNAME=<USERNAME>
DB_TEST_PASSWORD=<PASSWORD>
```

6. Create application key

`$ php artisan key:generate`
7. Clear artisan configs

`$ php artisan config:clear`
8. Run application

```
$ php artisan serve
Laravel development server started: <http://127.0.0.1:8000>
```
9. Go to `http://127.0.0.1:8000`
10. Unit testing

`$ composer test`
## Atthus Framework

Atthus Framework is a web application panel made using the following technologies: 

- [Laravel](https://laravel.com).
- [Vue](https://v3.vuejs.org/).
- [Inertia](https://inertiajs.com/).
- [Tailwind](https://tailwindcss.com/).

## Installation

### Requirements
- **PHP**: >= 7.4
- **Database**: MySQL / MariaDB

### Git Clone
```
$ git clone git@github.com:bryandantas/atthusframework.git
$ cd atthusframework
$ composer update
$ composer run-script post-root-package-install
```

### Create Database
Create your database on your server and change these lines in **.env** file to reflect your new database settings.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Run Artisan Commands

```
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
This last command gives you access via the url: http://localhost:8000/

### Run NPM commands

```
npm install
npm run dev
```

### Access Admin Panel
After this project is installed, access **http://localhost:8000/admin** route to login in panel. 

The credentials are: 

**Email**: admin@atthus.com.br

**Password**: teste123


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation

**PHP Dependencies**

```bash
composer install
```
**Node Js Dependencies**

```bash
npm install
```
**Set up Database**
- chage .env setting for database
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tweet_app
DB_USERNAME=root
DB_PASSWORD=
```
- change faker local generator to indonesian
```env
APP_FAKER_LOCALE=id_ID
```
- Running mysql database service
- Create table based on the name in .env setting
- Generate database content
```bash
php artisan migrate:fresh --seed
```
**Running**
```bash
npm run dev
```
```bash
php artisan serve
```

**Note**
- You can log in with any user email generated in database with default password `password`
- Or you can create your own factory in `database/seeder/DatabaseSeeder.php`
```php
        User::factory()
            ->has(Post::factory()->count(3))
            ->create([
                'name' => 'Kadafi',
                'username' => 'kadafi',
                'email' => 'kadafi@gmail.com',
                'password' => Hash::make('rizkikadafi'),
            ]);

```


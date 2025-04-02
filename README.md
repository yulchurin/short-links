### Url Shortener

- Laravel `^10.0`, `^11.0` or `^12.0`
- PHP `^8.3`

## Installation

You can install the package via composer:

```bash
composer require mactape/short-links
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="short-links-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="short-links-config"
```


configure in `config/short-links.php`


domain -> your application domain

expiration (default 12) integer in hours. Model will be pruned

### Usage

create hash for url
```php
$hash = ShortURL::generate('https://your-url-to-shorten');
```

now you can use like

```php
return ShortURL::open($hash);
```
_or navigate to_ `https://your-application-domain/s/{hash}`

Add to

`\App\Console\Kernel` `schedule` method if you use Laravel 10


```php
$schedule->command('model:prune')->daily();
```

Or
```php
Schedule::command('model:prune')->daily();
```

in your application's `routes/console.php` if you use Laravel >= 11

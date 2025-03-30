### Url Shortener

`composer require mactape/short-links`

`php artisan vendor:publish --provider="Mactape\ShortLinks\ShortLinksServiceProvider"`

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

`\App\Console\Kernel`

`schedule` method

```php
$schedule->command('model:prune')->daily();
```

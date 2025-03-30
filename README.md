### Url Shortener

`composer require mactape/short-links`

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

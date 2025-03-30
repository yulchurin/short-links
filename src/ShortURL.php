<?php

namespace Mactape\ShortLinks;

use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string generate(string $url, ?CarbonInterface $expires = null)
 * @method static open(string $hash)
 */
class ShortURL extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UrlShortener::class;
    }
}

<?php

namespace Mactape\ShortLinks;

class ShortURL extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Mactape\ShortLinks\UrlShortener::class;
    }
}

<?php

namespace Mactape\ShortLinks\Actions;

use Mactape\ShortLinks\ShortURL;

class OpenByShortLink
{
    public function __invoke(string $hash)
    {
        return ShortURL::open($hash);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use Mactape\ShortLinks\Actions\OpenByShortLink;

Route::group([
    'prefix' => 's',
    'as' => 'short-links',
], function () {
    Route::get('{hash}', OpenByShortLink::class);
});

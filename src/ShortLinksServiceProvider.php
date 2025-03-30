<?php

namespace Mactape\ShortLinks;

use Illuminate\Support\ServiceProvider;

class ShortLinksServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'./config/short-links.php' => config_path('short-links.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'./routes/shortener.php');

        $this->publishesMigrations([
            __DIR__.'./database/migrations' => database_path('migrations'),
        ]);
    }
}

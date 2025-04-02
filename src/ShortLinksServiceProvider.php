<?php

namespace Mactape\ShortLinks;

use Illuminate\Support\ServiceProvider;

class ShortLinksServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/short-links.php' => config_path('short-links.php'),
        ], 'short-links-config');

        $this->loadRoutesFrom(__DIR__.'/routes/shortener.php');

        $dateString = now()->startOfYear()->format('Y_m_d_His');

        $stub = __DIR__.'/database/migrations/create_short_links_table.php.stub';
        $migration = database_path("migrations/{$dateString}_create_short_links_table.php");

        $this->publishes([
            $stub => $migration,
        ], 'short-links-migrations');
    }
}

<?php

return [

    'domain' => env('APP_URL'),

    'table' => 'short_links',

    /*
     * --------------------------------------------------------------------------
     *  Expiration Time
     * --------------------------------------------------------------------------
     *  This value is the time in hours after which the short link will be stale.
     *  Also, the model will be deleted from the database if you set the
     *  $schedule->command('model:prune')->daily()
     *
     */
    'expiration' => 12,

    /*
     * --------------------------------------------------------------------------
     *  Allow To Reuse Links
     * --------------------------------------------------------------------------
     *  If set to false, you will only be able to open the link once.
     */
    'allow_reuse_links' => true,
];

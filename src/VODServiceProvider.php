<?php

namespace Everalan\VOD;

use Illuminate\Support\ServiceProvider;

class VODServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/lecloud-vod.php' => config_path('lecloud-vod.php'),
        ]);
    }

    public function register()
    {
    }
}

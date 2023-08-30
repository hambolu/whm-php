<?php
namespace Ouchestechnology\WhmPhp;

use Illuminate\Support\ServiceProvider;


class WhmPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
    }


    public function register()
    {
        $this->app->singleton('whm-php', function ($app) {
            $baseUrl = config('whm.base_url');
            $apiKey = config('whm.api_key');
            return new WhmPhp($baseUrl, $apiKey);
        });

        // Load the helper functions
        require_once (__DIR__ . '/Helper.php');
    }
}

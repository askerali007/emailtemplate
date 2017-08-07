<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Cache;


class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    
    public function boot()
    {
        // Laravel >= 5.2, use 'lists' instead of 'pluck' for Laravel <= 5.1
       // config()->set('settings', \App\Setting::lists('value', 'name')->all());
        
        $settings = Cache::remember('settings', 60, function() 
        {
            // Laravel >= 5.2, use 'lists' instead of 'pluck' for Laravel <= 5.1
            return \App\Setting::lists('value', 'name')->all();
        });
        config()->set('settings', $settings);
    }
    
    /*
    public function boot(Factory $cache, Setting $settings)
    {
        $settings = $cache->remember('settings', 60, function() use ($settings)
        {
            // Laravel >= 5.2, use 'lists' instead of 'pluck' for Laravel <= 5.1
            return $settings->lists('value', 'name')->all();
        });

        config()->set('settings', $settings);
    }
     * 
     */
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Vedmant\LaravelShortcodes\Facades\Shortcodes;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot()
    {
        if (!request()->is('admin/*')) {
            Shortcodes::add('video', \App\Shortcodes\VideoShortcode::class);
            Shortcodes::add('quote', \App\Shortcodes\Quote::class);
        }
    }
}

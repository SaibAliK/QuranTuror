<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // dd(setting());
        // updateSlugs();
        // dd("Ok");
        // tutorAmount();
        // dd(time_dropdown());
        Schema::defaultStringLength(191);
        Blade::if('routeis', function ($expression) {
            return fnmatch($expression, Route::currentRouteName());
        });
    }


}

<?php

namespace App\Providers;

use App\View\Components\FilterPortico;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        if (env('APP_DEBUG') == false){
            \URL::forceScheme('https');
        }
        Paginator::useBootstrap();
        Blade::component('filter-portico', FilterPortico::class);
        Schema::defaultStringLength(255);
    }
}

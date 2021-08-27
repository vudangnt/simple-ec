<?php

namespace App\Providers;

use App\Models\Products;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.*', function($view){
            $view->with(
                ['viewProducts' => Products::select('name', 'id', 'price', 'special_price', 'slug')->with(['images', 'brand'])->get()]
            );
        });
    }
}

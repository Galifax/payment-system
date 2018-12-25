<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Currency;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $currencies = Currency::all();
        \View::share(
            [
                'currencies' => $currencies,
            ]
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

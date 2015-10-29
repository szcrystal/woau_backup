<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('future', function($attribute, $value, $parameters) {
            return strtotime($value) < time();
        });
        
        Validator::extend('date_check', function($attribute, $value, $parameters) {
            $dp = date_parse_from_format('Y-m-d', $value); //dateからパースする関数 おかしい書式にはwarningが返されるのでそれを利用
            return $dp['warning_count'] == 0;
        });
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

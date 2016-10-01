<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 自定义总运单号验证规则（模七验证）
        Validator::extend('ismawb', function($attribute, $value) {

            $mawb7 = substr($value,4,7);
            $mawb8 = substr($value, 11,1);
            if($mawb7%7==$mawb8){
                return true;
            }else{
                return false;
            }
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

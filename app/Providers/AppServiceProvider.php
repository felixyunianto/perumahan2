<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Schema;
use App\Customer;
use App\Filing;

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
        Schema::defaultStringLength(191);
        if(!Schema::hasTable('customers')){
            return;
        }else{
            $notYet = Customer::with('filing')->where('file_status', 0)->whereNotNull('utj_status')->get();
            View::share('notYet', $notYet);
        }
        
    }
}

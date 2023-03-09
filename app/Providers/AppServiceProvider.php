<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // dd(config('roles.Roles'));
        View::composer('*', function ($view) {
            if (Auth::guard('emp')->user()) {
                // $User ="emp";
                $User = Auth::guard('emp')->user();
            } elseif (Auth::guard('cli')->user()) {
                // $User ="dr";
                $User = Auth::guard('cli')->user();
            } else {
                $User = null;
            }
            $view->with('User', $User);
            $view->with('Local', app()->getLocale());
            $view->with('Sys', include config_path('setting.php'));
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('auth.user', function () {
            $prop = [];

            if (Auth::user()) {
                $prop = [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                ];
            }

             return $prop;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

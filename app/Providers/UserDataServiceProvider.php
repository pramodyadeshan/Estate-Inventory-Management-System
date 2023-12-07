<?php

namespace App\Providers;

use App\Models\Conference;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
class UserDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
            $users = User::all();
            $view->with('allUsers', $users);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

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

        View::composer('*', function ($view) {
            $conferences = Conference::orderBy('created_at', 'DESC')->first();
            $view->with('Allconferences', $conferences);
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;

use App\Models\Message; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        
        Gate::define('delete-admin-message', function ($user) {
            return $user->status->name === 'admin';
        });

        Gate::define('show-my-message', function ($user, Message $message) {
            return $user->id === $message->user_id;
        });
    }
}

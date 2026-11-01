<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\ServiceProvider;

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
        //admin gate
        Gate::define('admin', function(User $user){
            return $user->role=== 'admin';
        });

        //Schrijver van de review of admin mag de review verwijderen
        Gate::define('delete-review', function (User $user, Review $review){
            return $user->id === $review->user_id || $user->role === 'admin';
         });

        Gate::define('update-review', function (User $user, Review $review){
            return $user->id === $review->user_id;
        });
    }
}

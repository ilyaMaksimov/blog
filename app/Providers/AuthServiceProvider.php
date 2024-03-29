<?php

namespace App\Providers;

use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('author-comment', function (User $user, User $authorComent) {
            return $user->getId() == $authorComent->getId();
        });

        Gate::define('admin-panel', function () {
            return Auth::user()->isAdmin();
        });
    }
}

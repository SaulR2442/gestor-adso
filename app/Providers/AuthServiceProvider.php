<?php

namespace App\Providers;

use App\Models\Aprendiz;
use App\Models\User;
use App\Policies\AprendizPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Aprendiz::class => AprendizPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-users', fn (User $user) => $user->isAdmin());
    }
}

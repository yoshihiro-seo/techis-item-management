<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use PHPUnit\Event\Telemetry\Php83GarbageCollectorStatusProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        //
    ];

    /**
     * Register any authentication / authorization services.
     * 
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // 管理者に許可
        Gate::define('admin-higher', function ($user) {
            return ($user->role = 1);
        });
        // 一般ユーザー以上に許可
        Gate::define('user-higher', function ($user) {
            return ($user->role = 0);
        });
    }
}

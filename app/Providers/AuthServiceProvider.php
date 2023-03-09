<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        foreach (config('roles.Roles') as $k => $value) {
            foreach ($value as $key => $sue) {
                $role = "$k-$key";
                Gate::define($role, function ($User) use ($role) {
                    return $User->hasApility($role);
                });
            }
        }
        // dd($rr);
    }
}

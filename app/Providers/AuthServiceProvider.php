<?php

namespace App\Providers;

use App\Role;
use App\User;
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

        $user = \Auth::user();

        
        // Auth gates for: Roles and users
        Gate::define('roles_and_user_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

        // Auth gates for: Project management
        Gate::define('project_management_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('project_management_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6]);
        });
        Gate::define('project_management_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6]);
        });
        Gate::define('project_management_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('project_management_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6]);
        });

        // Auth gates for: Employee management
        Gate::define('employee_management_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

        // Auth gates for: Attandance
        Gate::define('attandance_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('attandance_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('attandance_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('attandance_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('attandance_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });


        Gate::define('notice_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('notice_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6, 7, 8]);
        });
        Gate::define('notice_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('notice_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('notice_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });


        // Auth gates for: Departments
        Gate::define('department_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('department_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

        Gate::define('department_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('department_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('department_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

        // Auth gates for: Salery
        Gate::define('salery_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('salery_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('salery_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('salery_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('salery_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

    }
}

<?php

namespace App\Providers;

use App\Models\AttachStatusFiles;
use App\Models\Campanias;
use App\Models\Clientes;
use App\Models\Espacios;
use App\Models\Roles;
use App\Models\User;
use App\Policies\AttachFilePolicy;
use App\Policies\CampaniaPolicy;
use App\Policies\ClientePolicy;
use App\Policies\EspacioPolicy;
use App\Policies\RolesPolicy;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class,
        Clientes::class => ClientePolicy::class,
        Campanias::class => CampaniaPolicy::class,
        Espacios::class => EspacioPolicy::class,
        Roles::class => RolesPolicy::class,
        AttachStatusFiles::class => AttachFilePolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('update-campania', [CampaniaPolicy::class, 'update']);
        //
    }
}
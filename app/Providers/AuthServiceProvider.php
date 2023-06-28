<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\AnexoChamadoInterno;
use App\Models\ChamadoInterno;
use App\Models\MotivoChamado;
use App\Models\Ticket;
use App\Models\TituloTickets;
use App\Models\User;
use App\Policies\AnexoPolicy;
use App\Policies\ChamadoInternoPolicy;
use App\Policies\MotivoPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\TicketPolicy;
use App\Policies\UserPolicy;
use App\Policies\TituloTicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Permission::class                   => PermissionPolicy::class,
        Role::class                         => RolePolicy::class,
        User::class                         => UserPolicy::class,
        Ticket::class                       => TicketPolicy::class,
        ChamadoInterno::class               => ChamadoInternoPolicy::class,
        MotivoChamado::class                => MotivoPolicy::class,
        TituloTickets::class                => TituloTicketPolicy::class,
     ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}

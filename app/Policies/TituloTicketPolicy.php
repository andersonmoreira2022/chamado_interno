<?php

namespace App\Policies;

use App\Models\TituloTickets;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TituloTicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(
            [
                'super-administrator',
                'super_admin',
                'administrator',
                'developer'
            ]
        );
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TituloTickets  $tituloTickets
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TituloTickets $tituloTickets)
    {
        return $user->hasAnyRole(
            [
                'super-administrator',
                'super_admin',
                'administrator',
                'developer'
            ]
        );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(
            [
                'super-administrator',
                'super_admin',
                'administrator',
                'developer'
            ]
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TituloTickets  $tituloTickets
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TituloTickets $tituloTickets)
    {
        return $user->hasAnyRole(
            [
                'super-administrator',
                'super_admin',
                'administrator',
                'developer'
            ]
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TituloTickets  $tituloTickets
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TituloTickets $tituloTickets)
    {
        return $user->hasAnyRole(
            [
                'super-administrator',
                'super_admin',
                'administrator',
                'developer'
            ]
        );
    }

}

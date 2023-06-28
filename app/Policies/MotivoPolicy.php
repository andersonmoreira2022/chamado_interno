<?php

namespace App\Policies;

use App\Models\MotivoChamado;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MotivoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
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
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
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
     * @param \App\Models\User $user
     * @param \App\Models\MotivoChamado $motivoChamado
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MotivoChamado $motivoChamado)
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
     * @param \App\Models\User $user
     * @param \App\Models\MotivoChamado $motivoChamado
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MotivoChamado $motivoChamado)
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

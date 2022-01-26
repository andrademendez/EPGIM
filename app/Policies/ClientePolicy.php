<?php

namespace App\Policies;

use App\Models\Clientes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
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
        //
        return $user->isAdmin() || $user->isValidator();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Clientes $clientes)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
        return $user->isValidator() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Clientes $clientes)
    {
        //
        return $user->isValidator() || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        //
        return $user->isValidator() || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Clientes $clientes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Clientes $clientes)
    {
        //
    }
}
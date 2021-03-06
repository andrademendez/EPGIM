<?php

namespace App\Policies;

use App\Models\Campanias;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaniaPolicy
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
        return $user->isAdmin() || $user->isValidator() || $user->isCreator() || $user->isMonitor();;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campanias  $campanias
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        //
        return $user->isAdmin() || $user->isValidator();
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
        return $user->isCreator() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campanias  $campanias
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Campanias $campanias)
    {
        //
        return $user->id === $campanias->id_user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campanias  $campanias
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Campanias $campanias)
    {
        //
        return $user->id === $campanias->id_user;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campanias  $campanias
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Campanias $campanias)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campanias  $campanias
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Campanias $campanias)
    {
        //
        return $user->id === $campanias->id_user;
    }
}
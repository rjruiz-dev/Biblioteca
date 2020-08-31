<?php

namespace App\Policies;

use App\User;
use App\Multimedia;
use Illuminate\Auth\Access\HandlesAuthorization;

class MultimediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the multimedia.
     *
     * @param  \App\User  $user
     * @param  \App\Multimedia  $multimedia
     * @return mixed
     */
    public function view(User $user, Multimedia $multimedia)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('View multimedia');
    }

    /**
     * Determine whether the user can create multimedia.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Create multimedia');
    }

    /**
     * Determine whether the user can update the multimedia.
     *
     * @param  \App\User  $user
     * @param  \App\Multimedia  $multimedia
     * @return mixed
     */
    public function update(User $user, Multimedia $multimedia)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Update multimedia');
    }

    /**
     * Determine whether the user can delete the multimedia.
     *
     * @param  \App\User  $user
     * @param  \App\Multimedia  $multimedia
     * @return mixed
     */
    public function delete(User $user, Multimedia $multimedia)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Delete multimedia');
    }

    public function copy(User $user, Multimedia $multimedia)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Copy');
    }

    public function status(User $user, Multimedia $multimedia)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Status');
    }

    public function desidherata(User $user, Multimedia $multimedia)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Desidherata');
    }

    public function download(User $user, Multimedia $multimedia)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Download');
    }

    /**
     * Determine whether the user can restore the multimedia.
     *
     * @param  \App\User  $user
     * @param  \App\Multimedia  $multimedia
     * @return mixed
     */
    public function restore(User $user, Multimedia $multimedia)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the multimedia.
     *
     * @param  \App\User  $user
     * @param  \App\Multimedia  $multimedia
     * @return mixed
     */
    public function forceDelete(User $user, Multimedia $multimedia)
    {
        //
    }
}

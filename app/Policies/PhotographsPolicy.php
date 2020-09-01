<?php

namespace App\Policies;

use App\User;
use App\Photography;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotographsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the photography.
     *
     * @param  \App\User  $user
     * @param  \App\Photography  $photography
     * @return mixed
     */
    public function view(User $user, Photography $photography)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('View movies');
    }

    /**
     * Determine whether the user can create photographies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Create movies');
    }

    /**
     * Determine whether the user can update the photography.
     *
     * @param  \App\User  $user
     * @param  \App\Photography  $photography
     * @return mixed
     */
    public function update(User $user, Photography $photography)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Update movies');
    }

    /**
     * Determine whether the user can delete the photography.
     *
     * @param  \App\User  $user
     * @param  \App\Photography  $photography
     * @return mixed
     */
    public function delete(User $user, Photography $photography)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Delete movies');
    }

    public function copy(User $user, Photography $photography)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Copy');
    }

    public function status(User $user, Photography $photography)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Status');
    }

    public function desidherata(User $user, Photography $photography)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Desidherata');
    }

    public function download(User $user, Photography $photography)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Download');
    }
    /**
     * Determine whether the user can restore the photography.
     *
     * @param  \App\User  $user
     * @param  \App\Photography  $photography
     * @return mixed
     */
    public function restore(User $user, Photography $photography)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the photography.
     *
     * @param  \App\User  $user
     * @param  \App\Photography  $photography
     * @return mixed
     */
    public function forceDelete(User $user, Photography $photography)
    {
        //
    }
}

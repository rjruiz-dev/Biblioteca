<?php

namespace App\Policies;

use App\User;
use App\Music;
use Illuminate\Auth\Access\HandlesAuthorization;

class MusicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the music.
     *
     * @param  \App\User  $user
     * @param  \App\Music  $music
     * @return mixed
     */
    public function view(User $user, Music $music)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('View movies');
    }

    /**
     * Determine whether the user can create music.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Create movies');
    }

    /**
     * Determine whether the user can update the music.
     *
     * @param  \App\User  $user
     * @param  \App\Music  $music
     * @return mixed
     */
    public function update(User $user, Music $music)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Update movies');
    }

    /**
     * Determine whether the user can delete the music.
     *
     * @param  \App\User  $user
     * @param  \App\Music  $music
     * @return mixed
     */
    public function delete(User $user, Music $music)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Delete movies');
    }

    public function copy(User $user, Music $music)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Copy');
    }

    public function status(User $user, Music $music)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Status');
    }

    public function desidherata(User $user, Music $music)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Desidherata');
    }

    public function download(User $user, Music $music)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Download');
    }
    /**
     * Determine whether the user can restore the music.
     *
     * @param  \App\User  $user
     * @param  \App\Music  $music
     * @return mixed
     */
    public function restore(User $user, Music $music)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the music.
     *
     * @param  \App\User  $user
     * @param  \App\Music  $music
     * @return mixed
     */
    public function forceDelete(User $user, Music $music)
    {
        //
    }
}

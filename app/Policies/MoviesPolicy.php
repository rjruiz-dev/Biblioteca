<?php

namespace App\Policies;

use App\User;
use App\Movies;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviesPolicy
{
    use HandlesAuthorization;

    // public function before($user)
    // {
    //     if($user->hasRole('Admin'))
    //     {
    //        return true;
    //     }      
    // }

    /**
     * Determine whether the user can view the movies.
     *
     * @param  \App\User  $user
     * @param  \App\Movies  $movies
     * @return mixed
     */
    public function view(User $user, Movies $movies)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View movies');
    }

    
    /**
     * Determine whether the user can create movies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Create movies');
    }

    /**
     * Determine whether the user can update the movies.
     *
     * @param  \App\User  $user
     * @param  \App\Movies  $movies
     * @return mixed
     */
    public function update(User $user, Movies $movies)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update movies');
    }

    /**
     * Determine whether the user can delete the movies.
     *
     * @param  \App\User  $user
     * @param  \App\Movies  $movies
     * @return mixed
     */
    public function delete(User $user, Movies $movies)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete movies');
    }

    public function copy(User $user, Movies $movies)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Copy');
    }

    public function status(User $user, Movies $movies)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Status');
    }

    public function desidherata(User $user, Movies $movies)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Desidherata');
    }

    public function download(User $user, Movies $movies)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Download');
    }

    /**
     * Determine whether the user can restore the movies.
     *
     * @param  \App\User  $user
     * @param  \App\Movies  $movies
     * @return mixed
     */
    public function restore(User $user, Movies $movies)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the movies.
     *
     * @param  \App\User  $user
     * @param  \App\Movies  $movies
     * @return mixed
     */
    public function forceDelete(User $user, Movies $movies)
    {
        //
    }
}

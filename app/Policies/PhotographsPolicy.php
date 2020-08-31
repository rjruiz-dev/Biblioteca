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
        //
    }

    /**
     * Determine whether the user can create photographies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
        //
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

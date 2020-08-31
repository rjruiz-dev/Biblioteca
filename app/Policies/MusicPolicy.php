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
        //
    }

    /**
     * Determine whether the user can create music.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
        //
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

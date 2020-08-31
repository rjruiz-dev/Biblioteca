<?php

namespace App\Policies;

use App\User;
use App\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BooksPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the book.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function view(User $user, Book $book)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('View books');
    }

    /**
     * Determine whether the user can create books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Create books');
    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Update books');
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function delete(User $user, Book $book)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Delete books');
    }

    public function copy(User $user, Book $book)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Copy');
    }

    public function status(User $user, Book $book)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Status');
    }

    public function desidherata(User $user, Book $book)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Desidherata');
    }

    public function download(User $user, Book $book)
    {
        return $user->hasRole('Admin') || $user->hasRole('Librarian') || $user->hasPermissionTo('Download');
    }

    /**
     * Determine whether the user can restore the book.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function restore(User $user, Book $book)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the book.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function forceDelete(User $user, Book $book)
    {
        //
    }
}

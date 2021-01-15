<?php

namespace App\Policies\Family;

use App\User;
use App\Family\Todo;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Family\Todo  $todo
     * @return mixed
     */
    public function view(User $user, Todo $todo)
    {
        return !$todo->isPrivate()
                || ($todo->created_by === $user->id);
    }

    /**
     * Determine whether the user can create todos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Family\Todo  $todo
     * @return mixed
     */
    public function update(User $user, Todo $todo)
    {
        return !$todo->isPrivate()
                || ($todo->created_by === $user->id);
    }

    /**
     * Determine whether the user can delete the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Family\Todo  $todo
     * @return mixed
     */
    public function delete(User $user, Todo $todo)
    {
        return !$todo->isPrivate()
            || ($todo->created_by === $user->id);
    }

    /**
     * Determine whether the user can restore the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Family\Todo  $todo
     * @return mixed
     */
    public function restore(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Family\Todo  $todo
     * @return mixed
     */
    public function forceDelete(User $user, Todo $todo)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function create(User $user)
    {
        return $user->can('posts.create');
    }

    public function update(User $user, Post $post)
    {
        return $user->can('posts.update');
    }

    public function delete(User $user, Post $post)
    {
        return $user->can('posts.delete');
    }

    public function viewAny(?User $user)
    {
        return true; // عمومی
    }
    public function view(?User $user, Post $post)
    {
        // اگر منتشر شده → همه ببینن
        if ($post->published) {
            return true;
        }

        // اگر منتشر نشده → فقط admin
        return $user && $user->can('posts.update');
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }
}

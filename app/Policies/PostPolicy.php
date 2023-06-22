<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Personne;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update()
    {
        // return $user->id === $post->user_id;
        Gate::define('update', function(GenericUser $user, Personne $personne){
            return $user->id !== $personne->user_id;
        }
    );
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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


    public function viewAll(User $user_logged)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une personne
        if ($user_logged->hasPermissionTo('voir_users') || $user_logged->hasPermissionTo('*')) {
            return true;
        }
    }

    public function create(User $user_logged)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une user
        if ($user_logged->hasPermissionTo('ajouter_user') || $user_logged->hasPermissionTo('*')) {
            return true;
        }
    }

    public function update(User $user_logged)
    {
        if ($user_logged->id != 0) {
            return abort(403, 'You Can\'t Update This Account');
        }

        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une user
        if ($user_logged->hasPermissionTo('modifier_user') || $user_logged->hasPermissionTo('*')) {
            return true;
        }
    }

    public function destroy(User $user_logged, User $user)
    {
        if ($user->id == 0) {
            return abort(403, 'You Can\'t Delete This Account');
        }

        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user_logged->hasPermissionTo('supprimer_user') || $user_logged->hasPermissionTo('*')) {
            return true;
        }
    }
}

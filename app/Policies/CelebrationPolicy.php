<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CelebrationPolicy
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
    
    
    public function viewAll(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une personne
        if ($user->hasPermissionTo('voir_celebrations') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une user
        if ($user->hasPermissionTo('ajouter_celebration') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une user
        if ($user->hasPermissionTo('modifier_celebration') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasPermissionTo('supprimer_celebration') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }
}

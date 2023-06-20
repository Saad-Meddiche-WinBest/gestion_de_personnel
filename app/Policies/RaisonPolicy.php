<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reason;
use Illuminate\Auth\Access\HandlesAuthorization;

class RaisonPolicy
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
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une raison
        if ($user->hasPermissionTo('voir_raisons') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

   


    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une raison
        if ($user->hasPermissionTo('ajouter_raison') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une raison
        if ($user->hasPermissionTo('modifier_raison') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une raison
        if ($user->hasPermissionTo('supprimer_raison') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }


}

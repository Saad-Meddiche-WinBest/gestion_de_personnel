<?php

namespace App\Policies;

use App\Models\Poste;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostePolicy
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
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une poste
        if ($user->hasPermissionTo('voir_postes') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }


    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une poste
        if ($user->hasPermissionTo('ajouter_poste') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une poste
        if ($user->hasPermissionTo('modifier_poste') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une poste
        if ($user->hasPermissionTo('supprimer_poste') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }


}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Personne;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonnePolicy
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
        if ($user->hasPermissionTo('voir_personnes') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

   


    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une personne
        if ($user->hasPermissionTo('ajouter_personne') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une personne
        if ($user->hasPermissionTo('modifier_personne') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une personne
        if ($user->hasPermissionTo('supprimer_personne') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }



}

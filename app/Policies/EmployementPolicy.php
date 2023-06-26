<?php

namespace App\Policies;

use App\Models\Employement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployementPolicy
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
        if ($user->hasPermissionTo('voir_employements') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une employement
        if ($user->hasPermissionTo('ajouter_employement') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une employement
        if ($user->hasPermissionTo('modifier_employement') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une employement
        if ($user->hasPermissionTo('supprimer_employement') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

}

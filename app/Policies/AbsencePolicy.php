<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Absence;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbsencePolicy
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
        if ($user->hasPermissionTo('voir_absences') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    

    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une absence
        if ($user->hasPermissionTo('ajouter_absence') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une absence
        if ($user->hasPermissionTo('modifier_absence') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une absence
        if ($user->hasPermissionTo('supprimer_absence') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }


}

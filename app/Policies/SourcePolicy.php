<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Source;
use Illuminate\Auth\Access\HandlesAuthorization;

class SourcePolicy
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
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une source
        if ($user->hasPermissionTo('voir_sources') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    


    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une source
        if ($user->hasPermissionTo('ajouter_source') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une source
        if ($user->hasPermissionTo('modifier_source') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une source
        if ($user->hasPermissionTo('supprimer_source') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

}

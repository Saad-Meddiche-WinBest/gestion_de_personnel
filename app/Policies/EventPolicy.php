<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
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
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une event
        if ($user->hasPermissionTo('voir_events') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

   


    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une event
        if ($user->hasPermissionTo('ajouter_event') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une event
        if ($user->hasPermissionTo('modifier_event') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une event
        if ($user->hasPermissionTo('supprimer_event') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }
}

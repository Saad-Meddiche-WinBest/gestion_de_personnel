<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        if ($user->hasPermissionTo('voir_roles') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une user
        if ($user->hasPermissionTo('ajouter_role') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une user
        if ($user->hasPermissionTo('modifier_role') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasPermissionTo('supprimer_role') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function assignRole(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasPermissionTo('affecter_roles') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    
    public function revokeRole(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasPermissionTo('retirer_roles') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    public function viewAllP(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une personne
        if ($user->hasPermissionTo('voir_permissions') || $user->hasPermissionTo('*') ) {
            return true;
        }
    } 
    public function assignPermission(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasPermissionTo('affecter_permissions') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

    
    public function revokePermission(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasPermissionTo('retirer_permissions') || $user->hasPermissionTo('*') ) {
            return true;
        }
    }

}

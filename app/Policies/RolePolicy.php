<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
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
        if ($user->hasPermissionTo('voir_roles') || $user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une user
        if ($user->hasPermissionTo('ajouter_role') || $user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function update(User $user, Role $role)
    {
        //Do not Grand The Access If The Role Is Owner
        if ($role->id == 1) {
            return abort(403, "You can't Modife This Role ");
        }
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une user
        if ($user->hasAnyPermission(['modifier_role', '*'])) {
            return true;
        }
    }

    public function destroy(User $user, Role $role)
    {
        //Do not Grand The Access If The Role Is Owner
        if ($role->id == 1) {
            return abort(403, "You can't Change The Permissions Of This Role ");
        }

        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasAnyPermission(['supprimer_role', '*'])) {
            return true;
        }
    }

    public function assignRole(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasAnyPermission(['affecter_roles', '*'])) {
            return true;
        }
    }


    public function revokeRole(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasAnyPermission(['retirer_roles', '*'])) {
            return true;
        }
    }

    public function viewAllP(User $user, Role $role)
    {

        //Do not Grand The Access If The Role Is Owner
        if ($role->id == 1) {
            return abort(403, "You can't Change The Permissions Of This Role ");
        }
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une personne
        if ($user->hasAnyPermission(['voir_permissions', '*'])) {
            return true;
        }
    }
    public function assignPermission(User $user, Role $role)
    {
        //Do not Grand The Access If The Role Is Owner
        if ($role->id == 1) {
            return abort(403, "You can't Assign Permission To This Role");
        }

        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasAnyPermission(['affecter_permissions', '*'])) {
            return true;
        }
    }


    public function revokePermission(User $user, Role $role)
    {
        //Do not Grand The Access If The Role Is Owner
        if ($role->id == 1) {
            return abort(403, "You can't Revoce Permission Of This Role");
        }

        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une user
        if ($user->hasAnyPermission(['retirer_permissions', '*'])) {
            return true;
        }
    }
}

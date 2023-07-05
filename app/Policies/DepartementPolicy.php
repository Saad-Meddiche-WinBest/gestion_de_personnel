<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartementPolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user)
    {
        if ($user->hasPermissionTo('voir_services') || $user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->hasPermissionTo('ajouter_service') || $user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->hasPermissionTo('modifier_service') || $user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        if ($user->hasPermissionTo('supprimer_service') || $user->hasPermissionTo('*')) {
            return true;
        }
    }
}

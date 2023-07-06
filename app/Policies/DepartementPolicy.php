<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartementPolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user)
    {
        if ($user->hasAnyPermission(['*', 'voir_departements'])) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->hasAnyPermission(['*', 'ajouter_departement'])) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->hasAnyPermission(['*', 'modifier_departement'])) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        if ($user->hasAnyPermission(['*', 'supprimer_departement'])) {
            return true;
        }
    }
}

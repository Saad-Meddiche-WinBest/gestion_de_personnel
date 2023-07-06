<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BanPolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user)
    {
        if ($user->hasAnyPermission(['*', 'voir_bans'])) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->hasAnyPermission(['*', 'ajouter_ban'])) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->hasAnyPermission(['*', 'modifier_ban'])) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        if ($user->hasAnyPermission(['*', 'supprimer_ban'])) {
            return true;
        }
    }
}

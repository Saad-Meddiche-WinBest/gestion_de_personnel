<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BanPolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user)
    {
        if ($user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        if ( $user->hasPermissionTo('*')) {
            return true;
        }
    }
}

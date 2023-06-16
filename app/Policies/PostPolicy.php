<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;
class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function before($user)
    {
        if ($user->isAdmin()) {
            return true; // L'administrateur a toujours accès
        }
    }

    public function create(User $user)
    {
        return false; // Seul l'administrateur peut créer des rôles
    }

    public function assign(User $user, Role $role)
    {
        return $user->hasRole('admin'); // Seul l'administrateur peut affecter des rôles
    }

    public function revoke(User $user, Role $role)
    {
        return $user->hasRole('admin'); // Seul l'administrateur peut retirer des rôles
    }
}

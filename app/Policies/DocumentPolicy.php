<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user)
    {
        if ($user->hasAnyPermission(['*', 'voir_documents'])) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->hasAnyPermission(['*', 'ajouter_document'])) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->hasAnyPermission(['*', 'modifier_document'])) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        if ($user->hasAnyPermission(['*', 'supprimer_document'])) {
            return true;
        }
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user)
    {
        if ($user->hasAnyPermission(['*', 'voir_notes'])) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->hasAnyPermission(['*', 'ajouter_note'])) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->hasAnyPermission(['*', 'modifier_note'])) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        if ($user->hasAnyPermission(['*', 'supprimer_note'])) {
            return true;
        }
    }
}

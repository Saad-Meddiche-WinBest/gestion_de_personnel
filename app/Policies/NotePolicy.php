<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour voir les une note
        if ($user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function create(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour ajouter les une note
        if ($user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function update(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour modifier les une note
        if ($user->hasPermissionTo('*')) {
            return true;
        }
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur a la permission spécifique pour supprimer les une note
        if ($user->hasPermissionTo('*')) {
            return true;
        }
    }
}

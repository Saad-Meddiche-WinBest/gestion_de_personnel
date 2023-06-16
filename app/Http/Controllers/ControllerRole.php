<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
class ControllerRole extends Controller
{
    //
    public function assignRole(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $role_id = $request->role_id;
    
        $user = User::find($user_id);
        $role = Role::find($role_id);
        $user->assignRole($role);
        // Autres opérations ou redirections après l'assignation du rôle
        return view('dashboard')->with('user_id', $user_id);
    }

    
}

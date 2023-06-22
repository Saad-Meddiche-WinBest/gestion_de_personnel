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

        $notifications = auth()->user()->unreadNotifications;

        // Autres opérations ou redirections après l'assignation du rôle
        //  return back()->with([
        // 'success' => 'Le rôle a été attribué avec succès.'
        // ])->with(compact('notifications', 'user_id'));

        return view('dashboard', compact('notifications'));
    }


    public function revokeRole(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $role_id = $request->role_id;

        $user = User::find($user_id);
        $role = Role::find($role_id);
        $user->removeRole($role);

        $notifications = auth()->user()->unreadNotifications;

        // Autres opérations ou redirections après la révocation du rôle
        // return back()->with([
        //     'success' => 'Le rôle a été retiré avec succès.'
        //     ])->with(compact('notifications', 'user_id'));

        return view('dashboard', compact('notifications'));
    }
}

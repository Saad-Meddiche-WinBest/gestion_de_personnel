<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PostController extends Controller
{
    //
    public function create()
    {
        $this->authorize('create', Role::class);

        return view('create');
    }

    public function store(Request $request)
    {
        $this->authorize('createe', Role::class);

        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create(['name' => $request->name]);

        return redirect()->route('index1')->with('success', 'Role created successfully.');
    }

    public function assign(Role $role)
    {
        $this->authorize('assign', Role::class);

        $users = User::all();

        return view('assign', compact('role', 'users'));
    }

    public function storeRole(Request $request, Role $role)
    {
        $this->authorize('assign', Role::class);

        $request->validate([
            'users' => 'required|array',
        ]);

        $role->syncPermissions($request->permissions);
        $role->users()->sync($request->users);

        return redirect()->route('index1')->with('success', 'Roles assigned successfully.');
    }

    public function revoke(Role $role)
    {
        $this->authorize('revoke', Role::class);

        $users = $role->users;

        return view('revoke', compact('role', 'users'));
    }

    public function revokeRole(Request $request, Role $role)
    {
        $this->authorize('revoke', Role::class);

        $request->validate([
            'users' => 'required|array',
        ]);

        $role->users()->detach($request->users);

        return redirect()->route('index1')->with('success', 'Roles revoked successfully.');
    }

}

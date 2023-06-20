<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleContrll extends Controller
{
    //
    public function index()
    {
        $roles = Role::all(); // Récupérer tous les rôles depuis la base de données
        return view('roles', compact('roles'));
    }

    public function create()
    {
        return view('createRoles');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire de création
        $validatedData = $request->validate([
            'name' => 'required|string',
            
        ]);

        // Créer un nouveau rôle dans la base de données
        $role = Role::create($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit(Request $request, $id)
{
    $role = Role::findOrFail($id);
    
    return view('editRoles', compact('role'));
}

    public function update(Request $request, Role $role)
    {
        // Valider les données du formulaire de modification
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        // Mettre à jour le rôle dans la base de données
        $role->update($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        // Supprimer le rôle de la base de données
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
   
    
  
}

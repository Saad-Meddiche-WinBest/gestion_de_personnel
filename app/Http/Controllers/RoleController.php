<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\DynamicValidation;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all(); // Récupérer tous les rôles depuis la base de données

        unset($roles[0]);

        $model = Role::class;

        $this->authorize('viewAll', Role::class);

        return view('roles', compact('roles'));
    }

    public function create()
    {
        $model = Role::class;
        $this->authorize('create', $model);
        return view('createRoles');
    }

    public function store(DynamicValidation $request)
    {
        $validatedData  = $request->validated();

        $this->authorize('create', Role::class);

        // Créer un nouveau rôle dans la base de données
        Role::create($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $model = Role::class;
        $this->authorize('update', [$model, $role]);
        return view('editRoles', compact('role'));
    }

    public function update(DynamicValidation $request, Role $role)
    {
        $validatedData  = $request->validated();

        $this->authorize('update', [Role::class, $role]);

        // Mettre à jour le rôle dans la base de données
        $role->update($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        // Supprimer le rôle de la base de données

        $model = Role::class;
        $this->authorize('destroy', [$model, $role]);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

    public function permission(Request $request, Role $role_id)
    {
      
        $permissions = Permission::all();
        $role = $request->role_id;
        $model = Role::class;


        $this->authorize('viewAllP', [$model, $role_id]);

        return view('permission', compact('permissions', 'role_id', 'role'));
    }

    public function assignPermission(Request $request)
    {
        // $role_id = $request->role_id;
        // $permission_id = $request->permission_id;
        // $role = Role::find($role_id);
        // $permission = Permission::find($permission_id);
        // $role->assignPermission($permission);
        // $table = 'permissions';
        // $model = 'permission';
        // dd($model);
        // return back()->with([
        //     'table' => $table,
        //     'model' => $model,
        // ])->with('success', 'Le rôle a été affecter avec succès.');



        // $role = Role::findOrFail($role_id);
        // // Get the permissions selected through the form
        // $permissionIds = $request->input('permissions', []);

        // // Retrieve the permissions
        // $permissions = Permission::whereIn('id', $permissionIds)->get();

        // // Sync the permissions with the role
        // $role->givePermissionTo($permissions);
        // return view('permission', compact('role_id'));




        $role_id = $request->role_id;
        $permissions = Permission::all();
        $permission_id = $request->permission_id;

        $role = Role::find($role_id);
        $permission = Permission::find($permission_id);
        $model = Role::class;
        $this->authorize('assignPermission', [$model, $role]);
        // Recherche de la permission par son nom

        // Affecter la permission au rôle
        $role->givePermissionTo($permission);
        //return view('permission', compact('role_id','permissions'));

        return back()->with([
            'role_id' => $role_id,
            'permissions' => $permissions,
        ])->with('success', 'La permission a été affecter avec succès.');
    }

    public function revokePermission(Request $request)
    {
        $role_id = $request->role_id;
        $permissions = Permission::all();
        $permission_id = $request->permission_id;
        $role = Role::find($role_id);
        $permission = Permission::find($permission_id);
        $model = Role::class;
        $this->authorize('revokePermission', [$model, $role]);
        // Recherche de la permission par son nom

        // Affecter la permission au rôle
        $role->revokePermissionTo($permission);;
        //return view('permission', compact('role_id','permissions'));

        return back()->with([
            'role_id' => $role_id,
            'permissions' => $permissions,
        ])->with('success', 'La permission a été retirer avec succès.');
    }

    public function assignRole(Request $request)
    {

        $user_id = $request->user_id;
        $role_id = $request->role_id;
        $user = User::find($user_id);
        $role = Role::find($role_id);
        $user->assignRole($role);

        $name_of_model = "role";
        $name_of_table = "roles";
        $notifications = auth()->user()->unreadNotifications;

        $model = 'App\\Models\\' . ucfirst($name_of_model);
        $this->authorize('assignRole', $model);

        $test = 'test';

        return back()->with([
            'name_of_model' => $name_of_model,
            'notifications' => $notifications,
            'test' => $test,
        ])->with('success', 'Le rôle a été affecter avec succès.');
    }

    public function revokeRole(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $user = User::find($user_id);
        $role = Role::find($role_id);
        $user->removeRole($role);


        $name_of_model = "role";
        $name_of_table = "roles";
        $notifications = auth()->user()->unreadNotifications;
        $model = 'App\\Models\\' . ucfirst($name_of_model);
        $this->authorize('revokeRole', $model);
        $test = 'test';


        // Autres opérations ou redirections après l'assignation du rôle
        //  return back()->with([
        // 'success' => 'Le rôle a été attribué avec succès.'
        // ])->with(compact('notifications', 'user_id'));

        return back()->with([
            'name_of_model' => $name_of_model,
            'notifications' => $notifications,
            'test' => $test,
        ])->with('success', 'Le rôle a été retiré avec succès.');
    }

    public function voir_roles_utilisateur(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);
        $roles = $user->getRoleNames();

        $data_of_table = Role::whereIn('name', $roles)->get();

        $name_of_model = $request->name_of_model;
        $name_of_table = $request->name_of_model . 's';


        $this->authorize('viewAllP', Role::class);

        return view('index', compact('data_of_table', 'name_of_model', 'user'));
    }

    public function show_Roles_Of_User(Request $request, User $user)
    {
        $rolesOfUser = $user->getRoleNames();
        $data_of_table = Role::whereNotIn('name', $rolesOfUser)->get();
        $name_of_table = 'roles';
        $name_of_model = 'role';

        $this->authorize('viewAll',  Role::class);

        return view('index', compact(['name_of_model', 'data_of_table', 'user']));
    }
}

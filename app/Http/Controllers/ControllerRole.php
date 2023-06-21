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
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        $user = User::find($user_id);
        $role = Role::find($role_id);
        $user->assignRole($role);
        $name_of_model= "role";
        $name_of_table ="roles";
        $notifications = auth()->user()->unreadNotifications;

        $test = 'test';
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }

        $data_of_table = $responce_data['content'];
        /*=====================================================================*/
    
        // Autres opérations ou redirections après l'assignation du rôle
        //  return back()->with([
        // 'success' => 'Le rôle a été attribué avec succès.'
        // ])->with(compact('notifications', 'user_id'));
        
        return back()->with([
            'data_of_table' => $data_of_table,
            'informations_of_columns' => $informations_of_columns,
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
    
        $name_of_model= "role";
        $name_of_table ="roles";
        $notifications = auth()->user()->unreadNotifications;

        $test = 'test';
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }

        $data_of_table = $responce_data['content'];
        /*=====================================================================*/
    
        // Autres opérations ou redirections après l'assignation du rôle
        //  return back()->with([
        // 'success' => 'Le rôle a été attribué avec succès.'
        // ])->with(compact('notifications', 'user_id'));
        
        return back()->with([
            'data_of_table' => $data_of_table,
            'informations_of_columns' => $informations_of_columns,
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
    
        $responce_columns = fetch_columns_of_table($name_of_table);
        $informations_of_columns = $responce_columns['content'];
    
        return view('index', compact('data_of_table', 'name_of_model', 'informations_of_columns','user'));
    } 
    
    

    
    public function show_Roles_Of_User(Request $request,User $user){
        $rolesOfUser = $user->getRoleNames();
        $data_of_table = Role::whereNotIn('name', $rolesOfUser)->get();
        $name_of_table = 'roles';
        $name_of_model= 'role';

        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
    
        /*=====================================================================*/
        return view('index', compact(['data_of_table', 'informations_of_columns', 'name_of_model','user']));
    }
    
   

    
}

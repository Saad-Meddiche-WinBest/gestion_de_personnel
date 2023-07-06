<?php

namespace App\Console\Commands;

use App\Models\Icon;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class creationRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $name_of_models = ['document', 'service', 'employement', 'source', 'poste', 'personne', 'absence', 'raison', 'event', 'user', 'role', 'departement', 'note', 'ban', 'celebration'];

        foreach ($name_of_models as $name_of_model) {
            ${"ajouter_" . $name_of_model} = Permission::create(['name' => 'ajouter_' . $name_of_model, 'guard_name' => 'web']);
            ${"modifier_" . $name_of_model} = Permission::create(['name' => 'modifier_' . $name_of_model, 'guard_name' => 'web']);
            ${"supprimer_" . $name_of_model} = Permission::create(['name' => 'supprimer_' . $name_of_model, 'guard_name' => 'web']);
            ${"voir_" . $name_of_model . "s"} = Permission::create(['name' => 'voir_' . $name_of_model . 's', 'guard_name' => 'web']);
        }

        $affecterRoles = Permission::create(['name' => 'affecter_roles', 'guard_name' => 'web']);
        $retirerRoles = Permission::create(['name' => 'retirer_roles', 'guard_name' => 'web']);
        $voirPermissions = Permission::create(['name' => 'voir_permissions', 'guard_name' => 'web']);
        $affecterPermissions = Permission::create(['name' => 'affecter_permissions', 'guard_name' => 'web']);
        $retirerPermisions = Permission::create(['name' => 'retirer_permissions', 'guard_name' => 'web']);

        $all = Permission::create(['name' => '*', 'guard_name' => 'web']);

        $accesToDashboard = Permission::create(['name' => 'acces_to_dashboard', 'guard_name' => 'web']);

        $owner = Role::create(['name' => 'owner', 'guard_name' => 'web']);

        $owner->givePermissionTo($all);


        $users = [
            ['name' => 'Owner', 'email' => 'owner@gmail.com', 'password' => Hash::make('123456789')],
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('123456789')],
            ['name' => 'aziz', 'email' => 'aziz@gmail.com', 'password' => Hash::make('123456789')]
        ];

        for ($i = 0; $i < count($users); $i++) {
            User::create($users[$i]);
        }

        $Owner_User = User::where('name', 'Owner')->first();

        $Owner_User->assignRole($owner);

        $icons = [
            ['nom' => 'https://th.bing.com/th/id/OIP.RJEdlV33eoLlVrcj3iTWkAHaHa?w=190&h=189&c=7&r=0&o=5&pid=1.7'],
            ['nom' => 'https://th.bing.com/th/id/OIP.0BDXkzYJAz1-iWQ4LqqsYAHaD4?w=299&h=180&c=7&r=0&o=5&pid=1.7'],
            ['nom' => 'https://th.bing.com/th/id/OIP.5SUhWWqg8sSvoML4a8qufgHaHa?w=190&h=190&c=7&r=0&o=5&pid=1.7'],
            ['nom' => 'https://th.bing.com/th/id/OIP.ckTRtMPIqUCiPLf4b4Ik5wHaHa?w=212&h=212&c=7&r=0&o=5&pid=1.7'],
        ];

        for ($i = 0; $i < count($icons); $i++) {
            Icon::create($icons[$i]);
        }
    }
}

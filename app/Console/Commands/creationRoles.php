<?php

namespace App\Console\Commands;
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
       
    $owner = Role::create(['name' => 'Owner', 'guard_name' => 'web']);
    $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
    //$admin2 = Role::create(['name' => 'Admin2', 'guard_name' => 'web']);

    $all = Permission::create(['name' => '*' , 'guard_name' => 'web']);

    $ajouterService = Permission::create(['name' => 'ajouter_service', 'guard_name' => 'web']);
    $ModifierService = Permission::create(['name' => 'modifier_service', 'guard_name' => 'web']);
    $SupprimerService = Permission::create(['name' => 'supprimer_service', 'guard_name' => 'web']);
    $voirService = Permission::create(['name' => 'voir_service', 'guard_name' => 'web']);

    $ajouterEmployement = Permission::create(['name' => 'ajouter_employement', 'guard_name' => 'web']);
    $ModifierEmployement = Permission::create(['name' => 'modifier_employement', 'guard_name' => 'web']);
    $SupprimerEmployent = Permission::create(['name' => 'supprimer_employement', 'guard_name' => 'web']);
    $voirEmployent = Permission::create(['name' => 'voir_employement', 'guard_name' => 'web']);

    $ajouterSource = Permission::create(['name' => 'ajouter_source', 'guard_name' => 'web']);
    $ModifierSource = Permission::create(['name' => 'modifier_source', 'guard_name' => 'web']);
    $SupprimerSource = Permission::create(['name' => 'supprimer_source', 'guard_name' => 'web']);
    $voirSource = Permission::create(['name' => 'voir_source', 'guard_name' => 'web']);

    $ajouterPoste = Permission::create(['name' => 'ajouter_poste', 'guard_name' => 'web']);
    $ModifierPoste = Permission::create(['name' => 'modifier_poste', 'guard_name' => 'web']);
    $SupprimerPoste = Permission::create(['name' => 'supprimer_poste', 'guard_name' => 'web']);
    $voirPoste = Permission::create(['name' => 'voir_poste', 'guard_name' => 'web']);

    $accesToDashboard = Permission::create(['name' => 'acces_to_dashboard' , 'guard_name' => 'web']);

    // Assigner les permissions aux rôles si nécessaire
    $owner->givePermissionTo($all);
    $admin->givePermissionTo($accesToDashboard);
    //$admin2->givePermissionTo($accesToDashboard);

    $users = [
        ['name' => 'Owner', 'email' => 'owner@gmail.com', 'password' => Hash::make('123456789')],
       ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('123456789')],
        //['name' => 'Admin2', 'email' => 'admin2@gmail.com', 'password' => Hash::make('123456789')]
    ];

    for ($i = 0; $i < count($users); $i++) {
        User::create($users[$i]);
    }

    $Admin_User = User::where('name', 'admin')->first();
    $Owner_User = User::where('name', 'Owner')->first();
    //$Admin2_User = User::where('name', 'Admin2')->first();
    
    $Owner_User->assignRole($owner); // Affecter le rôle à luti'lisateur
    $Admin_User->removeRole($admin); // Affecter le rôle à l'utilisateur
    //$Owner_User->removeRole($owner); // Affecter le rôle à l'utilisateur
    //$Admin2_User->assignRole($admin2); // Affecter le rôle à l'utilisateur
    
}
}
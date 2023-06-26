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
       
    $owner = Role::create(['name' => 'owner', 'guard_name' => 'web']);
    // $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
    $support = Role::create(['name' => 'support', 'guard_name' => 'web']);

    //$admin2 = Role::create(['name' => 'Admin2', 'guard_name' => 'web']);

    $all = Permission::create(['name' => '*' , 'guard_name' => 'web']);

    $ajouterService = Permission::create(['name' => 'ajouter_service', 'guard_name' => 'web']);
    $ModifierService = Permission::create(['name' => 'modifier_service', 'guard_name' => 'web']);
    $SupprimerService = Permission::create(['name' => 'supprimer_service', 'guard_name' => 'web']);
    $voirService = Permission::create(['name' => 'voir_services', 'guard_name' => 'web']);


    $ajouterEmployement = Permission::create(['name' => 'ajouter_employement', 'guard_name' => 'web']);
    $ModifierEmployement = Permission::create(['name' => 'modifier_employement', 'guard_name' => 'web']);
    $SupprimerEmployent = Permission::create(['name' => 'supprimer_employement', 'guard_name' => 'web']);
    $voirEmployent = Permission::create(['name' => 'voir_employements', 'guard_name' => 'web']);


    $ajouterSource = Permission::create(['name' => 'ajouter_source', 'guard_name' => 'web']);
    $ModifierSource = Permission::create(['name' => 'modifier_source', 'guard_name' => 'web']);
    $SupprimerSource = Permission::create(['name' => 'supprimer_source', 'guard_name' => 'web']);
    $voirSource = Permission::create(['name' => 'voir_sources', 'guard_name' => 'web']);


    $ajouterPoste = Permission::create(['name' => 'ajouter_poste', 'guard_name' => 'web']);
    $ModifierPoste = Permission::create(['name' => 'modifier_poste', 'guard_name' => 'web']);
    $SupprimerPoste = Permission::create(['name' => 'supprimer_poste', 'guard_name' => 'web']);
    $voirPoste = Permission::create(['name' => 'voir_postes', 'guard_name' => 'web']);


    $ajouterPersonne = Permission::create(['name' => 'ajouter_personne', 'guard_name' => 'web']);
    $ModifierPersonne = Permission::create(['name' => 'modifier_personne', 'guard_name' => 'web']);
    $SupprimerPersonne = Permission::create(['name' => 'supprimer_personne', 'guard_name' => 'web']);
    $voirPersonne = Permission::create(['name' => 'voir_personnes', 'guard_name' => 'web']);


    $ajouterAbsence = Permission::create(['name' => 'ajouter_absence', 'guard_name' => 'web']);
    $ModifierAbsence = Permission::create(['name' => 'modifier_absence', 'guard_name' => 'web']);
    $SupprimerAbsence = Permission::create(['name' => 'supprimer_absence', 'guard_name' => 'web']);
    $voirAbsence = Permission::create(['name' => 'voir_absences', 'guard_name' => 'web']);


    $ajouterRaison = Permission::create(['name' => 'ajouter_raison', 'guard_name' => 'web']);
    $ModifierRaison = Permission::create(['name' => 'modifier_raison', 'guard_name' => 'web']);
    $SupprimerRaison = Permission::create(['name' => 'supprimer_raison', 'guard_name' => 'web']);
    $voirRaison = Permission::create(['name' => 'voir_raisons', 'guard_name' => 'web']);


    $ajouterEvent = Permission::create(['name' => 'ajouter_event', 'guard_name' => 'web']);
    $ModifierEvent = Permission::create(['name' => 'modifier_event', 'guard_name' => 'web']);
    $SupprimerEvent = Permission::create(['name' => 'supprimer_event', 'guard_name' => 'web']);
    $voirEvent = Permission::create(['name' => 'voir_events', 'guard_name' => 'web']);

    
    $ajouterUser = Permission::create(['name' => 'ajouter_user', 'guard_name' => 'web']);
    $ModifierUser = Permission::create(['name' => 'modifier_user', 'guard_name' => 'web']);
    $SupprimerUser = Permission::create(['name' => 'supprimer_user', 'guard_name' => 'web']);
    $voirUser = Permission::create(['name' => 'voir_users', 'guard_name' => 'web']);

    
    $ajouterRole = Permission::create(['name' => 'ajouter_role', 'guard_name' => 'web']);
    $ModifierRole = Permission::create(['name' => 'modifier_role', 'guard_name' => 'web']);
    $SupprimerRole = Permission::create(['name' => 'supprimer_role', 'guard_name' => 'web']);
    $voirRoles = Permission::create(['name' => 'voir_roles', 'guard_name' => 'web']);
    $affecterRoles = Permission::create(['name' => 'affecter_roles', 'guard_name' => 'web']);
    $retirerRoles = Permission::create(['name' => 'retirer_roles', 'guard_name' => 'web']);
    $voirPermissions = Permission::create(['name' => 'voir_permissions', 'guard_name' => 'web']);
    $affecterPermissions = Permission::create(['name' => 'affecter_permissions', 'guard_name' => 'web']);
    $retirerPermisions = Permission::create(['name' => 'retirer_permissions', 'guard_name' => 'web']);

    $ajouterCelebration = Permission::create(['name' => 'ajouter_celebration', 'guard_name' => 'web']);
    $ModifierCelebration = Permission::create(['name' => 'modifier_celebration', 'guard_name' => 'web']);
    $SupprimerCelebration = Permission::create(['name' => 'supprimer_celebration', 'guard_name' => 'web']);
    $voirCelebration = Permission::create(['name' => 'voir_celebrations', 'guard_name' => 'web']);


    $accesToDashboard = Permission::create(['name' => 'acces_to_dashboard' , 'guard_name' => 'web']);

    // Assigner les permissions aux rôles si nécessaire
    $owner->givePermissionTo($all);
    //$admin->givePermissionTo($accesToDashboard);
    $support->givePermissionTo($accesToDashboard,$ajouterService,$ModifierService,$SupprimerService,$voirService);

    $users = [
        ['name' => 'Owner', 'email' => 'owner@gmail.com', 'password' => Hash::make('123456789')],
       ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('123456789')],
        ['name' => 'aziz', 'email' => 'aziz@gmail.com', 'password' => Hash::make('123456789')]
    ];

    for ($i = 0; $i < count($users); $i++) {
        User::create($users[$i]);
    }

    $Admin_User = User::where('name', 'admin')->first();
    $Owner_User = User::where('name', 'Owner')->first();
    $support_user = User::where('name', 'aziz')->first();
    
    
    $Owner_User->assignRole($owner); // Affecter le rôle à luti'lisateur
    $support_user->assignRole($support); // Affecter le rôle à l'utilisateur
  
    
}
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    $superAdminRole = Role::create(['name' => 'super_admin']);
    $adminRole = Role::create(['name' => 'admin']);

    $all = Permission::create(['name' => '*']);

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

    $accesToDashboard = Permission::create(['name' => 'acces_to_dashboard', 'guard_name' => 'web']);

    // Assigner les permissions aux rôles si nécessaire
    $adminRole->givePermissionTo($gererappPermission);
    //$user->assignRole('admin');

    }
}

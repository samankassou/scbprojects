<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //#######create all permissions############
        //manage users permissions
        $viewUser = Permission::create([
            'name' => 'view-user',
            'display_name' => 'Consulter les détails d\'un utilisateur'
        ]);
        $viewUsers = Permission::create([
            'name' => 'view-users',
            'display_name' => 'Consulter une liste d\'utilisateurs'
        ]);
        $createUser = Permission::create([
            'name' => 'create-user',
            'display_name' => 'Créer un utilisateur'
        ]);
        $editUser = Permission::create([
            'name' => 'edit-user',
            'display_name' => 'Modifier un utilisateur'
        ]);
        $deleteUser = Permission::create([
            'name' => 'delete-user',
            'display_name' => 'Supprimer un utilisateur'
        ]);
        //manage projects permissions
        $viewProject = Permission::create([
            'name' => 'view-project',
            'display_name' => 'Consulter détails d\'un projet'
        ]);
        $viewProjects = Permission::create([
            'name' => 'view-projects',
            'display_name' => 'Consulter une liste de projets'
        ]);
        $createProject = Permission::create([
            'name' => 'create-project',
            'display_name' => 'Créer un projet'
        ]);
        $exportProjects = Permission::create([
            'name' => 'export-projects',
            'display_name' => 'Exporter une liste de projets'
        ]);
        $editProject = Permission::create([
            'name' => 'edit-project',
            'display_name' => 'Modifier un projet'
        ]);
        $deleteProject = Permission::create([
            'name' => 'delete-project',
            'display_name' => 'Supprimer un projet'
        ]);
        $restoreProject = Permission::create([
            'name' => 'restore-project',
            'display_name' => 'Restaurer un projet'
        ]);
        //manage processes permissions
        $viewProcess = Permission::create([
            'name' => 'view-process',
            'display_name' => 'Consulter les détails d\'une procédure'
        ]);
        $viewProcesses = Permission::create([
            'name' => 'view-processes',
            'display_name' => 'Consulter une liste de procédure'
        ]);
        $createProcess = Permission::create([
            'name' => 'create-process',
            'display_name' => 'Créer une procédure'
        ]);
        $exportProcesses = Permission::create([
            'name' => 'export-processes',
            'display_name' => 'Exporter une liste de procédures'
        ]);
        $editProcess = Permission::create([
            'name' => 'edit-process',
            'display_name' => 'Modifier une procédure'
        ]);
        $deleteProcess = Permission::create([
            'name' => 'delete-process',
            'display_name' => 'Supprimer une procédure'
        ]);
        $restoreProcess = Permission::create([
            'name' => 'restore-process',
            'display_name' => 'Restaurer une procédure'
        ]);
        $forceDeleteProcess = Permission::create([
            'name' => 'forceDelete-process',
            'display_name' => 'Supprimer définitivement une procédure'
        ]);
        $viewDeletedProcess = Permission::create([
            'name' => 'viewDeleted-process',
            'display_name' => 'Voir une procédure supprimée'
        ]);
        $viewDeletedProcesses = Permission::create([
            'name' => 'viewDeleted-processes',
            'display_name' => 'Voir une liste de procédures supprimées'
        ]);
        $ViewProcessModificationsHistory = Permission::create([
            'name' => 'ViewProcessModificationsHistory',
            'display_name' => 'Voir l\'historique des modifications d\'une procédure'
        ]);

        $manageAccount = Permission::create([
            'name' => 'manage-account',
            'display_name' => 'Gérer son profil'
        ]);

        //retrieve all roles
        $adminRole = Role::firstWhere('name', 'admin');
        $projectsWriterRole = Role::firstWhere('name', 'projects-writer');
        $processesWriterRole = Role::firstWhere('name', 'processes-writer');
        $userRole = Role::firstWhere('name', 'user');

        //assign permissions to every role
        $adminRole->attachPermissions([
            $viewUser,
            $viewUsers,
            $createUser,
            $editUser,
            $deleteUser,
            $viewProject,
            $viewProjects,
            $createProject,
            $editProject,
            $exportProjects,
            $deleteProject,
            $restoreProject,
            $viewProcess,
            $viewProcesses,
            $viewDeletedProcess,
            $viewDeletedProcesses,
            $createProcess,
            $editProcess,
            $exportProcesses,
            $deleteProcess,
            $forceDeleteProcess,
            $restoreProcess,
            $ViewProcessModificationsHistory,
            $manageAccount
        ]);

        $projectsWriterRole->attachPermissions([
            $viewProject,
            $viewProjects,
            $createProject,
            $editProject,
            $exportProjects,
            $manageAccount
        ]);

        $processesWriterRole->attachPermissions([
            $viewProcess,
            $viewProcesses,
            $viewDeletedProcess,
            $viewDeletedProcesses,
            $createProcess,
            $editProcess,
            $exportProcesses,
            $deleteProcess,
            $ViewProcessModificationsHistory,
            $manageAccount
        ]);
        $userRole->attachPermissions([
            $viewProcess,
            $viewProcesses,
            $exportProcesses,
        ]);
    }
}

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
        //create all permissions
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

        $adminRole = Role::firstWhere('name', 'admin');
        $projectsWriterRole = Role::firstWhere('name', 'projects-writer');
        $processesWriterRole = Role::firstWhere('name', 'processes-writer');

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
            $restoreProcess,
            $viewProcess,
            $viewProcesses,
            $createProcess,
            $editProcess,
            $exportProcesses,
            $deleteProcess
        ]);

        $projectsWriterRole->attachPermissions([
            $viewProject,
            $viewProjects,
            $createProject,
            $editProject,
            $exportProjects,
        ]);

        $processesWriterRole->attachPermissions([
            $viewProcess,
            $viewProcesses,
            $createProcess,
            $editProcess,
            $exportProcesses,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'admin', 'display_name' => 'Administrateur'],
            ['name' => 'projects-writer', 'display_name' => 'Saisisseur Projets'],
            ['name' => 'processes-writer', 'display_name' => 'Saisisseur Procédures'],
            ['name' => 'user', 'display_name' => 'Consultant']
        ]);
    }
}

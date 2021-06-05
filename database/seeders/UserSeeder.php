<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Tchappi Osée',
            'email' => 'admin@scb.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $projectsWriter = User::create([
            'name' => 'Hermann',
            'email' => 'saisisseurprojet@scb.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $processesWriter = User::create([
            'name' => 'Yann Audric',
            'email' => 'saisisseurprocess@scb.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $adminRole = Role::firstWhere('name', 'admin');
        $projectsWriterRole = Role::firstWhere('name', 'projects-writer');
        $processesWriterRole = Role::firstWhere('name', 'processes-writer');
        
        $admin->attachRole($adminRole);
        $projectsWriter->attachRole($projectsWriterRole);
        $processesWriter->attachRole($processesWriterRole);
    }
}

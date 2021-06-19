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
            'name'           => 'Admin 1',
            'email'          => 'admin@scb.com',
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $projectsWriter = User::create([
            'name'           => 'Saisisseur Projets 1',
            'email'          => 'saisisseurprojet@scb.com',
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $processesWriter = User::create([
            'name'           => 'Saisisseur procédures 1',
            'email'          => 'saisisseurprocess@scb.com',
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'name'           => 'Consultant',
            'email'          => 'consultant@scb.com',
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $adminRole           = Role::firstWhere('name', 'admin');
        $projectsWriterRole  = Role::firstWhere('name', 'projects-writer');
        $processesWriterRole = Role::firstWhere('name', 'processes-writer');
        $userRole            = Role::firstWhere('name', 'user');

        $admin->attachRole($adminRole);
        $projectsWriter->attachRole($projectsWriterRole);
        $processesWriter->attachRole($processesWriterRole);
        $user->attachRole($userRole);
    }
}

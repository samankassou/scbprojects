<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            NatureSeeder::class,
            StepSeeder::class,
            ProjectSeeder::class,
            DomainSeeder::class,
            MacroprocessSeeder::class,
            MethodSeeder::class,
            PoleSeeder::class,
            EntitySeeder::class,
            ProcessSeeder::class,
            UserSeeder::class
        ]);
    }
}

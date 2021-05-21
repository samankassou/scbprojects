<?php

namespace Database\Seeders;

use App\Models\Step;
use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Step::create(['name' => 'Etude d\'opportunité']);
        Step::create(['name' => 'Cadrage']);
        Step::create(['name' => 'Conception']);
        Step::create(['name' => 'Réalisation']);
        Step::create(['name' => 'Paramétrage']);
        Step::create(['name' => 'Formation']);
        Step::create(['name' => 'Recette']);
        Step::create(['name' => 'Mise en production']);
        Step::create(['name' => 'Clôture du projet']);
    }
}

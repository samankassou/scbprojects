<?php

namespace Database\Seeders;

use App\Models\Pole;
use Illuminate\Database\Seeder;

class PoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pole::create(['name' => 'Direction Générale']);
        Pole::create(['name' => 'Pôles Grandes Entreprises et PME']);
        Pole::create(['name' => 'Particuliers/Professionnels et TPE']);
        Pole::create(['name' => 'Engagements']);
        Pole::create(['name' => 'Finances']);
        Pole::create(['name' => 'Risques']);
        Pole::create(['name' => 'Support']);
    }
}

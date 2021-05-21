<?php

namespace Database\Seeders;

use App\Models\Nature;
use Illuminate\Database\Seeder;

class NatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nature::create(['name' => 'Reglémentaire']);
        Nature::create(['name' => 'Business']);
        Nature::create(['name' => 'Gain de productivité']);
        Nature::create(['name' => 'Optimisation d\'un process']);
        Nature::create(['name' => 'Réduction d\'un risque']);
    }
}

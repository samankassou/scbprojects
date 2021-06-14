<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\Process;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entitiesIds = Entity::all(['id']);
        Process::factory(10)
        ->create()
        ->each(function($process) use($entitiesIds){
            $entitiesSelected = rand(1, 5);
            $entities = $entitiesIds->random($entitiesSelected)->values();
            $process->entities()->attach($entities);
        });
    }
}

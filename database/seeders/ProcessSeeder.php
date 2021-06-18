<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\Process;
use App\Models\ProcessVersion;
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
        $entitiesIds = Entity::all('id');
        Process::factory()
            ->count(10)
            ->hasVersions(1)
            ->create();
        $processesVersions = ProcessVersion::all();
        $processesVersions->each(function ($processVersions) use ($entitiesIds) {
            $selectedEntities = rand(1, 3);
            $entities  = $entitiesIds->random($selectedEntities)->values();
            $processVersions->entities()->attach($entities);
        });
    }
}

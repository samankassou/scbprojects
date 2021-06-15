<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Step;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stepsIds = Step::all(['id']);
        Project::factory(10)
        ->create()
        ->each(function($project) use($stepsIds){
            $selectedSteps = rand(1, 3);
            $steps  = $stepsIds->random($selectedSteps)->values();
            $project->steps()->attach($steps);
            $natures = Arr::random([1, 2, 3, 4, 5], rand(1, 5));
            $project->reference =   castNumberId($project->id)."-".$project->start_year;
            $project->save();
            $project->natures()->attach($natures);
        });
    }
}

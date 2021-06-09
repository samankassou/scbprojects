<?php

namespace Database\Seeders;

use App\Models\Project;
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
        Project::factory(10)
        ->create()
        ->each(function($project){
           $natures = Arr::random([1, 2, 3, 4, 5], rand(1, 5));
            $project->reference = Str::uuid();
            $project->save();
            $project->natures()->attach($natures);
        });
    }
}

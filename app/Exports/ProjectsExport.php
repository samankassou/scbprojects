<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection, WithHeadings
{
    public function __construct($projects)
    {
        $this->projects = $projects;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->projects;
    }

    public function headings(): array
    {
        return [
            '#',
            'reference',
            'nom'
        ];
    }

    public function prepareRows($projects): array
    {
        return array_map(function($project){
            //$project->initiative .= 'test';
            return $project;
        }, $projects);
    }
}

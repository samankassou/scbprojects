<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProjectsExport implements FromCollection, 
WithHeadings, 
WithCustomStartCell,
WithMapping,
ShouldAutoSize,
WithStyles,
WithColumnWidths
{
    public function __construct($projects)
    {
        $projects->each(function($project){
            $project->natures = $project->natures;
        });
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
            'Reférence',
            'Date de création',
            'Nom',
            'Description',
            'Nature(s)',
            'Sponsor/AMOA',
            'MOE',
            'Initiative',
            'Chef de projet',
            'Coût du projet',
            'Statut',
            'Progression',
            'Gains/Impact',
            'Documentation',
            'Facture(s)',
        ];
    }

    public function prepareRows($projects): array
    {
        return array_map(function($project){
            $project->cost = number_format($project->cost, 0, '.', ' ');
            $project->created_at = Carbon::parse($project->created_at)->format('d/m/Y');
            $project->natures = implode(', ', $project->natures->pluck('name')->toArray());
            return $project;
        }, $projects);
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function map($project): array
    {
        return [
            $project->reference,
            $project->created_at,
            $project->name,
            $project->description,
            $project->natures,
            $project->sponsor,
            $project->moe,
            $project->initiative,
            $project->manager,
            $project->cost,
            $project->status,
            $project->progress,
            $project->benefits,
            $project->documentation,
            $project->bills,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            '2' => [
                'font' => ['bold' => true, 'size' => '18'],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'cccccc']]
            ]
        ];
    }

    public function columnsWidths(): array
    {
        return [
            'B' => 45,
            'C' => 45,
        ];
    }

}

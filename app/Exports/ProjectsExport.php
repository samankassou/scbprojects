<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProjectsExport implements FromCollection, 
WithHeadings, 
WithCustomStartCell,
WithMapping,
WithStyles,
WithColumnWidths,
WithProperties
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

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'lastModifiedBy' => auth()->user()->name,
            'title'          => 'Liste des projets du '.today()->format('d/m/Y'),
            'company'        => 'SCB Cameroun'
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Reférence',
            'Nom',
            'Date de création',
            'Date de dernière modification',
            'Description',
            'Nature(s)',
            'Sponsor/AMOA',
            'MOE',
            'Initiative',
            'Chef de projet',
            'Date début',
            'Date fin prévisionnelle',
            'Coût du projet',
            'Statut',
            'Progression',
            'Gains/Impact',
            'Documentation',
            'Facture(s)',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'N' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_PERCENTAGE
        ];
    }

    public function prepareRows($projects): array
    {
        return array_map(function($project){
            $project->cost = number_format($project->cost, 0, '.', ' ');
            $project->natures = implode(', ', $project->natures->pluck('name')->toArray());
            return $project;
        }, $projects);
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function map($project): array
    {
        return [
            $project->index,
            $project->reference,
            $project->name,
            $project->created_at->format('d/m/Y à H:i:s'),
            $project->modifications->count() ? $project->modifications[0]->created_at->format('d/m/Y à H:i:s') : $project->created_at->format('d/m/Y à H:i:s'),
            $project->description,
            $project->natures,
            $project->sponsor,
            $project->moe,
            $project->initiative,
            $project->manager,
            $project->start_date->format('d/m/Y'),
            $project->end_date->format('d/m/Y'),
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
                'font' => ['name' => 'Candara', 'bold' => true, 'size' => 12],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                        'color' => ['rgb' => '538dd5']
                    ],
                ],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'cccccc']]
            ],
            '3' => [
                'font' => ['name' => 'Calibri', 'size' => 12],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                        'color' => ['rgb' => '538dd5']
                    ],
                ],
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 54,
            'D' => 25,
            'E' => 25,
            'F' => 45,
            'G' => 35,
            'H' => 35,
            'I' => 11,
            'J' => 10,
            'K' => 12,
            'L' => 12,
            'M' => 12,
            'N' => 35,
            'O' => 13,
            'P' => 20,
            'Q' => 30,
            'R' => 30,
            'S' => 30,
        ];
    }

}

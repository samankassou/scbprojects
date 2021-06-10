<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProjectsExport implements FromCollection, 
WithHeadings, 
WithCustomStartCell,
WithMapping,
WithStyles,
WithColumnWidths,
WithProperties,
WithEvents
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
            'Titre',
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
            'Coût du projet(FCFA)',
            'Statut',
            'Etat d\'avancement(%)',
            'Gains/Impact sur SCB',
            'Documentation',
            'Facture(s)',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
                $cellRange = 'A3:'.$highestColumn.''.$highestRow;
                $hearders = "A2:$highestColumn"."2";
                
                $event->sheet->getDelegate()->mergeCells("A1:B1");
                $event->sheet->getDelegate()->mergeCells("C1:S1");
                $event->sheet->getDelegate()->setCellValue("A1", today()->format('d/m/Y'));
                $event->sheet->getDelegate()->setCellValue("C1", "PORTEFEUILLE PROJETS ORGANISATION");
                $event->sheet->getDelegate()->getStyle($hearders)->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle("B2:R2")->getAlignment()->setTextRotation(61);
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(90);
                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(90);

                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '538dd5']
                        ]
                    ]
                ]);
                $event->sheet->getDelegate()->getStyle("A1")->applyFromArray([
                    'font' => ['name' => 'Calibri', 'size' => 14, 'bold' => true],
                ]);
                $event->sheet->getDelegate()->getStyle("S2")->getAlignment()->applyFromArray([
                    'horizontal' => 'center',
                ]);
                $event->sheet->getDelegate()->getStyle("A1:C1")->getAlignment()->applyFromArray([
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ]);
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->applyFromArray([
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ]);
            }
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
            'C1' => [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'FFC107']],
                'font' => ['name' => 'Candara', 'bold' => true, 'size' => 36],
            ],
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
            'B' => 10,
            'C' => 22,
            'D' => 12,
            'E' => 12,
            'F' => 20,
            'G' => 15,
            'H' => 15,
            'I' => 11,
            'J' => 10,
            'K' => 12,
            'L' => 12,
            'M' => 12,
            'N' => 15,
            'O' => 13,
            'P' => 10,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
        ];
    }

}

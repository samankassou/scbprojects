<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ProcessesExport implements
    FromCollection,
    WithProperties,
    WithHeadings,
    WithCustomStartCell,
    WithMapping,
    WithColumnWidths,
    WithStyles,
    WithEvents
{
    public function __construct($processes)
    {
        $this->processes = $processes;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->processes;
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'lastModifiedBy' => auth()->user()->name,
            'title'          => 'Liste des procédures du ' . today()->format('d/m/Y'),
            'company'        => 'SCB Cameroun'
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
                $cellRange = 'A3:' . $highestColumn . '' . $highestRow;
                $hearders = "A2:$highestColumn" . "2";

                $event->sheet->getDelegate()->mergeCells("A1:B1");
                $event->sheet->getDelegate()->mergeCells("C1:U1");
                $event->sheet->getDelegate()->setCellValue("A1", today()->format('d/m/Y'));
                $event->sheet->getDelegate()->setCellValue("C1", "CARTOGRAPHIE DES PROCEDURES");
                $event->sheet->getDelegate()->getStyle($hearders)->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle("B2:T2")->getAlignment()->setTextRotation(61);
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(90);
                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(90);

                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000']
                        ]
                    ]
                ]);
                $event->sheet->getDelegate()->getStyle("A1")->applyFromArray([
                    'font' => ['name' => 'Calibri', 'size' => 14, 'bold' => true],
                ]);
                $event->sheet->getDelegate()->getStyle("U2")->getAlignment()->applyFromArray([
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

    public function headings(): array
    {
        return [
            '#',
            'Macroprocessus',
            'Processus',
            'Procédure',
            'Type',
            'Référence',
            'Version',
            'Entité(s) Impactée(s)',
            'Statut',
            'Etat',
            'Date de création',
            'Date de rédaction',
            'Date de vérification',
            'Date d\'approbation',
            'Date de diffusion',
            'Rédacteur',
            'Vérificateur',
            'Approbateur',
            'Date de dernière mise à jour',
            'Modificateur',
            'Modifications apportées',
        ];
    }

    public function prepareRows($processes): array
    {
        return array_map(function ($process) {
            $process->entities = implode(', ', $process->last_version->entities->pluck('name')->toArray());
            return $process;
        }, $processes);
    }

    public function map($process): array
    {
        return [
            $process->index,
            $process->method->macroprocess->name,
            $process->method->name,
            $process->last_version->name,
            $process->last_version->type,
            $process->reference,
            $process->last_version->version,
            $process->entities,
            $process->last_version->status,
            $process->last_version->state,
            $process->last_version->creation_date->format('d/m/Y'),
            optional($process->last_version->writing_date)->format('d/m/Y'),
            optional($process->last_version->verification_date)->format('d/m/Y'),
            optional($process->last_version->date_of_approval)->format('d/m/Y'),
            optional($process->last_version->broadcasting_date)->format('d/m/Y'),
            $process->last_version->written_by,
            $process->last_version->verified_by,
            $process->last_version->approved_by,
            $process->process_modifications->count() ? $process->process_modifications[0]->created_at->format('d/m/Y à H:i:s') : $process->last_version->creation_date->format('d/m/Y à H:i:s'),
            $process->process_modifications->count() ? $process->process_modifications[0]->author->name : null,
            $process->last_version->modifications
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'C1' => [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['argb' => 'FFFF00']],
                'font' => ['name' => 'Candara', 'bold' => true, 'size' => 16],
            ],
            '2' => [
                'font' => ['name' => 'Candara', 'bold' => true, 'size' => 12],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                        'color' => ['argb' => '000000']
                    ],
                ],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['argb' => 'CCCCCC']]
            ],
            '3' => [
                'font' => ['name' => 'Calibri', 'size' => 12],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                        'color' => ['argb' => '000000']
                    ],
                ],
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 18,
            'D' => 24,
            'E' => 12,
            'F' => 8,
            'G' => 5,
            'H' => 25,
            'I' => 18,
            'J' => 10,
            'K' => 14,
            'L' => 14,
            'M' => 14,
            'N' => 14,
            'O' => 14,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 14,
            'T' => 20,
            'U' => 25,
        ];
    }
}

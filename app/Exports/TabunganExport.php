<?php

namespace App\Exports;

use App\Models\Tabungan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TabunganExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    public function __construct(private int $userId) {}

    public function collection(): Collection
    {
        return Tabungan::where('user_id', $this->userId)->withSum('menabung', 'nominal')->get()
            ->map(fn (Tabungan $item) => [
                $item->judul, $item->target_nominal, $item->menabung_sum_nominal ?? 0,
                $item->persentase_progress, $item->target_tanggal->format('d/m/Y'),
                $item->status === 'tercapai' ? 'Tercapai' : 'Berjalan',
            ]);
    }

    public function headings(): array
    {
        return ['Tujuan Tabungan', 'Target Nominal', 'Nominal Terkumpul', 'Progress', 'Target Tanggal', 'Status'];
    }

    public function styles(Worksheet $sheet): array
    {
        $lastRow = max(1, $sheet->getHighestRow());
        $sheet->freezePane('A2');
        $sheet->setAutoFilter('A1:F'.$lastRow);
        $sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0F1B14'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        if ($lastRow > 1) {
            $sheet->getStyle('A2:F'.$lastRow)->applyFromArray([
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_HAIR,
                        'color' => ['rgb' => 'DCE9D7'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
            $sheet->getStyle('B2:C'.$lastRow)->getNumberFormat()->setFormatCode('"Rp" #,##0');
            $sheet->getStyle('D2:D'.$lastRow)->getNumberFormat()->setFormatCode('0.00"%"');
            $sheet->getStyle('B2:D'.$lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle('E2:E'.$lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F2:F'.$lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        return [
            'A' => ['width' => 30],
            'B' => ['width' => 18],
            'C' => ['width' => 21],
            'D' => ['width' => 14],
            'E' => ['width' => 17],
            'F' => ['width' => 14],
        ];
    }

    public function title(): string
    {
        return 'Laporan Tabungan';
    }
}

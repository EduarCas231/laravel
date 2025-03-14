<?php

namespace App\Exports;

use App\Models\Usert;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsertExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    public function collection()
    {
        return Usert::all();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Correo', 'Dirección', 'Estado', 'Municipio', 'Foto'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('D9EAD3');

        $sheet->getStyle('A1:G' . (Usert::count() + 1))
              ->getBorders()->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getStyle('A2:A' . (Usert::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B2:B' . (Usert::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C2:C' . (Usert::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D2:D' . (Usert::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E2:E' . (Usert::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F2:F' . (Usert::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G2:G' . (Usert::count() + 1))->getAlignment()->setHorizontal('center');
    }

    public function title(): string
    {
        return 'Usuarios';
    }
}
<?php

namespace App\Exports;

use App\Models\Usuarios;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsertExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    public function collection()
    {
        return Usuarios::all();
    }

    public function headings(): array
    {
        return [
            'Nombre', 'Correo', 'Contraseña', 'Tipo', 'Teléfono', 'Dirección', 'Género', 'Fecha', 'Foto'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('D9EAD3');

        $sheet->getStyle('A1:I' . (Usuarios::count() + 1))
              ->getBorders()->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        for ($col = 'A'; $col <= 'I'; $col++) {
            $sheet->getStyle("{$col}2:{$col}" . (Usuarios::count() + 1))->getAlignment()->setHorizontal('center');
        }
    }

    public function title(): string
    {
        return 'Usuarios';
    }
}

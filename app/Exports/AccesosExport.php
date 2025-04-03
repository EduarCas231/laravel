<?php
namespace App\Exports;

use App\Models\Acceso;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccesosExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    public function collection()
    {
        return Acceso::select('nombre', 'codigo', 'accion', 'fecha')->orderBy('fecha', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Nombre', 'Código', 'Acción', 'Fecha'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:D1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('D9EAD3');

        $sheet->getStyle('A1:D' . (Acceso::count() + 1))
              ->getBorders()->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        for ($col = 'A'; $col <= 'D'; $col++) {
            $sheet->getStyle("{$col}2:{$col}" . (Acceso::count() + 1))->getAlignment()->setHorizontal('center');
        }
    }

    public function title(): string
    {
        return 'Accesos';
    }
}

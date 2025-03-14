<?php

namespace App\Exports;

use App\Models\Productos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductosExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    // Obtener los productos de la base de datos
    public function collection()
    {
        return Productos::all();
    }

    // Definir los encabezados
    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Número de serie', 'Modelo', 'Región', 'Detalle', 'Foto'
        ];
    }

    // Aplicar estilos a las celdas
    public function styles(Worksheet $sheet)
    {
        // Aplica estilo al encabezado (por ejemplo, poner en negrita)
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('D9EAD3'); // Color de fondo

        // Aplicar bordes a las celdas
        $sheet->getStyle('A1:G' . (Productos::count() + 1))
              ->getBorders()->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Aplicar formato a las columnas de texto
        $sheet->getStyle('A2:A' . (Productos::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B2:B' . (Productos::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C2:C' . (Productos::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D2:D' . (Productos::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E2:E' . (Productos::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F2:F' . (Productos::count() + 1))->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G2:G' . (Productos::count() + 1))->getAlignment()->setHorizontal('center');
    }

    // Título de la hoja
    public function title(): string
    {
        return 'Productos';
    }
}

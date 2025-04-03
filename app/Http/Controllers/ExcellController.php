<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductosExport;
use App\Exports\UsertExport;
use App\Exports\AccesosExport;

class ExcellController extends Controller
{
    /**
     * Exporta los productos a un archivo Excel.
     *
     * @return \Maatwebsite\Excel\BinaryFileResponse
     */
    public function exportarProductos()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }

    /**
     * Exporta los usuarios a un archivo Excel.
     *
     * @return \Maatwebsite\Excel\BinaryFileResponse
     */
    public function exportarUsuarios()
    {
        return Excel::download(new UsertExport, 'usuarios.xlsx');
    }

    /**
     * Exporta los accesos a un archivo Excel.
     *
     * @return \Maatwebsite\Excel\BinaryFileResponse
     */
    public function exportarAccesos()
    {
        return Excel::download(new AccesosExport, 'accesos.xlsx');
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Exports\exportReciboIngreso;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\exportBascula;
use App\Exports\exportRemision;

class ExcelExport extends Controller
{

    private function storeExcel($export, $fileType, $folderPath, $extension = 'xlsx')
    {
        // Utiliza el sistema de almacenamiento 'public'
        Storage::disk('public')->makeDirectory($folderPath, 0777, true, true);

        // Genera un nombre de archivo descriptivo con el tipo y la fecha actual
        $filename = $fileType . '-' . now()->format('YmdHis') . '.' . $extension;

        // Genera la ruta completa del archivo
        $filePath = "$folderPath/$filename";

        // Almacena el archivo en el disco 'public'
        Excel::store($export, $filePath, 'public');

        // Devuelve la ruta del archivo almacenado
        return $filePath;
    }

    public function recibo()
    {
        $data = [
        9790,
        '09/01/2024',
        '07:50:00 p. m.',
        '08:02:00 p. m.',
        'ADM',
        'MAIZ AMARILLO',
        'SILO 1',
        'CLIPPER KENT',
        33.1, 
        14.1, 
        0,
        0, 
        0, 
        0,
        'JOSE CASTILLO',
        'CH-14989',
        null,
        'KG',
        38800, 
        13790, 
        25010,
        855, 
        304, 
        551,
        551.3,
       
    ];

    
        $year = date('Y');
        $month = date('m');
        $folderPath = "excel_exports/$year/$month";
        $fileType = 'recibo-ingreso';

        $filePath = $this->storeExcel(new exportReciboIngreso($data), $fileType, $folderPath, 'xlsx');

        // Devuelve la ruta para su posterior uso
        return response()->json(['excel_path' => asset("storage/$filePath")]);
    }

    public function remision () {
        $data = [9790,'09/01/2024','07:50:00 p. m.','08:02:00 p. m.','enviado','vapor','remite','bodega',
            'presentacion', 'producto', 'QQ', 30.1,12.8 ,0,0,0,0,'JOSE CASTILLO','CH-14989','cedula',5870,1860,4010,129, 41,88,25000,80,88.405,-8.4045
           
        ];
        $year = date('Y');
        $month = date('m');
        $folderPath = "excel_exports/$year/$month";
        $fileType = 'remision';

        $filePath = $this->storeExcel(new exportRemision($data), $fileType, $folderPath, 'xlsx');

        // Devuelve la ruta para su posterior uso
        return response()->json(['excel_path' => asset("storage/$filePath")]);
    }

    public function bascula () {
       $data = [4,'09/01/2024','07:50:00 p. m.','cliente','presentacion','producto','um',
            'chofer', 'CH-8999', 30.1,12.8 ,0,0,0,0,292,123245
           
        ];
        $year = date('Y');
        $month = date('m');
        $folderPath = "excel_exports/$year/$month";
        $fileType = 'bascula';

        $filePath = $this->storeExcel(new exportBascula($data), $fileType, $folderPath, 'xlsx');

        // Devuelve la ruta para su posterior uso
        return response()->json(['excel_path' => asset("storage/$filePath")]);
    }
}

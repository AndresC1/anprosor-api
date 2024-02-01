<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class exportReciboIngreso implements WithEvents, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    
  
    public function startCell(): string
    {
        return 'E1';
    }

    public function registerEvents(): array
    { 
        return [
            AfterSheet::class => function (AfterSheet $event) {
                //valores originales
                $event->sheet->setCellValue('E1', "             RECIBO DE INGRESO");
                $event->sheet->setCellValue('E2', "     ANPROSOR");
                $event->sheet->setCellValue('E3', "     CHICHIGALPA");
                $event->sheet->setCellValue('E5', "RECIBO No:");
                $event->sheet->setCellValue('E7', "FECHA:");
                $event->sheet->setCellValue('E9', "ENTRADA:");
                $event->sheet->setCellValue('E11', "SALIDA:");
                $event->sheet->setCellValue('E13', "CLIENTE:");
                $event->sheet->setCellValue('E15', "PRODUCT:");
                $event->sheet->setCellValue('E17', "BODEGA:");
                $event->sheet->setCellValue('E19', "VAPOR:");
                $event->sheet->setCellValue('E21', "ANALISIS SELECTIVO");
                $event->sheet->setCellValue('E22', "TEMP");
                $event->sheet->setCellValue('F22', "HUMEDAD");
                $event->sheet->setCellValue('G22', "IMP");
                $event->sheet->setCellValue('E24', "GQ");
                $event->sheet->setCellValue('F24', "GND");
                $event->sheet->setCellValue('G24', "HG");
                $event->sheet->setCellValue('E27', "CHOFER");
                $event->sheet->setCellValue('E29', "PLACA");
                $event->sheet->setCellValue('E31', "CEDULA");
                $event->sheet->setCellValue('E33', "U/M");
                $event->sheet->setCellValue('E34', "PB");
                $event->sheet->setCellValue('F34', "PT");
                $event->sheet->setCellValue('G34', "PN");
                $event->sheet->setCellValue('J34', "TOTAL QQ");
                $event->sheet->setCellValue('E40', "ENTREGUE");
                $event->sheet->setCellValue('E41', "CHOFER");
                $event->sheet->setCellValue('G40', "RECIBI");
                $event->sheet->setCellValue('G41', "PLANTA");




                // Configurar las posiciones de las celdas
                $event->sheet->setCellValue('F5', $this->data[0]);
                $event->sheet->setCellValue('F7', $this->data[1]);
                $event->sheet->setCellValue('F9', $this->data[2]);
                $event->sheet->setCellValue('F11', $this->data[3]);
                $event->sheet->setCellValue('F13', $this->data[4]);
                $event->sheet->setCellValue('F15', $this->data[5]);
                $event->sheet->setCellValue('F17', $this->data[6]);
                $event->sheet->setCellValue('F19', $this->data[7]);
                $event->sheet->setCellValue('E23', $this->data[8]);
                $event->sheet->setCellValue('F23', $this->data[9]);
                $event->sheet->setCellValue('G23', $this->data[10]);
                $event->sheet->setCellValue('E25', $this->data[11]);
                $event->sheet->setCellValue('F25', $this->data[12]);
                $event->sheet->setCellValue('G25', $this->data[13]);
                $event->sheet->setCellValue('F27', $this->data[14]);
                $event->sheet->setCellValue('F29', $this->data[15]);
                $event->sheet->setCellValue('F31', $this->data[16]);
                $event->sheet->setCellValue('F33', $this->data[17]);
                $event->sheet->setCellValue('E35', $this->data[18]);
                $event->sheet->setCellValue('F35', $this->data[19]);
                $event->sheet->setCellValue('G35', $this->data[20]);
                $event->sheet->setCellValue('E36', $this->data[21]);
                $event->sheet->setCellValue('F36', $this->data[22]);
                $event->sheet->setCellValue('G36', $this->data[23]);
                $event->sheet->setCellValue('J35', $this->data[24]);

            
                //$event->sheet->getDefaultColumnDimension()->setWidth(11);
                $event->sheet->getStyle('A1:K42')->getFont()->setName('Arial')->setSize(11);
                
                $event->sheet->getColumnDimension('E')->setWidth(11);
                $event->sheet->getColumnDimension('F')->setWidth(11);

                    //STYLE
                    // Establecer estilos adicionales
                $event->sheet->mergeCells('E1:G1');
                $event->sheet->mergeCells('E2:G2');
                $event->sheet->mergeCells('E3:G3');
                $event->sheet->getStyle('E1:E3')->getAlignment()->setHorizontal('center');
                $event->sheet->mergeCells('E21:G21');

                $event->sheet->getStyle('F5:F19')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->getStyle('F27:F31')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->getStyle('E1:E3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->getStyle('E36:G36')->applyFromArray([
                    'font' => [
                        'size' => 9,
                    ],
                ]);

                // Alinear a la izquierda desde F5 hasta F19
                $event->sheet->getStyle('F5:F19')->getAlignment()->setHorizontal('left');
                $event->sheet->getStyle('E5:E19')->getAlignment()->setHorizontal('right');
                $event->sheet->getStyle('E22:G25')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('E34:G36')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('F27:F31')->getAlignment()->setHorizontal('left');
                $event->sheet->getStyle('E27:E31')->getAlignment()->setHorizontal('right');
                

                // Establecer bordes para las celdas específicas
                $styleBorders = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                // Agregar borde inferior a E39 y G39
                $event->sheet->getStyle('E39')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $event->sheet->getStyle('G39')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $event->sheet->getStyle('E22:G25')->applyFromArray($styleBorders);
                $event->sheet->getStyle('E33:F33')->applyFromArray($styleBorders);
                $event->sheet->getStyle('E34:G36')->applyFromArray($styleBorders);

                $drawing = new Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo');
                $drawing->setPath(public_path('logo.png')); // Reemplaza con la ruta real de tu imagen
                $drawing->setCoordinates('E1');
                $drawing->setHeight(50);
                $drawing->setWorksheet($event->sheet->getDelegate());

            },
        ];
    
    }
}

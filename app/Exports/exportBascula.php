<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Borders;

class exportBascula implements WithEvents
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
                $event->sheet->setCellValue('E1', "SERVICIO DE BASCULA");
                $event->sheet->setCellValue('E2', "ANPROSOR");
                $event->sheet->setCellValue('E3', "CHICHIGALPA");
                $event->sheet->setCellValue('E5', "No:");
                $event->sheet->setCellValue('E6', "FECHA:");
                $event->sheet->setCellValue('E7', "ENTRADA:");
                $event->sheet->setCellValue('E9', "CLIENTE:");
                $event->sheet->setCellValue('E11', "PRESENTACION");
                $event->sheet->setCellValue('F11', "PRODUCTO");
                $event->sheet->setCellValue('G11', "U/M");
                $event->sheet->setCellValue('E14', "CHOFER");
                $event->sheet->setCellValue('E15', "PLACA");
                $event->sheet->setCellValue('E17', "PB");
                $event->sheet->setCellValue('F17', "PT");
                $event->sheet->setCellValue('G17', "PN");
                $event->sheet->setCellValue('H18', "KG");
                $event->sheet->setCellValue('H19', "QQ");
                $event->sheet->setCellValue('C17', "PESO EN QQ");
                $event->sheet->setCellValue('E22', "ENTREGUE");
                $event->sheet->setCellValue('G22', "RECIBI");
           


                // Configurar las posiciones de las celdas
                $event->sheet->setCellValue('F5', $this->data[0]);
                $event->sheet->setCellValue('F6', $this->data[1]);
                $event->sheet->setCellValue('F7', $this->data[2]);
                $event->sheet->setCellValue('F9', $this->data[3]);
                $event->sheet->setCellValue('E12', $this->data[4]);
                $event->sheet->setCellValue('F12', $this->data[5]);
                $event->sheet->setCellValue('G12', $this->data[6]);
                $event->sheet->setCellValue('F14', $this->data[7]);
                $event->sheet->setCellValue('F15', $this->data[8]);
                $event->sheet->setCellValue('E18', $this->data[9]);
                $event->sheet->setCellValue('F18', $this->data[10]);
                $event->sheet->setCellValue('G18', $this->data[11]);
                $event->sheet->setCellValue('E19', $this->data[12]);
                $event->sheet->setCellValue('F19', $this->data[13]);
                $event->sheet->setCellValue('G19', $this->data[14]);
                $event->sheet->setCellValue('C18', $this->data[15]);
                $event->sheet->setCellValue('C19', $this->data[16]);
                

            
                //$event->sheet->getDefaultColumnDimension()->setWidth(11);
                $event->sheet->getStyle('A1:K42')->getFont()->setName('Arial')->setSize(11);
                $event->sheet->getStyle('E11')->getFont()->setName('Arial')->setSize(8);
                $event->sheet->getColumnDimension('E')->setWidth(12);
                $event->sheet->getColumnDimension('F')->setWidth(12);
                $event->sheet->getColumnDimension('C')->setWidth(13);

                    //STYLE
                    // Establecer estilos adicionales
                $event->sheet->mergeCells('E1:G1');
                $event->sheet->mergeCells('E2:G2');
                $event->sheet->mergeCells('E3:G3');
                $event->sheet->getStyle('E1:E3')->getAlignment()->setHorizontal('center');
               
                $event->sheet->mergeCells('E24:G24');

                $event->sheet->getStyle('F5:F9')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->getStyle('E17:G17')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->getStyle('E1:E3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                

                // Alinear a la izquierda desde F5 hasta F19
                $event->sheet->getStyle('F5:F9')->getAlignment()->setHorizontal('left');
                $event->sheet->getStyle('E5:E9')->getAlignment()->setHorizontal('right');
                $event->sheet->getStyle('E11:G12')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('E34:G36')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('H18:H19')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('F14:F15')->getAlignment()->setHorizontal('left');
                $event->sheet->getStyle('E14:E15')->getAlignment()->setHorizontal('right');
                ;
           
                

                // Establecer bordes para las celdas específicas
                $styleBorders = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ];

               
                // Agregar borde inferior a E39 y G39
                $event->sheet->getStyle('E21')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $event->sheet->getStyle('G21')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $event->sheet->getStyle('E11:G12')->applyFromArray($styleBorders);
                $event->sheet->getStyle('E17:G19')->applyFromArray($styleBorders);
                


               
                
            },
        ];
    
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ExcelExport;

class ExportExcel extends Command
{
    protected $signature = 'export:excel';

    protected $description = 'Export Excel files';

    protected $excelExport;

    public function __construct(ExcelExport $excelExport)
    {
        parent::__construct();
        $this->excelExport = $excelExport;
    }

    public function handle()
    {
        // Ejecuta la lógica de exportación para cada tipo de archivo
        $this->excelExport->recibo();
        $this->excelExport->remision();
        $this->excelExport->bascula();

        $this->info('Excel files exported successfully.');
    }
}
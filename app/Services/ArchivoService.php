<?php

namespace App\Services;

use App\Repository\ArchivoRepository;

class ArchivoService
{
    private $archivoRepository;

    public function __construct(){
        $this->archivoRepository = new ArchivoRepository();
    }

    public function store(): int{
        $arrayFiles = $this->createFile();
        return $this->archivoRepository->store($arrayFiles);
    }

    private function createFile(): array{
        // Method to create file
        return [
            'PDF' => '',
            'Excel' => '',
        ];
    }
}

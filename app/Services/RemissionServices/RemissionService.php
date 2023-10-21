<?php

namespace App\Services\RemissionServices;

use App\Http\Requests\Remission\StoreRemissionRequest;
use App\Models\Remission;
use App\Repository\RemissionRepository\RemissionRepository;

class RemissionService
{
    protected $remission_repository;
    public function __construct()
    {
        $this->remission_repository = new RemissionRepository();
    }

    public function registerRemission(StoreRemissionRequest $request): Remission
    {
        $remission = $this->remission_repository->store($request);
        return $remission;
    }
}

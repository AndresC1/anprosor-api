<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paginate\IndexPaginateRequest;
use App\Http\Resources\Operacion\CleanOperacionResource;
use App\Http\Resources\Operacion\OperacionResource;
use App\Models\Operacion;
use App\Http\Requests\Operacion\StoreOperacionRequest;
use App\Http\Requests\Operacion\UpdateOperacionRequest;
use App\Services\OperationService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OperacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPaginateRequest $request)
    {
        try {
            $request->validated();
            if($request->paginate == 'true'){
                $listOperaciones = Operacion::select('*')
                    ->orderBy('id', $request->OrderBy??'asc')
                    ->paginate($request->per_page??10);
                $dataPaginate = [
                    'meta' => [
                        'total' => $listOperaciones->total(),
                        'count' => $listOperaciones->count(),
                        'per_page' => $listOperaciones->perPage(),
                        'current_page' => $listOperaciones->currentPage(),
                        'total_pages' => $listOperaciones->lastPage(),
                    ],
                    'links' => [
                        'first' => $listOperaciones->url(1),
                        'last' => $listOperaciones->url($listOperaciones->lastPage()),
                        'prev' => $listOperaciones->previousPageUrl(),
                        'next' => $listOperaciones->nextPageUrl(),
                    ],
                ];
            } else{
                $listOperaciones = Operacion::select('*')
                    ->orderBy('id', $request->OrderBy??'asc')
                    ->get();
            }
            return response()->json([
                'operaciones' => CleanOperacionResource::collection($listOperaciones),
                'paginate' => $dataPaginate??null,
                'message' => 'Listado de operaciones',
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las operaciones',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOperacionRequest $request)
    {
        try {
            $request->validated();
            DB::beginTransaction();
            $new_operacion = new OperationService();
            $new_operacion->register($request);
            DB::commit();
            return response()->json([
                'message' => 'Operacion creada correctamente',
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear la operacion',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $operation)
    {
        try {
            $operacion = Operacion::findOrFail($operation);
            return response()->json(new OperacionResource($operacion), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json('Error al obtener la operacion', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operacion $operacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOperacionRequest $request, Operacion $operacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operacion $operacion)
    {
        //
    }
}

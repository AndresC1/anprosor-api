<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paginate\IndexPaginateRequest;
use App\Http\Resources\Remission\DataRemissionResource;
use App\Http\Resources\Remission\InfoRemissionResource;
use App\Models\Remission;
use App\Http\Requests\Remission\StoreRemissionRequest;
use App\Http\Requests\Remission\UpdateRemissionRequest;
use App\Services\RemissionServices\RemissionService;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Remission\FinishRemissionRequest;

class RemissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPaginateRequest $request)
    {
        try{
            $request->validated();
            if($request->paginate == 'true'){
                $listRemissions = Remission::select('*')
                    ->where('estado', $request->type??'all')
                    ->orderBy('id', $request->OrderBy??'desc')
                    ->paginate($request->per_page??10);
                $dataPaginate = [
                    'meta' => [
                        'total' => $listRemissions->total(),
                        'count' => $listRemissions->count(),
                        'per_page' => $listRemissions->perPage(),
                        'current_page' => $listRemissions->currentPage(),
                        'total_pages' => $listRemissions->lastPage(),
                    ],
                    'links' => [
                        'first' => $listRemissions->url(1),
                        'last' => $listRemissions->url($listRemissions->lastPage()),
                        'prev' => $listRemissions->previousPageUrl(),
                        'next' => $listRemissions->nextPageUrl(),
                    ],
                ];
            } else{
                $listRemissions = Remission::select('*')
                    ->where('estado', $request->type??'all')
                    ->orderBy('id', $request->OrderBy??'desc')
                    ->get();
            }
            return response()->json([
                'remissions' => InfoRemissionResource::collection($listRemissions),
                'paginate' => $dataPaginate??null,
                'message' => 'List of remissions',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error getting remissions list',
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
    public function store(StoreRemissionRequest $request)
    {
        try{
            $request->validated();
            DB::beginTransaction();
            $remission = new RemissionService();
            $remission = $remission->registerRemission($request);
            DB::commit();
            return response()->json([
                'remission' => DataRemissionResource::make($remission),
                'message' => 'RemissionRepository created successfully',
                'status' => 201,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'error creating remission',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $remission)
    {
        try{
            $remission = Remission::find($remission);
            if (!$remission) {
                return response()->json([
                    'message' => 'RemissionRepository not found',
                    'status' => 404,
                ], 404);
            }
            return response()->json([
                'remission' => DataRemissionResource::make($remission),
                'message' => 'RemissionRepository found successfully',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error getting remission',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remission $remission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRemissionRequest $request, Remission $remission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remission $remission)
    {
        //
    }

    public function finishRemission(FinishRemissionRequest $request, int $remission)
    {
        try{
            $request->validated();
            $remission = Remission::find($remission);
            if (!$remission) {
                return response()->json([
                    'message' => 'Remission not found',
                    'status' => 404,
                ], 404);
            }
            $remission->update([
                'remision_origen' => $request->remision_origen??null,
                'vapor' => $request->vapor??null,
                'peso_segun_puerto' => $request->peso_segun_puerto??null,
                'silo_id' => $request->silo_id??null,
                'temperatura' => $request->temperatura??null,
                'humedad' => $request->humedad??null,
                'impureza' => $request->impureza??null,
                'grano_quebrado' => $request->grano_quebrado??null,
                'grano_no_desarrollado' => $request->grano_no_desarrollado??null,
                'peso_tara' => $request->peso_tara??null,
                'peso_neto' => $request->peso_neto??null,
                'observaciones' => $request->observaciones??null,
                'remision_general_xlsx' => $request->remision_general_xlsx??null,
                'recibo_ingreso_xlsx' => $request->recibo_ingreso_xlsx??null,
                'recibo_egreso_xlsx' => $request->recibo_egreso_xlsx??null,
                'estado' => 'completado',
                'hora_salida' => now('America/Managua')->format('H:i:s'),
                'ultima_modificacion_por' => auth()->user()->id,
            ]);
            return response()->json([
                'remission' => DataRemissionResource::make($remission),
                'message' => 'Remission finished successfully',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error getting remission',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

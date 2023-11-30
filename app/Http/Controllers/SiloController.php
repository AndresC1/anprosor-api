<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paginate\IndexPaginateRequest;
use App\Http\Resources\Silo\InfoSiloResource;
use App\Models\Silo;
use App\Http\Requests\Silo\StoreSiloRequest;
use App\Http\Requests\Silo\UpdateSiloRequest;
use Exception;

class SiloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPaginateRequest $request)
    {
        try{
            $request->validated();
            if($request->paginate == 'true'){
                $listSilos = Silo::select('*')->paginate(10);
                $dataPaginate = [
                    'meta' => [
                        'total' => $listSilos->total(),
                        'count' => $listSilos->count(),
                        'per_page' => $listSilos->perPage(),
                        'current_page' => $listSilos->currentPage(),
                        'total_pages' => $listSilos->lastPage(),
                    ],
                    'links' => [
                        'first' => $listSilos->url(1),
                        'last' => $listSilos->url($listSilos->lastPage()),
                        'prev' => $listSilos->previousPageUrl(),
                        'next' => $listSilos->nextPageUrl(),
                    ],
                ];
            } else{
                $listSilos = Silo::select('*')->get();
            }
            return response()->json([
                'silos' => InfoSiloResource::collection($listSilos),
                'paginate' => $dataPaginate??null,
                'message' => 'List of silos',
                'status' => 200,
            ]);
        } catch (Exception $e){
            return response()->json([
                'message' => 'error while getting silos',
                'error' => $e->getMessage(),
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
    public function store(StoreSiloRequest $request)
    {
        try{
            $request->validated();
            $silo = Silo::create([
                'name' => $request->name,
                'capacity_total' => (float)$request->capacity_total,
                'unit_of_measure' => $request->unit_of_measure,
                'current_capacity' => (float)$request->capacity_total,
                'used_capacity' => 0,
            ]);
            return response()->json([
                'silo' => InfoSiloResource::make($silo),
                'message' => 'silo created successfully',
                'status' => 200,
            ]);
        } catch (Exception $e){
            return response()->json([
                'message' => 'error while creating silo',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try{
            $silo = Silo::findOrFail($id);
            if($silo){
                return response()->json([
                    'silo' => InfoSiloResource::make($silo),
                    'message' => 'silo found',
                    'status' => 200,
                ]);
            } else{
                return response()->json([
                    'message' => 'silo not found',
                    'status' => 404,
                ]);
            }
        } catch (Exception $e){
            return response()->json([
                'message' => 'error while getting silo',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Silo $silo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiloRequest $request, int $silos)
    {
        try{
            $request->validated();
            $silo = Silo::find($silos);
            if($silo){
                $silo->update($request->all());
                return response()->json([
                    'silo' => InfoSiloResource::make($silo),
                    'message' => 'silo updated successfully',
                    'status' => 200,
                ]);
            } else{
                return response()->json([
                    'message' => 'silo not found',
                    'status' => 404,
                ]);
            }
        } catch (Exception $e){
            return response()->json([
                'message' => 'error while updating silo',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $silo)
    {
        try{
            $data = Silo::find($silo);
            if($data){
                $data->delete();
                return response()->json([
                    'message' => 'silo deleted successfully',
                    'status' => 200,
                ]);
            } else{
                return response()->json([
                    'message' => 'silo not found',
                    'status' => 404,
                ]);
            }
        } catch (Exception $e){
            return response()->json([
                'message' => 'error while deleting silo',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

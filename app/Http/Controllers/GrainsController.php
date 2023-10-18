<?php

namespace App\Http\Controllers;

use App\Http\Resources\Grains\InfoGrainResource;
use App\Models\Grains;
use App\Http\Requests\Grain\StoreGrainsRequest;
use App\Http\Requests\Grain\UpdateGrainsRequest;
use Exception;

class GrainsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $listGrains = Grains::select('*')->paginate(10);
            return response()->json([
                'grains' => InfoGrainResource::collection($listGrains),
                'meta' => [
                    'total' => $listGrains->total(),
                    'count' => $listGrains->count(),
                    'per_page' => $listGrains->perPage(),
                    'current_page' => $listGrains->currentPage(),
                    'total_pages' => $listGrains->lastPage(),
                ],
                'links' => [
                    'first' => $listGrains->url(1),
                    'last' => $listGrains->url($listGrains->lastPage()),
                    'prev' => $listGrains->previousPageUrl(),
                    'next' => $listGrains->nextPageUrl(),
                ],
                'message' => 'List of grains',
                'status' => 200,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'error getting grains list',
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
    public function store(StoreGrainsRequest $request)
    {
        try{
            $request->validated();
            $grain = Grains::create($request->all());
            return response()->json([
                'grain' => InfoGrainResource::make($grain),
                'message' => 'Grain created',
                'status' => 200,
            ]);
        } catch (Exception $e){
            return response()->json([
                'message' => 'error creating grain',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try{
            $grain = Grains::find($id);
            if($grain){
                return response()->json([
                    'grain' => InfoGrainResource::make($grain),
                    'message' => 'Grain found',
                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'message' => 'Grain not found'
                ], 404);
            }
        } catch (Exception $e){
            return response()->json([
                'message' => 'error getting grain',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grains $grains)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGrainsRequest $request, int $grains)
    {
        try{
            $request->validated();
            $grain = Grains::find($grains);
            if($grain){
                $grain->update([
                    'code' => $request->code??$grain->code,
                    'name' => $request->name??$grain->name,
                ]);
                return response()->json([
                    'grain' => InfoGrainResource::make($grain),
                    'message' => 'Grain updated',
                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'message' => 'Grain not found'
                ], 404);
            }
        } catch (Exception $e){
            return response()->json([
                'message' => 'error updating grain',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $grains)
    {
        try{
            $grain = Grains::find($grains);
            if($grain){
                $grain->delete();
                return response()->json([
                    'message' => 'Grain deleted',
                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'message' => 'Grain not found'
                ], 404);
            }
        } catch (Exception $e){
            return response()->json([
                'message' => 'error deleting grain',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

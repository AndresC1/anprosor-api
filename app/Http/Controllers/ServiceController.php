<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paginate\IndexPaginateRequest;
use App\Http\Resources\Service\InfoServiceResource;
use App\Models\Service;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use Exception;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPaginateRequest $request)
    {
        try{
            $request->validated();
            if($request->paginate == 'true'){
                $listServices = Service::select('*')->paginate(10);
                $dataPaginate = [
                    'meta' => [
                        'total' => $listServices->total(),
                        'count' => $listServices->count(),
                        'per_page' => $listServices->perPage(),
                        'current_page' => $listServices->currentPage(),
                        'total_pages' => $listServices->lastPage(),
                    ],
                    'links' => [
                        'first' => $listServices->url(1),
                        'last' => $listServices->url($listServices->lastPage()),
                        'prev' => $listServices->previousPageUrl(),
                        'next' => $listServices->nextPageUrl(),
                    ],
                ];
            } else{
                $listServices = Service::select('*')->get();
            }
            return response()->json([
                'services' => InfoServiceResource::collection($listServices),
                'paginate' => $dataPaginate??null,
                'message' => 'List of services',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error getting services list',
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
    public function store(StoreServiceRequest $request)
    {
        try{
            $request->validated();
            $service = Service::create($request->all());
            return response()->json([
                'service' => InfoServiceResource::make($service),
                'message' => 'Service created successfully',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error creating service',
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
            $service = Service::find($id);
            if($service){
                return response()->json([
                    'service' => InfoServiceResource::make($service),
                    'message' => 'Service found',
                    'status' => 200,
                ]);
            } else{
                return response()->json([
                    'message' => 'Service not found',
                    'status' => 404,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error getting service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, int $services)
    {
        try{
            $request->validated();
            $service = Service::find($services);
            if($service){
                $service->update([
                    'name' => $request->name??$service->name,
                    'description' => $request->description??$service->description,
                ]);
                return response()->json([
                    'service' => InfoServiceResource::make($service),
                    'message' => 'Service updated successfully',
                    'status' => 200,
                ]);
            } else{
                return response()->json([
                    'message' => 'Service not found',
                    'status' => 404,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error updating service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $services)
    {
        try{
            $service = Service::find($services);
            if($service){
                $service->delete();
                return response()->json([
                    'message' => 'Service deleted successfully',
                    'status' => 200,
                ]);
            } else{
                return response()->json([
                    'message' => 'Service not found',
                    'status' => 404,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error deleting service',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paginate\IndexPaginateRequest;
use App\Http\Resources\Client\InfoClientResource;
use App\Http\Resources\Client\ShowClientResource;
use App\Models\Client;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPaginateRequest $request)
    {
        try {
            $request->validated();
            if ($request->paginate == 'true') {
                $listClients = Client::select('*')
                    ->orderBy('id', $request->OrderBy ?? 'desc')
                    ->paginate($request->per_page ?? 10);
                $dataPaginate = [
                    'meta' => [
                        'total' => $listClients->total(),
                        'count' => $listClients->count(),
                        'per_page' => $listClients->perPage(),
                        'current_page' => $listClients->currentPage(),
                        'total_pages' => $listClients->lastPage(),
                    ],
                    'links' => [
                        'first' => $listClients->url(1),
                        'last' => $listClients->url($listClients->lastPage()),
                        'prev' => $listClients->previousPageUrl(),
                        'next' => $listClients->nextPageUrl(),
                    ],
                ];
            } else {
                $listClients = Client::select('*')
                    ->orderBy('id', $request->OrderBy ?? 'desc')
                    ->get();
            }
            return response()->json([
                'clients' => InfoClientResource::collection($listClients),
                'paginate' => $dataPaginate ?? null,
                'message' => 'List of clients',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener los clientes'], 500);
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
    public function store(StoreClientRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $client = Client::create($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Client created successfully',
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error creating client',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        try{
            return response()->json([
                'client' => ShowClientResource::make($client),
                'message' => 'Client obtained successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error obtaining client',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, int $clients)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $client = Client::find($clients);
            if ($client){
                $client->update($request->all());
                DB::commit();
                return response()->json([
                    'message' => 'Client updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Client not found',
                ], 404);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error updating client',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client, int $clients)
    {
        try {
            DB::beginTransaction();
            $client = Client::find($clients);
            if ($client){
                $client->delete();
                DB::commit();
                return response()->json([
                    'message' => 'Client deleted successfully',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Client not found',
                ], 404);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error deleting client',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = $this->clientService->index();
        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $test = Client::where('phone', str_starts_with($request->phone, '+') ? substr($request->phone, 1) : $request->phone)->first();
        if ($test != null){
            return redirect()->back()->with(['message'=>'Bunday telefon nomerli klient bazada bar!!!']);
        }
        $this->clientService->store($request);
        return redirect()->route('clients.create',['message'=>'qate']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('client.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $this->clientService->update($request, $client);
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->clientService->destroy($client);
        return redirect()->route('clients.index');
    }

}

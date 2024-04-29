<?php


namespace App\services;


use App\Models\Client;
use Illuminate\Http\Request;

class ClientService
{

    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        $phone = str_starts_with($request->phone, '+') ? substr($request->phone, 1) : $request->phone;
        try {
            Client::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phone' => $phone,
                'birthDate' => $request->birthDate,
                'points' => $request->points,
            ]);
        }catch (\Exception $exception){
            return false;
        }
        return true;
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'birthDate' => 'required',
            'points' => 'required',
        ]);
        $client->firstName = $request->firstName;
        $client->lastName = $request->lastName;
        $client->phone = $request->phone;
        $client->birthDate = $request->birthDate;
        $client->points = $request->points;
        $client->update();
    }

    public function destroy(Client $client)
    {
        $client->delete();
    }

}

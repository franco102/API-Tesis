<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients=Client::all();
        return response()->json($clients);
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
    public function store(Request $request)
    {
        //
        $client=new Client;
        $client->name=$request->name;
        $client->email=$request->email;
        $client->phone=$request->phone;
        $client->address=$request->address;
        $client->save();
        $data=[
            'message'=>'Client created successfully',
            'client'=>$client
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        // $client=Client::find($client->id);
        // if (!$client){
        //     return response()->json([
        //         'message'=>'Client not found'
        //     ]);
        // }
        $data=[
            'message'=>'Service attaced sucessfully',
            'client'=>$client,
            'services'=>$client->services
        ];
        return response()->json($data);
        return response()->json($client); 
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
    public function update(Request $request, Client $client)
    {
        //
        $client->name=$request->name;
        $client->email=$request->email;
        $client->phone=$request->phone;
        $client->address=$request->address;
        $client->save();
        $data=[
            'message'=>'Client updated successfully',
            'client'=>$client
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        $data=[
            'message'=>'Client deleted sucessfully',
            'client'=>$client
        ];
        return response()->json($data);
    }
    /**
     * Attach
     */
    public function attach(Request $request)
    {
        $client=Client::find($request->client_id);
        $client->services()->attach($request->service_id);
        $data=[
            'message'=>'Service attaced sucessfully',
            'client'=>$client,
        ];
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients =  Client::latest()->paginate(10);
        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'name' => ['required', 'string'],
            'role' => ['required', 'string'],
            'company' => ['required', 'string'],
        ]);

        Client::create($attributes);

        return redirect('/clients', 201)->with('success', 'Client has been successfully added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $client = Client::where('id', $id)->firstOrFail();
        return view('client.update', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $attributes = $request->validate([
            'id' => ['required'],
            'name' => ['sometimes', 'string'],
            'role' => ['sometimes', 'string'],
            'company' => ['sometimes', 'string'],
        ]);

        $attributes['verified'] = true;

        Client::where('id', $attributes['id'])->update($attributes);

        return redirect()->route('clients')->with('info', 'Client has been successfully verified!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        //
        $request->validate([
            'id' => ['required']
        ]);

        $client = Client::where('id', $request->id)->firstOrFail();

        $client->delete();

        return redirect()->route('clients')->with('info', 'Client has been successfully deleted!');
    }
}

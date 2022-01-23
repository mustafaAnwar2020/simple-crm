<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Facade\FlareClient\Http\Client as HttpClient;

class clientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index')->with('clients',$clients);
    }

    public function trashedClients(){
        $client = Client::onlyTrashed()->get();
        return view('clients.trash')->with('clients',$client);
    }
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'contact_name'=>'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'company_name' => 'required|string',
            'company_address' => 'required',
            'company_zip' => 'required',
            'company_vat' => 'required'
        ]);
        // dd($request);
        $clients = Client::create([
            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_vat' => $request->company_vat,
            'company_zip' => $request->company_zip
        ]);

        return redirect()->route('clients.index');
    }

    public function edit(Client $client)
    {
        return view('clients.edit')->with('client',$client);
    }


    public function update(Request $request, Client $client)
    {

        $this->validate($request,[
            'contact_name'=>'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'company_name' => 'required|string',
            'company_address' => 'required',
            'company_zip' => 'required',
            'company_vat' => 'required'
        ]);

        $client->contact_name = $request->contact_name;
        $client->contact_email = $request->contact_email;
        $client->contact_phone = $request->contact_phone;
        $client->company_name = $request->company_name;
        $client->company_address = $request->company_address;
        $client->company_zip = $request->company_zip;
        $client->company_vat = $request->company_vat;
        $client->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete($client->id);
        return redirect()->back();
    }

    public function delete($id)
    {
        $client = Client::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $client = Client::onlyTrashed()->where('id',$id)->restore();
        return redirect()->back();
    }
}

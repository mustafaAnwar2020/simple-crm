<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Models\Client;
use App\Http\Resources\ClientsResource;
use Facade\FlareClient\Http\Client as HttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:client-list|client-create|client-edit|client-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:client-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:client-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $clients = Client::all();
        return $this->sendResponse(ClientsResource::collection($clients),'All data retrieved successfully!');
    }

    public function trashedClients(){
        $clients = Client::onlyTrashed()->get();
        return $this->sendResponse(ClientsResource::collection($clients),'All trashed data retrieved successfully!');
    }

    public function show(Client $client){
        return $this->sendResponse(new ClientsResource($client),'Client is ready!');
    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
            'contact_name'=>'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'company_name' => 'required|string',
            'company_address' => 'required',
            'company_zip' => 'required',
            'company_vat' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $client = Client::create($input);
        return $this->sendResponse(new ClientsResource($client),'Client created successfully!');
    }

    public function update(Request $request, Client $client)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'contact_name'=>'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'company_name' => 'required|string',
            'company_address' => 'required',
            'company_zip' => 'required',
            'company_vat' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $client->contact_name = $input['contact_name'];
        $client->contact_email = $input['contact_email'];
        $client->contact_phone = $input['contact_phone'];
        $client->company_name = $input['company_name'];
        $client->company_address = $input['company_address'];
        $client->company_zip = $input['company_zip'];
        $client->company_vat = $input['company_vat'];
        $client->save();
        return $this->sendResponse(new ClientsResource($client),'Client updated successfully!');
    }

    public function destroy(Client $client){
        $client->delete($client->id);
        return $this->sendResponse(new ClientsResource($client),'Client trashed successfully!');
    }

    // public function delete(Client $client){
    //     $client = Client::onlyTrashed()->where('id',$client->id)->forceDelete();
    //     return $this->sendResponse(new ClientsResource($client),'Client deleted successfully!');
    // }

    // public function restore(Client $client)
    // {
    //     $client = Client::onlyTrashed()->where('id',$client->id)->restore();
    //     return $this->sendResponse(new ClientsResource($client),'Client restored successfully!');
    // }
}

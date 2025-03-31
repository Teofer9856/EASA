<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Province;
use App\Models\Seller;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    public function index(){
        $clients_list = Client::namesChange(Client::sortable('name')->paginate(15));
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);
        $input = ['search' => '', 'option' => ''];

        $success = session('success');
        return view('clients.index', compact(['clients_list', 'names_list', 'input', 'success']));
    }

    public function create(){
        $provinces_list = Province::all();
        $sellers = Seller::all();

        return view('clients.create', compact('provinces_list', 'sellers'));
    }

    public function store(StoreClientRequest $request){
        $client = Client::create($request->validated());

        return redirect()->route('clients.index')->with('status', "Create client: $request->name! se ha creado correctamente");
    }

    public function edit(Client $client){
        $provinces_list = Province::all();
        $sellers = Seller::all();

        return view('clients.edit', compact(['provinces_list', 'sellers','client']));
    }

    public function update(Client $client, UpdateClientRequest $request){
        $client->update($request->all());

        return redirect()->route('clients.index')->with('status', "Update client: $client->name! se ha actualizado correctamente");
    }

    public function show(HttpRequest $request){
        /* pluck returns an array with the required value */
        $ids_sellers = Seller::where('name', 'like', "%$request->search%")->pluck('id');
        $ids_province = Province::where('name', 'like', "%$request->search%")->pluck('id');

        if($request->option != 'All'){
            $clients_list = Client::namesChange(Client::sortable()->where("$request->option", 'like', "%$request->search%")
            ->orWhereIn("$request->option", $ids_province)
            ->orWhereIn("$request->option", $ids_sellers)->paginate(15));
            $input = ['search' => $request->search, 'option' => $request->option];
        } else {
            $clients_list = Client::namesChange(Client::sortable()->paginate(15));
            $input = ['search' => '', 'option' => ''];
        }
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);

        return view('clients.index', compact(['clients_list', 'names_list', 'input']));
    }


    public function destroy(Client $client){
        $client->delete();

        return redirect()->back()->with('status', "Delete client: $client->name! se ha borrado exitosamente");
    }
}

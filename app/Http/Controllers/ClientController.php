<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Seller;
use App\Models\Province;
use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

use Illuminate\Http\Request as HttpRequest;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('permission:ver')->only(['index', 'search']);
        $this->middleware('permission:crear')->only(['create', 'store']);
        $this->middleware('permission:editar')->only(['edit', 'update']);
        $this->middleware('permission:eliminar')->only(['destroy']);
    }

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
        Client::create($request->validated());

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

    public function destroy(Client $client){
        $client->delete();

        return redirect()->back()->with('status', "Delete client: $client->name! se ha borrado exitosamente");
    }

    public function search(HttpRequest $request){
        /* pluck returns an array with the required value */
        $ids_sellers = Seller::where('name', 'like', "%$request->search%")->pluck('id');
        $ids_province = Province::where('name', 'like', "%$request->search%")->pluck('id');

        if($request->option != 'All'){
            $clients_list = Client::namesChange(Client::sortable('name')->where("$request->option", 'like', "%$request->search%")
            ->orWhereIn("$request->option", $ids_province)
            ->orWhereIn("$request->option", $ids_sellers)->paginate(15));
            $input = ['search' => $request->search, 'option' => $request->option];
        } else {
            $clients_list = Client::namesChange(Client::sortable('name')->paginate(15));
            $input = ['search' => '', 'option' => ''];
        }
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);

        return view('clients.index', compact(['clients_list', 'names_list', 'input']));
    }

    public function export(){
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }

    public function import(HttpRequest $request){
        Excel::import(new ClientsImport, $request->file('uploadFile'));

        return redirect()->route('clients.index')->with('status', 'Success All good!');
    }
}

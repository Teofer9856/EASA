<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\Province;
use App\Models\Seller;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    public function index(){
        $clients_list = Client::namesChange(Client::paginate(15));
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);

        return view('clients.index', compact(['clients_list', 'names_list']));
    }

    public function create(){
        $provinces_list = Province::all();
        $sellers = Seller::all();

        return view('clients.create', compact('provinces_list', 'sellers'));
    }

    public function store(StoreClientRequest $request){
        $client = Client::create($request->all());

        return redirect()->route('clients.index');
    }

    public function show(HttpRequest $request){
        if($request->option != 'All'){
            $clients_list = Client::namesChange(Client::where("$request->option", 'like', "%$request->search%")
            ->orWhere("$request->option", "=", Province::where("name", 'like', "%$request->search%")->value("id"))
            ->orWhere("$request->option", "=", Seller::where("name", 'like', "%$request->search%")->value("id"))->paginate(15));
            $input = $request->search;
        } else {
            $clients_list = Client::namesChange(Client::paginate(15));
            $input = "";
        }
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);

        return view('clients.index', compact(['clients_list', 'names_list', 'input']));
    }


    public function destroy(Client $client){
        $client->delete();
        return redirect()->route('clients.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
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

    public function destroy(Client $client){
        $client->delete();

        return redirect()->route('clients.index');
    }


    public function show(HttpRequest $request){
        if($request->option != 'All'){
            $clients_list = Client::where("$request->option", 'like', "%$request->search%")->paginate(15);
        } else {
            $clients_list = Client::namesChange(Client::paginate(15));
        }
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);

        return view('clients.index', compact(['clients_list', 'names_list']));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Schema;

class GeneralController extends Controller
{
    public function index(){
        $clients_list = $this->namesChange(Client::paginate(15));
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
            $clients_list = $this->namesChange(Client::paginate(15));
        }
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);

        return view('clients.index', compact(['clients_list', 'names_list']));

    }



    public function namesChange($clients_list){
        foreach($clients_list as $object){
            $name_province = $object->province['name'];
            $name_seller = $object->seller['name'];

            $object->province_id = $name_province;
            $object->seller_id = $name_seller;
        }
        return $clients_list;
    }

}

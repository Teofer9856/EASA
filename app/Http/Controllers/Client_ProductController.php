<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientProductRequest;
use App\Http\Requests\ClientProductUpdateRequest;
use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Client_ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cliPro_list = ClientProduct::namesChange(ClientProduct::sortable('client_id')->paginate(15));
        $names_list = ClientProduct::fileteredNames(Schema::getColumnListing('clients_products'));
        $input = ['search' => '', 'option' => ''];

        return view('clientsProducts.index', compact('names_list', 'cliPro_list', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::sortable('client_id')->get();
        $products = Product::sortable('client_id')->get();

        return view('clientsProducts.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientProductRequest $request)
    {
        $cliPro = ClientProduct::create($request->all());

        return redirect()->route('clients.products.index')->with('status', "Create (client-product): $cliPro->id! se ha actualizado correctamente");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cli_pro = ClientProduct::find($id);
        $clients = Client::all();
        $products = Product::all();
        return view('clientsProducts.edit', compact('cli_pro', 'clients', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client_product = ClientProduct::find($id);
        $client_product->update($request->all());

        return redirect()->route('clients.products.index')->with('status', "Update (client-product): $client_product->id! se ha actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clientPro = ClientProduct::find($id)->delete();

        return redirect()->back()->with('status', "Delete (client-product): $clientPro->id! se ha eliminado exitosamente");
    }

    public function search(Request $request){
        /* pluck returns an array with the required value */
        $ids_client = Client::where('name', 'like', "%$request->search%")->pluck('id');
        $ids_products = Product::where('name', 'like', "%$request->search%")->pluck('id');

        if($request->option != 'All'){
            $cliPro_list = ClientProduct::namesChange(ClientProduct::sortable('client_id')->where("$request->option", 'like', "%$request->search%")
            ->orWhereIn("$request->option", $ids_client)
            ->orWhereIn("$request->option", $ids_products)->paginate(15));
            $input = ['search' => $request->search, 'option' => $request->option];
        } else {
            $cliPro_list = ClientProduct::namesChange(ClientProduct::sortable('client_id')->paginate(15));
            $input = ['search' => '', 'option' => ''];
        }
        $names_list = ClientProduct::fileteredNames(Schema::getColumnListing('clients_products'));

        return view('clientsProducts.index', compact(['cliPro_list', 'names_list', 'input']));
    }
}

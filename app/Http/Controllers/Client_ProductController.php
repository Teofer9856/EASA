<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientProductRequest;
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
        $cliPro_list = ClientProduct::namesChange(ClientProduct::orderBy('id', 'desc')->paginate(15));
        $names_list = ClientProduct::fileteredNames(Schema::getColumnListing('clients_products'));
        $input = ['search' => '', 'option' => ''];

        return view('clientsProducts.index', compact('names_list', 'cliPro_list', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name', 'asc')->get();
        $products = Product::orderBy('name', 'asc')->get();

        return view('clientsProducts.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientProductRequest $request)
    {
        ClientProduct::create($request->all());

        return redirect()->route('clients.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        /* pluck returns an array with the required value */
        $ids_client = Client::where('name', 'like', "%$request->search%")->pluck('id');
        $ids_products = Product::where('name', 'like', "%$request->search%")->pluck('id');

        if($request->option != 'All'){
            $cliPro_list = ClientProduct::namesChange(ClientProduct::orderBy('id', 'DESC')->where("$request->option", 'like', "%$request->search%")
            ->orWhereIn("$request->option", $ids_client)
            ->orWhereIn("$request->option", $ids_products)->paginate(15));
            $input = ['search' => $request->search, 'option' => $request->option];
        } else {
            $cliPro_list = ClientProduct::namesChange(ClientProduct::orderBy('id', 'DESC')->paginate(15));
            $input = ['search' => '', 'option' => ''];
        }
        $names_list = ClientProduct::fileteredNames(Schema::getColumnListing('clients_products'));

        return view('clientsProducts.index', compact(['cliPro_list', 'names_list', 'input']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ClientProduct::find($id)->delete();

        return redirect()->back();
    }
}

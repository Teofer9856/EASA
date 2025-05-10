<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ClientProduct;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientsProductsExport;
use App\Imports\ClientsProductsImport;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\ClientProductRequest;
use App\Http\Requests\ClientProductUpdateRequest;

class Client_ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver')->only(['index', 'search']);
        $this->middleware('permission:crear')->only(['create', 'store']);
        $this->middleware('permission:editar')->only(['edit', 'update']);
        $this->middleware('permission:eliminar')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cliPro_list = ClientProduct::namesChange(ClientProduct::sortable('client')->paginate(15));
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

        return redirect()->route('clients.products.index')->with('status', "Create (client-product): $cliPro->id! se ha creado correctamente");
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
    public function update(ClientProductUpdateRequest $request, string $id)
    {
        $client_product = ClientProduct::find($id);
        try{
            $client_product->update($request->all());
        } catch (Exception $e){
            return redirect()->route('clients.products.index')->with('status', "Error (Sales): $client_product->id! can not be duplicated");
        }

        return redirect()->route('clients.products.index')->with('status', "Update Sales: $client_product->id! updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ClientProduct::find($id)->delete();

        return redirect()->back()->with('status', "Delete Sales: $id! deleted successfully");
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

    public function export(){
        return Excel::download(new ClientsProductsExport, 'ClientsProducts.xlsx');
    }

    public function import(Request $request){
        Excel::import(new ClientsProductsImport, $request->file('uploadFile'));

        return redirect()->route('clients.products.index')->with('status', 'Success All good!');
    }
}

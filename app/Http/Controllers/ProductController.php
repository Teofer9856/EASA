<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Product\ProductStoreRequest;

class ProductController extends Controller
{

    public function __construct(){
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
        $products_list = Product::sortable('name')->paginate(15);
        $names_list = Product::fileteredNames(Schema::getColumnListing('products'));
        $input = ['search' => '', 'option' => ''];

        return view('products.index', compact('names_list', 'products_list', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        Product::create($request->all());

        return redirect()->route('products.index')->with('status', "Create product: $request->name! se ha creado correctamente");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('products.index')->with('status', "Update product: $product->name! se ha actualizado correctamente");
    }

    public function search(Request $request){
        if($request->option != 'All'){
            $products_list = Product::sortable('name')->where("$request->option", 'like', "%$request->search%")->paginate(15);
            $input = ['search' => $request->search, 'option' => $request->option];
        } else {
            $products_list = Product::sortable('name')->paginate(15);
            $input = ['search' => '', 'option' => ''];
        }
        $names_list = Product::fileteredNames(Schema::getColumnListing('products'));

        return view('products.index', compact(['products_list', 'names_list', 'input']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('status', "Delete product: $product->name! se ha eliminado correctamente");
    }

    public function export(){
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(Request $request){
        Excel::import(new ProductsImport, $request->file('uploadFile'));

        return redirect()->route('products.index')->with('status', 'Success All good!');
    }

}

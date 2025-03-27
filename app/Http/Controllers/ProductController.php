<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products_list = Product::orderBy('id', 'desc')->paginate(15);
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

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if($request->option != 'All'){
            $products_list = Product::orderBy('id', 'DESC')->where("$request->option", 'like', "%$request->search%")->paginate(15);
            $input = ['search' => $request->search, 'option' => $request->option];
        } else {
            $products_list = Product::orderBy('id', 'DESC')->paginate(15);
            $input = ['search' => '', 'option' => ''];
        }
        $names_list = Product::fileteredNames(Schema::getColumnListing('products'));

        return view('products.index', compact(['products_list', 'names_list', 'input']));
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

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

    public function search(){
    }
}

<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            $clients_list = Product::orderBy('id', 'DESC')->paginate(15);
            $input = ['search' => '', 'option' => ''];
        }
        $names_list = Product::fileteredNames(Schema::getColumnListing('products'));

        return view('products.index', compact(['products_list', 'names_list', 'input']));

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
        //
    }

    public function search(){
    }
}

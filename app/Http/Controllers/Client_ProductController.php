<?php

namespace App\Http\Controllers;

use App\Models\ClientProduct;
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
    public function show(string $id)
    {
        //
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
}

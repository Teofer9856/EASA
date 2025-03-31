<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers_list = Seller::sortable('name')->paginate(15);
        $names_list = Seller::fileteredNames(Schema::getColumnListing('sellers'));
        $input = ['search' => '', 'option' => ''];

        return view('sellers.index', compact('names_list', 'sellers_list', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sellers,name|string|min:1|max:50'
        ]);
        Seller::create($request->all());

        return redirect()->route('sellers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if($request->option != 'All'){
            $sellers_list = Seller::sortable('name')->where("$request->option", 'like', "%$request->search%")->paginate(15);
            $input = ['search' => $request->search, 'option' => $request->option];
        } else {
            $sellers_list = Seller::sortable('name')->paginate(15);
            $input = ['search' => '', 'option' => ''];
        }
        $names_list = Seller::fileteredNames(Schema::getColumnListing('sellers'));

        return view('sellers.index', compact(['sellers_list', 'names_list', 'input']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller)
    {
        return view('sellers.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
    {
        $request->validate([
            'name' => "required|unique:sellers,name, {$seller->id}|string|min:1|max:50"
        ]);

        $seller->update($request->all());
        return redirect()->route('sellers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();
        return redirect()->back();
    }
}

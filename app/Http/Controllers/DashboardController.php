<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $data = [
            count(Client::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get()),
            count(Product::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get()),
            count(Seller::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get()),
            count(ClientProduct::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get())
        ];

        return view('dashboard', compact('data'));
    }

}

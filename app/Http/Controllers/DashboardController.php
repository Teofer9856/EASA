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
        $clients = Client::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get();
        $products = Product::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get();
        $sellers = Seller::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get();
        $cli_pro = ClientProduct::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get();

        return view('dashboard', compact('clients', 'products', 'sellers', 'cli_pro'));
    }

}

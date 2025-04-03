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
        $firstDayMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        $lastDayOfMonth = Carbon::now()->endOfMonth()->toDateString();
        $firstDayLastMonth = Carbon::now()->startOfMonth()->subMonth()->toDateTimeString();
        $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $data = [
            count(Client::where([['created_at', '>=', $firstDayLastMonth], ['created_at', '<=', $lastDayOfPreviousMonth]])->get()),
            count(Product::where([['created_at', '>=', $firstDayLastMonth], ['created_at', '<=', $lastDayOfPreviousMonth]])->get()),
            count(Seller::where([['created_at', '>=', $firstDayLastMonth], ['created_at', '<=', $lastDayOfPreviousMonth]])->get()),
            count(ClientProduct::where([['created_at', '>=', $firstDayLastMonth], ['created_at', '<=', $lastDayOfPreviousMonth]])->get())
        ];

        $stats = [
            count(Product::select('id')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get()),
            count(Client::select('id')->where('created_at', '>=', Carbon::now()->startOfDay()->toDateTimeString())->get()),
            ClientProduct::max('price')
        ];
        $topThree = Client::whereIn('id', ClientProduct::orderBy('price', 'desc')->take(3)->pluck('client_id'))->get();

        $profit = [
            'lastMonth' => $lastMonthSells = ClientProduct::select('price')->where([['created_at', '>=', $firstDayLastMonth], ['created_at', '<=', $lastDayOfPreviousMonth]])->sum('price'),
            'thisMonth' => $monthSells = ClientProduct::select('price')->where('created_at', '>=', $firstDayMonth)->sum('price')
        ];

        return view('dashboard', compact('data', 'stats', 'topThree', 'profit'));
    }

}

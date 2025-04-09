<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function index(){
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
            count(Client::select('id')->where('created_at', '>=', $firstDayMonth)->get()),
            ClientProduct::max('price')
        ];

        /* !Revisa */
        $topThreeIds = ClientProduct::select('client_id')->groupBy('client_id')->orderBy(DB::raw('max(price)'), 'desc')->take(3)->pluck('client_id');
        $topThree = Client::whereIn('id', $topThreeIds)->orderBy('id', 'desc')->get();

        $profit = [
            'lastMonth' => $lastMonthSells = ClientProduct::select('price')->where([['created_at', '>=', $firstDayLastMonth], ['created_at', '<=', $lastDayOfPreviousMonth]])->sum('price'),
            'thisMonth' => $monthSells = ClientProduct::select('price')->where('created_at', '>=', $firstDayMonth)->sum('price')
        ];

        $mostSelled = ClientProduct::select('product_id', ClientProduct::raw('COUNT(*) as cantidad'))->groupBy('product_id')->orderBy('cantidad', 'DESC')->limit(1)->first();
        $name = Product::where('id', $mostSelled->product_id)->pluck('name');
        $price = number_format(ClientProduct::where('product_id', $mostSelled->product_id)->sum('price'), 0, ',', '.');

        $mostSelledList = [
            'name' => $name[0], 'id' => $mostSelled->product_id,
            'price' => $price, 'total' => $mostSelled->cantidad
        ];

        return view('admin.index', compact('data', 'stats', 'topThree', 'profit', 'mostSelledList'));
    }
}

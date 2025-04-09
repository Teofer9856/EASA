<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    function index(){
        $clients_list = Client::namesChange(Client::sortable('name')->paginate(15));
        $entity = Schema::getColumnListing('clients');
        $names_list = array_splice($entity, 0,6);
        $input = ['search' => '', 'option' => ''];

        $success = session('success');
        return view('admin.index', compact(['clients_list', 'names_list', 'input', 'success']));
    }
}

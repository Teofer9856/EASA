<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index(){
        $users = User::select()->where('id', '>', 1)->get();
        return view('admin.index', compact('users'));
    }
}

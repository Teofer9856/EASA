<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function index(){
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    function create(){
        return view('admin.roles.create');
    }

    function store(Request $role){
        $role->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);
        Role::create($role->all());
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
    }
}

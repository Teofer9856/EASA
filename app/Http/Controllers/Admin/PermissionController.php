<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function index(){
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    function create(){
        return view('admin.permissions.create');
    }

    function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);
        Permission::create(['name' => strtolower($request->name)]);
        return redirect()->route('admin.permissions.index')->with('status', 'Create Permiso: El permiso se ha creado correctamente');
    }

    function destroy(Permission $permission){
        $permission->delete();
        return redirect()->back()->with('status', 'Delete Permiso: El permiso se ha eliminado correctamente');

    }

    function edit(Permission $permission){
        return view('admin.permissions.edit', compact('permission'));
    }

    function update(Request $request, Permission $permission){
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);
        $permission->update(['name' => strtolower($request->name)]);
        return redirect()->route('admin.permissions.index')->with('status', 'Update Permiso: El permiso se ha actualizado correctamente');
    }
}

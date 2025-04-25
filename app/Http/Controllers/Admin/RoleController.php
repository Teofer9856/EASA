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
        Role::create(['name' => strtolower($role->name)]);
        return redirect()->route('admin.roles.index')->with('status', 'Create Rol: El rol se ha creado correctamente');
    }

    function destroy(Role $role){
        $role->delete();
        return redirect()->back()->with('status', 'Delete Rol: El rol se ha eliminado correctamente');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    function update(Request $request, Role $role){
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);
        $role->update(['name' => strtolower($request->name)]);
        return redirect()->route('admin.roles.index')->with('status', 'Update Rol: El rol se ha actualizado correctamente');
    }
}

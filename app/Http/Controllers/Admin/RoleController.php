<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::where('id', '>', 1)->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $role){
        $role->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
        ]);
        $rol = Role::create(['name' => strtolower($role->name)]);
        $rol->syncPermissions($role->permissions);
        return redirect()->route('admin.roles.index')->with('status', 'Create Rol: El rol se ha creado correctamente');
    }

    public function destroy(Role $role){
        $role->delete();
        return redirect()->back()->with('status', 'Delete Rol: El rol se ha eliminado correctamente');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role){
        $request->validate([
            'name' => "required|string|max:255|unique:roles,name,{$role->id}",
            'permissions' => 'array',
        ]);
        $role->syncPermissions($request->permissions);
        $role->update(['name' => strtolower($request->name)]);
        return redirect()->route('admin.roles.index')->with('status', 'Update Rol: El rol se ha actualizado correctamente');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        $roles = Role::whereNotIn('name', ['superAdmin'])->get();
        $userRoles = $user->getRoleNames()->first();
        $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();

        $rolePermissions = [];
        if ($userRoles) {
            $role = Role::where('name', $userRoles)->first();
            $rolePermissions = $role->permissions->pluck('name')->toArray();
        }


        return view('admin.permissions.edit', compact('user', 'permissions', 'roles', 'userRoles', 'userPermissions', 'rolePermissions'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->syncRoles($request->input('roles'));
        $user->syncPermissions($request->input('permissions'));

        return redirect()->route('admin.users.index')->with('status', 'Update User: Usuario actualizado correctamente');
    }
}

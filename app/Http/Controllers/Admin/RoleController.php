<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }
    public function store(Request $request)
    {

       $validated = $request->validate(['name' => ['required', 'unique:roles', 'max:255']]);
       Role::create($validated);


        return to_route('admin.roles.index')->with('message', 'Role added successfully');
    }

    public function edit($id){

        $permissions = Permission::all();
        // This code above is to connect to the Role and Permissions
        $roles = Role::where('id', $id)->first();
        return view('admin.roles.edit', compact('roles', 'permissions'));
    }


    public function update(Request $request, $id)
    {
        Role::where('id', $id)->update([

            'name' => $request->name
        ]);
        return to_route('admin.roles.index')->with('message', 'Role has been updated');
    }

    public function destroy($id)
    {
        Role::destroy($id);

        return redirect(route('admin.roles.index'))->with('message', 'Role has been deleted');

    }

    public function givePermission(Request $request , Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoke successfully.');
        }
        return back()->with('message', 'Permission revoke not exist.');


    }


}

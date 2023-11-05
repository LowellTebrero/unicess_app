<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }
    public function store(Request $request)
    {

       $validated = $request->validate(['name' => ['required', 'unique:permissions', 'max:255']]);
       Permission::create($validated);


        return to_route('admin.permissions.index')->with('message', 'Permissions added successfully');
    }

    public function edit($id){

        $permissions = Permission::where('id', $id)->first();

        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.permissions.edit', compact('permissions', 'roles'));
    }


    public function update(Request $request, $id)
    {
        Permission::where('id', $id)->update([

            'name' => $request->name
        ]);
        return to_route('admin.permissions.index')->with('message', 'Permission has been updated');
    }

    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect(route('admin.permissions.index'))->with('message', 'Permission has been deleted');

    }

    public function assignRole(Request $request , Permission $permission)
    {
        if($permission->hasRole($request->role)){
            return back()->with('message', 'Role exists.');
        }
        $permission->assignRole($request->role);
        return back()->with('message', 'Role added.');
    }

    public function removeRole(Permission $permission, Role $role)
    {

        if($permission->hasRole($role)){
            ($permission->removeRole($role));
            return back()->with('message', 'Role removed');
        }
        return back()->with('message', 'Role exists');
    }




}

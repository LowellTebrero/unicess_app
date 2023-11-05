<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class ProfileRoleController extends Controller
{
    public function editProfile($id)
    {
        // $role = Role::orderBy('name')->whereNotIn('name',['admin'])->whereNotIn('name', ['Parnters/Linkages'])->whereNotIn('name',['New User'])->pluck('name', 'id')->prepend('Select Program', '');
        $faculties = Faculty::orderBy('name')->pluck('name', 'id')->prepend('Select Faculty', '');
        $user =  User::where('id', $id)->first();
        return view('profile.edit', compact('role', 'faculties', 'user'));
    }

    public function assignProfileUser(Request $request , User $user, Role $role)
    {
        if($user->hasRole($request->role)){
            return back()->with('message', 'Role exists.');
        }

        $user->syncRoles($request->role);
        return back()->with('message', 'Role added.');
    }

    public function removeRole(User $user, Role $role)
    {
        if($user->hasRole($role)){
            ($user->removeRole($role));
            return back()->with('message', 'Role removed');
        }
        return back()->with('message', 'Role exists');
    }

    public function editRoleFaculty($id){

        $user =  User::where('id', $id)->with('faculty')->with('role')->firstorFail();
        $role = Role::all();
        $faculties = Faculty::orderBy('name')->pluck('name', 'id')->prepend('Select Faculty', '');


        return view('profile.update-role-faculty', compact('user', 'faculties', 'role'));
    }

    public function SaveRoleFaculty(Request $request, $id){

        $request->validate([

            'role' => ['required'],
            'faculty_id' => Rule::requiredIf(function ()  {
                return in_array(request()->role,['Faculty extensionist','Extension coordinator','nullable']);
            }),

            'parnters_id' => Rule::requiredIf(function ()  {
                return in_array(request()->role,['Parnters/Linkages','nullable']);
            }),

        ]);
        $user = User::find($id);


        $user->syncRoles($request->input('role'));

        if($faculties = ($request->input('faculty_id'))){
            $request->input('faculty_id');
            $request->faculty_id;
            $user->partners_id = null;
            $user->save();
        }

        if($partners = ($request->input('partners_id'))){
            $request->input('partners_id');
            $request->partners_id;
            $user->faculty_id = null;
            $user->save();
        }


        User::where('id', $id)->update([


        'faculty_id' => $faculties,

        'partners_id' => $partners,
        ]);


        flash()->addSuccess('Role and Faculty Updated Successfully');
        return back();
    }


}

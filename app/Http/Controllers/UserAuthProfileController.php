<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class UserAuthProfileController extends Controller
{
    public function editAuthUser($id)
    {
        $role = Role::orderBy('name')->whereNotIn('name',['admin'])->whereNotIn('name',['New User'])->pluck('name', 'id');
        $faculties = Faculty::orderBy('name')->pluck('name', 'id');
        $users = User::with('faculty')->get();
        $user = User::where('id', $id)->first();
        return view('profile.edit', compact('role', 'faculties', 'users', 'user', ));
    }

    public function updateAuthUser(Request $request, $id )
    {
        $user = User::find($id);

        $request->validate([
            'first_name' => ['max:255', 'required'],
            'last_name' => ['max:255' , 'required'],
            'middle_name' => ['max:255' , 'required'],
            'suffix' => ['max:255' ,'nullable'],
            'name' => ['max:255','required', Rule::unique('users')->ignore($user->id)],
            'email' => ['max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
        ]);

        if($request->file('avatar')){
            $image = $request->file('avatar');
            $filename = $request->name.'.'.$image->getClientOriginalExtension();
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(500, 500);
            $resize_image->save(public_path('upload/image-folder/profile-image/'. $filename));

            if(File::exists($resize_image)){
                unlink($resize_image);
            }
        User::where('id', $id)->update([

            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'zipcode' => $request->zipcode,
            'avatar' => $filename,

        ]);
        flash()->addSuccess('Profile Updated Successfully');
        return redirect("/profile/{$user->id}");
    }else {

        User::where('id', $id)->update([

            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'name' => $request->name,
            'gender'=> $request->gender,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'zipcode' => $request->zipcode,
        ]);
        flash()->addSuccess('Profile Updated Successfully');
        return redirect("/profile/{$user->id}");
        }
    }
}

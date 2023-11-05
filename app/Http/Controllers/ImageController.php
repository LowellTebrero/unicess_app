<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class ImageController extends Controller
{
    public function upload(Request $request, $id ){
        // Validate the uploaded file
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);


        $user = User::find($id);


    // Update the user's avatar URL in the database
        if($request->file('avatar')){
            $image = $request->file('avatar');
            $filename = $user->name.'.'.$image->getClientOriginalExtension();
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(500, 500);
            $resize_image->save(public_path('upload/image-folder/profile-image/'. $filename));

        if(File::exists($resize_image)){
            unlink($resize_image);
        }

        $user->avatar = $filename;
        $user->save();



        return response()->json([
            'message' => 'Avatar updated successfully',
            'avatar_url' => (public_path('upload/image-folder/profile-image/'. $filename)),
        ]);

        }

    }
}

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
    public function upload(Request $request, $id)
    {
        // Validate the uploaded file
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        $user = User::find($id);

        // Update the user's avatar URL in the database
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $filename = $image->hashName(); // Remove '.png' from here since it's already included in the hash name
            $resize_image = Image::make($image->getRealPath())->resize(500, 500);

            // Save the resized image
            $resize_image->save(public_path('upload/image-folder/profile-image/'. $filename));

            // Delete the old avatar file if it exists
            if (File::exists(public_path('upload/image-folder/profile-image/'. $user->avatar))) {
                File::delete(public_path('upload/image-folder/profile-image/'. $user->avatar));
            }

            $user->avatar = $filename;
            $user->save();

            return response()->json([
                'message' => 'Avatar updated successfully',
                'avatar_url' => asset('upload/image-folder/profile-image/'. $filename), // Use 'asset' to generate correct URL
            ]);
        } else {
            return response()->json([
                'message' => 'No avatar provided',
            ], 400);
        }
    }
}

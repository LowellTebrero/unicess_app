<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CreateFolderController;

class CreateFolderController extends Controller
{
    public function index(){


        $folders = Storage::disk('public')->allDirectories();
        dd($folders);

        return view('user.create-folder', compact('folders'))->with('success', 'Folder created successfully.');
    }


    public function store(Request $request)
{
    // Create the folder
    $folderName = $request->input('folder_name');
    Storage::disk('public')->makeDirectory($folderName);

    $path = public_path('upload/');

    if(!File::isDirectory($path)){
        File::makeDirectory($path, 0777, true, true);
    }
    return redirect()->back()->with('success', 'Folder created successfully.');
}
}

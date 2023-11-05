<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('updated_at', 'desc')->get();
        return view('admin.features.index', compact('features'));
    }


    public function create()
    {
        return view('admin.features.create');
    }


    public function store(Request $request)
    {
        $request->validate([

        'description' => 'required',
        'feature_image' => 'required','mimes:jpg,png,jpeg', 'max:5048']);


        $image = $request->feature_image;
        $filename = $request->title.'.'. $image->getClientOriginalExtension();
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize(785, 326);
        $resize_image->save(public_path('upload/image-folder/'. $filename));


        $latest = new Feature();
        $latest->description = $request->description;
        $latest->feature_image = $filename;
        $latest->status = $request->input('status') == true ? '1': '0';

        $latest->save();

    return redirect(route('admin.features.index'))->with('message', 'Feature add successfully');
    // End method
    }


    public function edit($id)
    {
        $features = Feature::where('id', $id)->first();

        return view('admin.features.edit', compact('features'));
        // End method
    }


    public function update(Request $request, $id)
    {
                $request->validate([

                    'title' => 'required',
                    'description' => 'required',
                    'feature_image' => 'mimes:jpg,png,jpeg', 'max:5048']);


                if($request->file('feature_image')){
                $image = $request->file('feature_image');
                $filename = $request->title.'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(785, 326);
                $resize_image->save(public_path('upload/image-folder/features-folder/'. $filename));



                if(File::exists($resize_image)){
                    unlink($resize_image);

                    Feature::where('id', $id)->update([

                        'title' => 'required',
                        'description' => $request->description,
                        'feature_image' => $filename,
                        'status' => $request->input('status') == true ? '1': '0'

                    ]);

                }



                return redirect(route('admin.features.index'))->with('message', 'Features  updated with image successfully');

            }else {

                Feature::where('id', $id)->update([

                    'title' => 'required',
                    'description' => $request->description,
                    'status' => $request->input('status') == true ? '1': '0'
                ]);

                return redirect(route('admin.features.index'))->with('message', 'Features without image updated successfully');
            }
        // End method

    }


    public function delete($id)
    {

        $article = Feature::find($id);
        $destination = public_path(('upload/image-folder/features-folder/'. $article->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $article->delete();

        return redirect(route('admin.features.index'))->with('message', 'Feature has been deleted');
    }

}

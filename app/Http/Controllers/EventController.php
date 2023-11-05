<?php

namespace App\Http\Controllers;

use App\Models\Latest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{

    // Show all
    public function index()
    {
        $event = Latest::all();
        return view('admin.other-events.ceso-events', compact('event'));
    }

    // Post Event
    public function store(Request $request)
    {
        {
            $request->validate([

                'title' => 'required|unique:latests|max:255',
                'description' => 'required',
                'image' => 'required','mimes:jpg,png,jpeg', 'max:5048']);

                $image = $request->image;
                $filename = $request->title.'.'. $image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/event-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                $events = new Latest();
                $events->title = $request->title;
                $events->description = $request->description;
                $events->image = $filename;
                $events->status = $request->input('status') == true ? '1': '0';
                $events->save();

            return redirect(route('admin.other-events-ceso-events'))->with('message', 'Events add successfully');
            // End method


        }
    }


    // Edit Events
    public function edit($id)
    {
        $latestEvents = Latest::where('id', $id)->first();

        return view('admin.other-events.edit-ceso-events', compact('latestEvents'));
        // End method
    }

    // Update Events
    public function update(Request $request, $id)
    {
                $request->validate([

                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'mimes:jpg,png,jpeg', 'max:5048']);

                if($request->file('image')){
                $image = $request->file('image');
                $filename = $request->title.'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/event-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                Latest::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $filename,
                    'status' => $request->input('status') == true ? '1': '0'
                ]);

                return redirect(route('admin.other-events-ceso-events'))->with('message', 'event  updated with image successfully');
            }else {

                Latest::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->input('status') == true ? '1': '0'

                ]);

                return redirect(route('admin.other-events-ceso-events'))->with('message', 'event without image updated successfully');
            }

    }
    // Delete Events
    public function delete($id)
    {

        $event = Latest::find($id);
        $destination = public_path(('upload/image-folder/event-folder/'. $event->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $event->delete();


        return redirect(route('admin.other-events-ceso-events'))->with('message', 'Post has been deleted');
    }
}

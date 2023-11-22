<?php

namespace App\Http\Controllers;

use App\Models\AdminEvent;
use App\Models\AdminYear;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{

    // Show all
    public function index()
    {
        $event = AdminEvent::all();
        return view('admin.other-events.ceso-events', compact('event'));
    }

    public function create(){

        return view('admin.other-events.ceso-create-events');
    }

    // Post Event
    public function store(Request $request)
    {
        {
            $request->validate([

                'title' => 'required|unique:admin_events|max:255',
                'description' => 'required',
                'image' => 'required','mimes:jpg,png,jpeg', 'max:5048']);

                $image = $request->image;
                $filename = Str::limit($request->title, 15).'.'. $image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/event-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                $events = new AdminEvent();
                $events->title = $request->title;
                $events->description = $request->description;
                $events->image = $filename;
                $events->save();

            return redirect(route('admin.other-events-ceso-events'))->with('message', 'Events add successfully');
            // End method


        }
    }


    // Edit Events
    public function edit($id)
    {
        $latestEvents = AdminEvent::where('id', $id)->first();

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

                AdminEvent::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $filename,
                    'status' => $request->input('status') == true ? 'Visible': 'Hidden'
                ]);

                return redirect(route('admin.other-events-ceso-events'))->with('message', 'event  updated with image successfully');
            }else {

                AdminEvent::where('id', $id)->update([

                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->input('status') == true ? 'Visible': 'Hidden'

                ]);

                return redirect(route('admin.other-events-ceso-events'))->with('message', 'event without image updated successfully');
            }

    }
    // Delete Events
    public function delete($id)
    {

        $event = AdminEvent::find($id);
        $destination = public_path(('upload/image-folder/event-folder/'. $event->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $event->delete();

        flash()->addSuccess('Delete Successfully.');
        return redirect(route('admin.other-events-ceso-events'));
    }

    public function updateSystem(Request $request, $id)
    {
        // Find the record in the database
        $toggle = AdminEvent::findOrFail($id);

        // Toggle the data in the table based on the current state
        $toggle->update([
            'status' => $request->input('state') ? 'checked' : 'close',
        ]);

        return response()->json(['success' => true]);

    }


    public function updateStatus(Request $request)
    {
        $taskId = $request->input('task_id');
        $status = $request->input('status');

        $task = AdminEvent::find($taskId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

}

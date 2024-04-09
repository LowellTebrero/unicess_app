<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use App\Models\Template;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\AdminCalendar;
use App\Http\Controllers\Controller;
use App\Models\CustomizeAdminAccess;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OtherSettingsController extends Controller
{
    public function index(){

        $templates = Template::with('medias')->get();
        $years = AdminYear::orderBy('year', 'DESC')->get();
        $faculties =  Faculty::orderBy('name')->get();
        $events = [];
        $appointments  = AdminCalendar::all();
        $AccessData = CustomizeAdminAccess::orderBy('id', 'asc')->get();


        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->title,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }

        return view('admin.other-settings.index', compact('templates', 'years', 'faculties','events', 'appointments','AccessData'));
    }

    public function yearPost(Request $request){

        $request->validate([
            'year' => 'required|integer|unique:admin_years',
        ]);

        AdminYear::create(['year' => $request->year]);

        return redirect(route('admin.template.index'))->with('message', 'Year Save Successfully');
    }

    public function facultyPost(Request $request){

        $request->validate([

            'name' => 'required|unique:faculties'
        ]);

        $new = new Faculty();
        $new->name = $request->name;
        $new->save();

        return redirect(route('admin.template.index'))->with('message', 'Faculty Save Successfully');
    }

    public function post(Request $request){

          $request->validate([
          'template_name' => 'required|mimes:docx,doc|max:5048'
          ]);

          $fileName = $request->template_name->getClientOriginalName();
          $filePath = 'upload/template/'. $fileName;

          $path = Storage::disk('local')->put($filePath, file_get_contents($request->template_name));
          $getFile = Storage::disk('local')->get($path);

          Template::create(['template_name' => $fileName]);

          return back()->with('message', 'Save Successfully');

    }

    public function PostTemplate(Request $request){

        $request->validate(['template_file' => 'required|max:10048']);

        $post = new Template();
        $post->template_name = "template_name";

        if ($templates = $request->file('template_file')) {
            foreach ($templates as $template) {
                $post->addMedia($template)->usingName('template')->toMediaCollection('TemplateFile');
            }
        }

        $post->save();

        flash()->addSuccess('File Uploaded Successfully.');
        return back();
    }

    public function TemplateUpdate(Request $request, $id){

        $request->validate([
            'template_file' => "required|max:10048",
           ]);

        $post = Template::where('id', $id)->first();

        if ($templates = $request->file('template_file')) {
            foreach ($templates as $template) {
                $post->addMedia($template)->usingName('template')->toMediaCollection('TemplateFile');
            }
        }

        flash()->addSuccess('File Uploaded Successfully.');
        return back();
    }


    public function deleteMediasTemplate($id, $templateId)
    {
        $media = Media::findOrFail($id);
        $narrativeReport = Template::findOrFail($templateId);
        $media->delete();

        // Check if the related NarrativeReport should be deleted
        if ($narrativeReport->medias()->count() === 0) {
            $narrativeReport->delete();
            flash()->addSuccess('File and related NarrativeReport deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        AdminCalendar::create($data);

        flash()->addSuccess('Data Uploded Successfully.');
        return redirect()->route('admin.calendar.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => 'required',
        ]);

        AdminCalendar::where('id', $id)->update([

            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        flash()->addSuccess('Data Updated Successfully.');
        return back();
    }
    public function delete($id){

        $data = AdminCalendar::find($id);
        $data->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }

    public function UpdateAccess(Request $request, $id)
    {
        // Find the record in the database
        $toggle = CustomizeAdminAccess::findOrFail($id);

        // Toggle the data in the table based on the current state
        $toggle->update([
            'status' => $request->input('state') ? 'checked' : 'close',
        ]);

        return response()->json(['success' => true]);

    }

}
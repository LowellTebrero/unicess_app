<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use App\Models\Template;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class OtherSettingsController extends Controller
{
    public function index(){

        $templates = Template::all();
        $years = AdminYear::orderBy('year', 'DESC')->get();
        $faculties =  Faculty::orderBy('name')->get();
        return view('admin.other-settings.index', compact('templates', 'years', 'faculties'));
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

    public function update(Request $request, $id){

        $request->validate(['template_name' => 'required|file|mimetypes:application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:5048']);


        if($request->hasFile("template_name")){

            $template = Template::find($id);

            $exists = Storage::disk('local')->exists("upload/template/".$template->template_name);

            if($exists){
                Storage::disk("local")->delete('upload/template/'.$template->template_name);

            }

            $fileName = $request->template_name->getClientOriginalName();
            $filePath = 'upload/template/'. $fileName;

            Storage::disk('local')->put($filePath, file_get_contents($request->template_name));

            Template::where('id', $id)->update(['template_name' => $fileName]);
        }

        flash()->addSuccess('File update Successfully');
        return redirect(route('admin.template.index'));

    }

    public function download($template_name){

        return response()->download(public_path('upload/template/'. $template_name));
    }
}

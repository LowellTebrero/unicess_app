<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminProgramServices;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class AdminProgramServicesController extends Controller
{
    public function index(){

        $programservices = AdminProgramServices::all();

        return view('admin.program_services.index', compact('programservices'));
    }

    public function ProgramServicesUpdate(Request $request, $id)
    {
                $request->validate([
                    'title' => 'required',
                    'description'  => 'required',
                    'image' => 'mimes:jpg,png,jpeg', 'max:5048']);

                if($request->file('image')){
                $image = $request->file('image');
                $filename = Str::limit($request->title, 15).'.'.$image->getClientOriginalExtension();
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(600, 500);
                $resize_image->save(public_path('upload/image-folder/program-services-folder/'. $filename));

                if(File::exists($resize_image)){
                    unlink($resize_image);
                }

                AdminProgramServices::where('id', $id)->update([
                    'description' => $request->description,
                    'image' => $filename,

                ]);

                  flash()->addSuccess('Program Services Updated Successfully.');
                return back();
            }else {

                AdminProgramServices::where('id', $id)->update([
                    'description' => $request->description,
                ]);

                flash()->addSuccess('Program Services Updated Successfully.');
                return back();
        }

    }

    public function ProgramServicesDelete($id){

        $programservices = AdminProgramServices::find($id);
        $destination = public_path(('upload/image-folder/program-services-folder/'. $programservices->image));
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $programservices->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }

    public function UpdateToggleStatus(Request $request)
    {
        $articleId = $request->input('article_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($articleId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoPhysical(Request $request)
    {
        $physicalId = $request->input('physical_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($physicalId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoInformation(Request $request)
    {
        $informationId = $request->input('information_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($informationId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoLiteracy(Request $request)
    {
        $literacyId = $request->input('literacy_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($literacyId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoCultural(Request $request)
    {
        $culturalId = $request->input('cultural_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($culturalId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoLivelihood(Request $request)
    {
        $livelihoodId = $request->input('livelihood_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($livelihoodId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoEnvironmental(Request $request)
    {
        $environmentalId = $request->input('environmental_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($environmentalId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoManagement(Request $request)
    {
        $managementId = $request->input('management_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($managementId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function UpdateToggleStatustoSpecial(Request $request)
    {
        $specialId = $request->input('special_id');
        $status = $request->input('status');

        $task = AdminProgramServices::find($specialId);
        $task->update(['status' => $status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

}

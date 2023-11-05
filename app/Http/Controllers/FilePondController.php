<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FilePondController extends Controller
{
    public function FilePondStore(Request $request, Proposal $proposals )
    {
        // Validate the uploaded file
        $request->validate([
            'moa'          => 'mimes:pdf',
            'office_order' => "mimes:pdf",
            'travel_order' => "mimes:pdf",
        ]);

        $project_title = $proposals->project_title;

        // Get the uploaded file
        if ($request->hasFile('moa')) {
            $proposals->clearMediaCollection('MoaPDF');
            $proposals->addMediaFromRequest('moa')->usingName('moa')->usingFileName($project_title.'_moa.pdf')->toMediaCollection('MoaPDF');
        }

        if ($request->hasFile('office_order')) {
            $proposals->clearMediaCollection('officeOrder');
            $proposals->addMediaFromRequest('office_order')->usingName('office')->usingFileName($project_title.'_office_order.pdf')->toMediaCollection('officeOrder');
        }

        if ($request->hasFile('travel_order')) {
            $proposals->clearMediaCollection('travelOrder');
            $proposals->addMediaFromRequest('travel_order')->usingName('travel')->usingFileName($project_title.'_travel_order.pdf')->toMediaCollection('travelOrder');
        }

        if ($images = $request->file('other_files')) {
        foreach ($images as $image) {
            $proposals->addMedia($image)->usingName('other')->toMediaCollection('otherFile');
        }
    }

    return redirect()->back()->with('success', 'PDF uploaded and associated with the post successfully');
    }


    public function DeleteProposal(){


        // $media = Media::where('model_id',  $request->getContent())->first();
        // $media = $request->getContent();

        // dd($media);


        // Storage::deleteDirectory('public/storage/'. $media);
        // $media->delete();



        return redirect()->back()->with('delete', 'Delete successfully');

    }

}

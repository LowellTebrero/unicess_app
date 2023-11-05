<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\ProposalProject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomizeUserInventory;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class InventoryController extends Controller
{
    public function index()
    {
        $myId = Auth::user()->id;
        $inventory = CustomizeUserInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposalyear = Proposal::select('created_at')->pluck('created_at');


        $proposals = Proposal::whereYear('created_at',  date('Y'))->with(['proposal_members' => function ($query) {
            $query->where('user_id', auth()->user()->id);
            }])->orderBy('created_at', 'DESC')->with('programs')->distinct()->get();



        return view('user.inventory.index', compact('inventory', 'years', 'myId', 'proposals'));
    }

    public function show($id)
    {
        $proposals = Proposal::where('id', $id)->with('medias')->with('programs')->first();
        // dd($proposals);
        $proposal = Proposal::where('id', $id)->with('programs')->where('authorize', 'finished')->first();
        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->first();

        return view('user.inventory.show', compact('proposals', 'proposal', 'proposal_member'));


    }

    // Universal User
    public function downloadsPdf($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('proposalPdf');
        return $pdf;
    }

    public function downloadsOther($id)
    {
        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('otherFile');
        return MediaStream::create('my-files.zip')->addMedia($downloads);
    }

    // Download All
    public function download($id)
    {

        $proposals = Proposal::where('id', $id)->first();
        $downloads = Media::where('model_id',$proposals->id)->get();
        return MediaStream::create($proposals->project_title.'.zip')->addMedia($downloads);
    }


    // Delete
    public function deleteMedias($id)
    {
        $media = Media::findorFail($id);
        $media->delete();
        return back()->with('message', 'Deleted successfully');

    }

    // Download
    public function DownloadMedias($id)
    {
        $downloads = Media::where('id',$id)->first();
        return $downloads;
    }

    // Rename
    public function RenameFiles(Request $request, $id)
    {
        Media::findorFail($id)->update(['file_name' => $request->file_name, ]);
        return back()->with('message', 'Status updated successfully');
    }


    public function userUpdateFiles(Request $request, $id)
    {
       $proposals = Proposal::where('id', $id)->first();
       $project_title = $proposals->project_title;


       if ($request->hasFile('proposal_pdf')) {
        $proposals->clearMediaCollection('proposalPdf');
        $proposals->addMediaFromRequest('proposal_pdf')->usingName('proposal')->usingFileName($project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');
    }


         if ($request->hasFile('moa')) {
             $proposals->clearMediaCollection('MoaPDF');
             $proposals->addMediaFromRequest('moa')->usingName('moa')->usingFileName($project_title.'_moa.pdf')->toMediaCollection('MoaPDF');
         }

         if ($images = $request->file('other_files')) {

            // $collectionName = 'otherFile';

            // $model = Media::find($id);

            foreach ($images as $image) {

                // $existingMedia = $model->getMedia($collectionName, $image->getClientOriginalName());

                // if ($existingMedia) {
                //     // File with the same name already exists; handle the filename conflict
                //     $originalName = $image->getClientOriginalName();
                //     $extension = $image->getClientOriginalExtension();
                //     $i = 1;

                //     while ($existingMedia) {
                //         $newFilename = $originalName . " ($i).$extension";
                //         $existingMedia = $model->getFirstMediaUrl($collectionName, $newFilename);
                //         $i++;
                //     }

                //     $proposals->addMedia($image)
                //     ->toMediaCollection($collectionName)
                //     ->usingName($newFilename)->toMediaCollection('otherFile');

                // }else {

                $proposals->addMedia($image)->usingName('other')->toMediaCollection('otherFile');
            // }
            }
        }
         $proposals->update();
         return back()->with('message', 'Status updated successfully');
    }


    // Admin Inventory
    public function ShowFiles($id)
    {

        $proposals = Proposal::where('id', $id)->with('medias')->with('programs')->first();
        $proposal = Proposal::where('id', $id)->with('programs')->where('authorize', 'finished')->first();
        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->first();
        return view('admin.inventory.show-inventory', compact('proposals', 'proposal', 'proposal_member'));
    }



    public function updateData(Request $request, $id){
        // Find the model instance you want to update
        $model = CustomizeUserInventory::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Update the model attributes based on the dropdown value
        $model->number = $request->input('selected_value');
        $model->save();

        return response()->json(['message' => 'Data updated successfully']);
    }



    public function filterInventoryYear(Request $request, $id){

        $inventory = CustomizeUserInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $myId = $id;
        $query = $request->input('query');

        $proposals = Proposal::with(['proposal_members' => function ($query) use ($myId) {
            $query->where('user_id', $myId);
            }])
            ->with('programs')
            ->when($query, function ($querys) use ($query) {
                return $querys->where('project_title', 'like', "%$query%");})
            ->where(function ($query) {
            if($Year = request('mydropdown')){
            $query->whereYear('created_at', $Year);
            }})
            ->orderBy('created_at', 'DESC')->distinct()->get();

        $data = [
            'proposals'  => $proposals,
            'inventory'  => $inventory,
            'years'  => $years,
            'myId'  => $myId,


        ];

        return view('user.inventory.index._filter_index' )->with($data);

    }

    public function search(Request $request, $id)
    {
        $search = $request->input('query');
        $inventory = CustomizeUserInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $myId = $id;



        $proposals = Proposal::with(['proposal_members' => function ($query) use ($myId) { $query->where('user_id', $myId);}])
        ->where(function ($query) {
            if($Year = request('selected_value')){
            $query->whereYear('created_at', $Year);
            }})->when($search, function ($querys) use ($search) {
                    return $querys->where('project_title', 'like', "%$search%");
            })->with('programs')->orderBy('created_at', 'DESC')->distinct()->get();

        $data = [
            'proposals'  => $proposals,
            'inventory'  => $inventory,
            'years'  => $years,
            'myId'  => $myId,
        ];

        return view('user.inventory.index._filter_index' )->with($data);
    }



    public function downloadsMedia(Media $id)
    {
        return response()->download($id->getPath(), $id->file_name);
    }

}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\ParticipationName;
use Illuminate\Support\Facades\DB;
use App\Models\CustomizeAdminInventory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class ProjectProposalController extends Controller

{

    // Delete Media
    public function deleteMedia($id)
    {
        $media = Media::findorFail($id);
        $media->delete();
        return back()->with('message', 'Deleted successfully');

    }

    // Download
    public function DownloadMedia($id)
    {
        $downloads = Media::where('id',$id)->first();
        return $downloads;
    }

    // Rename File
    public function RenameFile(Request $request, $id)
    {
        Media::findorFail($id)->update([ 'file_name' => $request->file_name, ]);
        return back()->with('message', 'Status updated successfully');
    }

     // Show Faculty Admin
         public function show($id)
        {
         $proposalID = Proposal::with('programs')

         ->whereHas('user', function($query){
             $query->with('faculty')
         ->whereHas('faculty', function ($query){
                 if($facultyId = request('faculty_id')) {
                     $query->where('faculty_id', $facultyId);
                 }
            });
         })->get();

         $facs = Faculty::where('id', $id)->first();
         $userfaculty = User::where('id', $id)->first();
         $programID =   Program::where('id', $id)->first();
         $allFaculty = Faculty::orderBy('name')->pluck('name', 'id')->prepend('All Faculty', '');

         return view('admin.proposal.show' , compact('proposalID', 'programID', 'userfaculty', 'facs', 'allFaculty'));
        }


        public function showFaculty($id)
        {
         $proposalID = Proposal::with('programs')
         ->whereHas('users', function($query){
          $query->with('faculties');})->get();

         $programID =   Program::where('id', $id)->first();
         $userFaculty = Faculty::where('id', $id)->first();
         return view('admin.proposal.show_faculty', compact('proposalID', 'programID','userFaculty'));
        }


    //  Delete Proposal for Admin
        public function DeleteProposal($id)
        {
           $proposalDelete = Proposal::where('id', $id)->first();
           $proposalDelete->delete();

            return back()->with('message', 'Proposal has been deleted');
        }

        public function AdminDeleteProposal($id)
        {
           $proposalDelete = Proposal::where('id', $id)->first();
           $proposalDelete->delete();

            return redirect(route('admin.dashboard.index'))->with('message', 'Proposal has been deleted');
        }



}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\TrashedRecord;
use App\Models\ParticipationName;
use Illuminate\Support\Facades\DB;
use App\Models\CustomizeAdminInventory;
use Illuminate\Notifications\Notification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Notifications\UserDeletedProposaleNotification;
use App\Notifications\AdmindDeletedProposaleNotification;


class ProjectProposalController extends Controller

{

    // Delete Media
    public function MoveToTrashMedia(Request $request)
    {
        $ids = $request->ids;

        // Update each media item
        foreach ($ids as $id) {
            $media = Media::findOrFail($id);
            $media->collection_name = 'trash';
            $media->save();
        }
        if ($media) {
            // Flash a success message
            return response()->json(['success' => 'Trashed Successfully']);
        } else {
            // Flash an error message
            return response()->json(['error' => 'Error Moving file'], 500);
        }

    }

    // Delete Media
    public function deleteMedia(Request $request)
    {
        $id = $request->id;
        $proposalDelete =  Media::destroy($id);


        if ($proposalDelete) {
            // Flash a success message
            return response()->json(['success' => 'Deleted Successfully']);
        } else {
            // Flash an error message
            return response()->json(['error' => 'Error deleting file'], 500);
        }

    }
    // Delete in Proposal Chart
    public function DeleteProposalFolder(Request $request)
    {

        $ids = $request->ids;
        DB::table('notifications')->whereJsonContains('data->proposal_id', $ids)->delete();
        $proposalDelete =  Proposal::destroy($ids);

        if ($proposalDelete) {
            // Flash a success message
            return response()->json(['success' => 'Deleted Successfully']);
        } else {
            // Flash an error message
            return response()->json(['error' => 'Error deleting file'], 500);
        }

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
           $proposalDelete = Proposal::find($id);

           $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();
            // Notify each admin individually
            foreach ($admin as $adminUser) {
                $adminUser->notify(new AdmindDeletedProposaleNotification($proposalDelete));
            }
            // Notify Users
           foreach($proposalDelete->proposal_members as $member){

                $users = User::where('id', $member->user_id )->get();
                foreach($users as $user){
                    $user->notify(new UserDeletedProposaleNotification($proposalDelete));
                }

            }

            $trashRecord = new TrashedRecord();
            $trashRecord->uuid = $proposalDelete->uuid;
            $trashRecord->user_id = Auth()->user()->id;
            $trashRecord->save();

           // proposal delete
           $proposalDelete->delete();

           $notifications = DB::table('notifications')->get();

            foreach ($notifications as $notification) {
                // Decode the JSON string into an array
                $data = json_decode($notification->data, true);

                // Check if the data array has an 'id' matching the one you want to delete
                if (is_array($data) && array_key_exists('id', $data) && $data['id'] == $id) {
                // Delete the notification

                    DB::table('notifications')->where('id', $notification->id)->delete();
                }
                    // Check if the data array has an 'id' matching the one you want to delete
                if (is_array($data) && array_key_exists('proposal_id', $data) && $data['proposal_id'] == $id) {
                // Delete the notification

                    DB::table('notifications')->where('id', $notification->id)->delete();
                }

                if (is_array($data) && array_key_exists('proposal_status_id', $data) && $data['proposal_status_id'] == $id) {
                // Delete the notification

                    DB::table('notifications')->where('id', $notification->id)->delete();
                }

            }




            return redirect(route('admin.dashboard.index'))->with('message', 'Proposal has been deleted');
        }



}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\TrashedRecord;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CustomizeAdminInventory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Notifications\UserDeletedProposaleNotification;
use App\Notifications\AdmindDeletedProposaleNotification;

class AdminInventoryController extends Controller
{

    // Admin Main Index Inventory
    public function index()
    {
        $program = Program::all();
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $medias = Media::whereNot('collection_name', 'trash')->get();
        $proposals = Proposal::orderBy('created_at', 'ASC')->get();
        $users = User::all();
        $totalFileSize = $this->getTotalFileSize();


        return view('admin.inventory.index', compact('program' , 'proposal', 'inventory', 'medias', 'years', 'proposals','users','totalFileSize'));
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
      $users = User::all();

      return view('admin.inventory.show' , compact('proposalID', 'programID', 'userfaculty', 'facs', 'allFaculty','users'));
    }


    public function showInventory($id){

        $users = User::all();
        $proposals = Proposal::where('id', $id)->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')->orderBy('file_name', 'asc');
        }, 'programs'])
        ->first();

        $uniqueProposalFiles = $proposals->medias->unique('collection_name');

        $formedia = Proposal::where('id', $id)
            ->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }])->first();

        $uniqueformedias = $formedia->medias->unique('collection_name');
        $latest = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
            $query->latest()->first();
        }])->first();


        return view('admin.inventory.show-inventory', compact('proposals', 'formedia','uniqueformedias','uniqueProposalFiles','users'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();

        $medias = Media::where(function ($query) {
            if($companyId = request('selected_value')){
                $query->whereYear('created_at', $companyId);
            }})
            ->where(function ($query) {
                if($companyId = request('files')){
                    $query->where('collection_name', $companyId);
                }})
            ->when($query, function ($querys) use ($query) {
                return $querys->where('file_name', 'like', "%$query%");
            })->orderBy('file_name', 'ASC')->whereNot('collection_name', 'trash')->get();
            $users = User::all();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years', 'users'));
    }

    public function filter(Request $request){
        $query = $request->input('query');

        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();


        $medias = Media::when($query, function ($querys) use ($query) {
            return $querys->where('file_name', 'like', "%$query%");
        })
        ->where(function ($query) {
            if($companyId = request('files')){
                $query->where('collection_name', $companyId);}})
        ->where(function ($query) {
            if($companyId = request('year')){
                $query->whereYear('created_at', $companyId);}})
        ->orderBy('file_name', 'ASC')->whereNot('collection_name', 'trash')->get();
        $users = User::all();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years', 'users'));
    }


    public function sortfile(Request $request){
        $query = $request->input('query');

        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();

        $medias = Media::when($query, function ($querys) use ($query) {
            return $querys->where('file_name', 'like', "%$query%");})
            ->where(function ($query) {
                if($companyId = request('year')){
                    $query->whereYear('created_at', $companyId);}})
            ->where(function ($query) {
                if($companyId = request('selected_value')){
                    $query->where('collection_name', $companyId);}})
            ->orderBy('file_name', 'ASC')->whereNot('collection_name', 'trash')->get();
            $users = User::all();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years', 'users'));
    }

    public function sort(Request $request){
        $query = $request->input('query');
        $sort = $request->input('selected_value', 'asc');

        $program = Program::all();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposal = DB::table('proposals')->select('program_id', DB::raw('count(*) as qty'))->groupBy('program_id')->get();
        $inventory = CustomizeAdminInventory::where('id', 1)->get();

        $medias = Media::when($query, function ($querys) use ($query) {
            return $querys->where('file_name', 'like', "%$query%");})
            ->where(function ($query) {
                if($companyId = request('year')){
                    $query->whereYear('created_at', $companyId);}})
            ->where(function ($query) {
                if($companyId = request('files')){
                    $query->where('collection_name', $companyId);}})
            ->orderBy('file_name', $sort)->whereNot('collection_name', 'trash')->get();
            $users = User::all();

        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years', 'users'));
    }

    public function InventorydownloadMedia(Media $id){

        return response()->download($id->getPath(), $id->file_name);
    }

    public function deleteMedia($id)
    {
        Media::destroy($id);

        flash()->addSuccess('File Deleted Successfully');
        return back();
    }

    public function AdminDeleteInventoryProposal($id)
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
        $trashRecord->name = $proposalDelete->project_title;
        $trashRecord->type = 'project';
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

        flash()->addSuccess('Project Deleted Successfully');
        return back();
    }

    public function BackUpProject(){

    $proposals = Proposal::all();
    $date = now()->format('F_d_Y'); // Get the current date in the desired format
    $mainZip = new \ZipArchive();
    $mainZipFileName = $date . '_projects_backup.zip';
    if ($mainZip->open($mainZipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
        foreach($proposals as $proposal){
            $proposalZip = new \ZipArchive();
            $proposalZipFileName = $proposal->project_title . '_backup.zip';
            if ($proposalZip->open($proposalZipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
                $media = Media::where('model_id', $proposal->id)->where('collection_name', '<>', 'trash')->get();
                foreach ($media as $file) {
                    $proposalZip->addFile($file->getPath(), $file->file_name);
                }
                $proposalZip->close();
                $mainZip->addFromString($proposalZipFileName, file_get_contents($proposalZipFileName));
                unlink($proposalZipFileName); // Remove the temporary proposal ZIP file
            } else {
                // handle the case where proposal zip file couldn't be created
            }
        }
        $mainZip->close();
        return response()->download($mainZipFileName)->deleteFileAfterSend();
    } else {
        // handle the case where main zip file couldn't be created
    }


    }

    public function getTotalFileSize() {
        // Retrieve all the files from the Media model
        $mediaFiles = Media::all();

        $totalSizeBytes = 0;

        // Loop through each file to calculate total size in bytes
        foreach ($mediaFiles as $file) {
            // Parse file size from KB to bytes
            $size = strtolower(preg_replace('/[^0-9\.]/', '', $file->size));
            $numericValue = (float)$size;
            $fileSizeBytes = (strpos($file->size, 'kb') !== false) ? $numericValue * 1024 : $numericValue;

            // Add the file size to the total size
            $totalSizeBytes += $fileSizeBytes;
        }

        // Convert total size to the appropriate unit
        $totalSize = $this->formatSize($totalSizeBytes);

        return $totalSize;
    }

    public function formatSize($bytes) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        // Loop through units until bytes are smaller than 1024
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        // Round to two decimal places
        return round($bytes, 2) . ' ' . $units[$i];
    }

}

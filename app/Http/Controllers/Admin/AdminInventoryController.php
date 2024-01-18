<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\NarrativeReport;
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
        $medias = Media::orderBy('file_name', 'ASC')->get();
        $proposals = Proposal::orderBy('created_at', 'ASC')->get();

        return view('admin.inventory.index', compact('program' , 'proposal', 'inventory', 'medias', 'years', 'proposals'));
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

      return view('admin.inventory.show' , compact('proposalID', 'programID', 'userfaculty', 'facs', 'allFaculty'));
     }


     public function showInventory($id){

        $proposals = Proposal::where('id', $id)->first();

        $formedia = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
            $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
        },
        'narrativereport' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]); // Nested 'with' for 'medias' inside 'narrativereport'
        },
        'terminalreport' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
                ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]); // Nested 'with' for 'medias' inside 'narrativereport'
        },])->first();

        $latest = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
            $query->latest()->first();
        }])->first();

        $narrativeCount = NarrativeReport::distinct('user_id')->count();
        $terminalCount = TerminalReport::distinct('user_id')->count();
        $memberCount = ProposalMember::where('proposal_id', $id)->count();

        return view('admin.inventory.show-inventory', compact('proposals', 'formedia','latest','narrativeCount','terminalCount','memberCount'));
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
            })->orderBy('file_name', 'ASC')->get();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

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
        ->orderBy('file_name', 'ASC')->get();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

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
                                    ->orderBy('file_name', 'ASC')->get();


        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

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
                        ->orderBy('file_name', $sort)->get();

        return view('admin.inventory.index-filter._all-files-medias', compact('program' , 'proposal', 'inventory', 'medias', 'years'));

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

        }

        flash()->addSuccess('Project Deleted Successfully');
        return back();
    }




}

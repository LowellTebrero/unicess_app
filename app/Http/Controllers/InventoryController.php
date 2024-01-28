<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\UserAttendance;
use App\Models\NarrativeReport;
use App\Models\UserOfficeOrder;
use App\Models\UserTravelOrder;
use App\Models\UserSpecialOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomizeUserInventory;
use App\Models\UserAttendanceMonitoring;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Notifications\UserDeletedTheirProposaleNotification;
use App\Notifications\AdminDeletedProposaleFromUserNotification;

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
        $proposalmember = ProposalMember::where('user_id', auth()->user()->id)->distinct('user_id')->get();


        return view('user.inventory.index', compact('inventory', 'years', 'myId', 'proposals', 'proposalmember'));
    }

    public function show($id, $notification)
    {
        $proposals = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
            $query->orderBy('file_name', 'asc');
        }, 'programs'])
        ->first();

        $formedia = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
            $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
        },
        'travelorder' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]);
        },
        'specialorder' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]);
        },
        'officeorder' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]);
        },
        'attendance' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]);
        },
        'attendancemonitoring' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]);
        },
        'narrativereport' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]);
        },
        'terminalreport' => function ($query) {
            $query->with(['medias' => function ($query) {
                $query->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
                ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            }]);
        },])->first();

        // dd($formedia);



        $members = User::orderBy('name')->whereNot('name', 'Administrator')->pluck('name', 'id')->prepend('Select Username', '');
        $inventory = CustomizeUserInventory::where('id', 2)->get();
        $proposal = Proposal::where('id', $id)->with('programs')->where('authorize', 'finished')->first();
        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->first();
        $program = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');


        $travelCount = UserTravelOrder::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'user_travel_orders.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('user_travel_orders.user_id')
        ->count();
        $specialCount = UserSpecialOrder::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'user_special_orders.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('user_special_orders.user_id')
        ->count();
        $officeCount = UserOfficeOrder::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'user_office_orders.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('user_office_orders.user_id')
        ->count();
        $attendanceCount = UserAttendance::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'user_attendances.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('user_attendances.user_id')
        ->count();

        $attendancemCount = UserAttendanceMonitoring::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'user_attendance_monitorings.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('user_attendance_monitorings.user_id')
        ->count();
        $narrativeCount = NarrativeReport::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'narrative_reports.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('narrative_reports.user_id')
        ->count();
        $terminalCount = TerminalReport::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'terminal_reports.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('terminal_reports.user_id')
        ->count();
        $memberCount = ProposalMember::where('proposal_id', $id)
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'proposal_members.user_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=', 'admin')
        ->distinct('proposal_members.user_id')
        ->count();

        // $travelCount = UserTravelOrder::where('proposal_id', $id)->distinct('user_id')->count();
        // $specialCount = UserSpecialOrder::where('proposal_id', $id)->distinct('user_id')->count();
        // $officeCount = UserOfficeOrder::where('proposal_id', $id)->distinct('user_id')->count();
        // $attendanceCount = UserAttendance::where('proposal_id', $id)->distinct('user_id')->count();
        // $attendancemCount = UserAttendanceMonitoring::where('proposal_id', $id)->distinct('user_id')->count();
        // $narrativeCount = NarrativeReport::where('proposal_id', $id)->distinct('user_id')->count();
        // $terminalCount = TerminalReport::where('proposal_id', $id)->distinct('user_id')->count();
        // $memberCount = ProposalMember::where('proposal_id', $id)->count();
        if($notification){
            auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        }

        return view('user.inventory.show', compact('proposals', 'proposal', 'proposal_member', 'inventory', 'program', 'members'
        ,'formedia','narrativeCount', 'terminalCount', 'memberCount','travelCount','specialCount','officeCount','attendanceCount'
        ,'attendancemCount'));

    }

    public function UpdateShowInventory(Request $request, $id)
    {
        $proposals = Proposal::where('id', $id)->first();

        $request->validate([
            'program_id' => 'required',
            'project_title' => 'required',
            'started_date' => 'required',
            'finished_date' => 'required',
        ]);

      $proposed = Proposal::where('id', $proposals->id)->update([

            'program_id' => $request->program_id,
            'project_title' => $request->project_title,
            'started_date' =>  $request->started_date,
            'finished_date' =>  $request->finished_date,
        ]);

        if ($proposed) {

            if($request->member !== null){

                ProposalMember::where('proposal_id', $proposals->id)->delete();
                foreach ($request->member as $item) {

                    $model = new ProposalMember();
                    $model->proposal_id = $proposals->id;
                    $model->user_id = $item['id'];
                    $model->save();
                }

                }else {
                    ProposalMember::where('proposal_id', $proposals->id)->delete();
                }


            app('flasher')->addSuccess('Proposal details successfully updated.');


            return back();
        }

        app('flasher')->addError('Something went wrong.');
        return back();
    }

    // Universal User
    public function downloadProposalPdf($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('proposalPdf');
        return $pdf;
    }

    public function downloadsSpecialOrder($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('specialOrderPdf');
        return $pdf;
    }

    public function downloadsOffice($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('officeOrderPdf');
        return $pdf;
    }

    public function downloadsTravel($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('travelOrderPdf');
        return $pdf;
    }

    public function downloadsMoa($id)
    {
        $proposals = Proposal::findorFail($id);
        $moapdf = $proposals->getFirstMedia('MoaPDF');
        return $moapdf;
    }

    public function downloadsOther($id)
    {
        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('otherFile');
        return MediaStream::create($proposals->project_title.'-'.'otherFile.zip')->addMedia($downloads);
    }

    public function downloadNarrative($id){

        $narrative = NarrativeReport::where('proposal_id',$id)->first();
        $downloads = $narrative->getMedia('NarrativeFile');
        return MediaStream::create($narrative->proposals->project_title.'-'.'NarrativeFiles.zip')->addMedia($downloads);
    }

    public function downloadTerminal($id){

        $terminal = TerminalReport::where('proposal_id',$id)->first();
        $downloads = $terminal->getMedia('TerminalFile');
        return MediaStream::create($terminal->proposals->project_title.'-'.'TerminalFiles.zip')->addMedia($downloads);
    }


    public function downloadTravelorder($id){

        $travelorder = UserTravelOrder::where('proposal_id',$id)->first();
        $downloads = $travelorder->getMedia('travelOrderPdf');
        return MediaStream::create($travelorder->proposals->project_title.'-'.'TravelOrderFiles.zip')->addMedia($downloads);
    }

    public function downloadSpecialorder($id){

        $specialorder = UserSpecialOrder::where('proposal_id',$id)->first();
        $downloads = $specialorder->getMedia('specialOrderPdf');
        return MediaStream::create($specialorder->proposals->project_title.'-'.'SpecialOrderFiles.zip')->addMedia($downloads);
    }

    public function downloadOfficeorder($id){

        $officeorder = UserOfficeOrder::where('proposal_id',$id)->first();
        $downloads = $officeorder->getMedia('officeOrderPdf');
        return MediaStream::create($officeorder->proposals->project_title.'-'.'OfficeOrderFiles.zip')->addMedia($downloads);
    }

    public function downloadAttendance($id){

        $attendance = UserAttendance::where('proposal_id',$id)->first();
        $downloads = $attendance->getMedia('Attendance');
        return MediaStream::create($attendance->proposals->project_title.'-'.'AttendanceFiles.zip')->addMedia($downloads);
    }

    public function downloadAttendancem($id){

        $terminal = UserAttendanceMonitoring::where('proposal_id',$id)->first();
        $downloads = $terminal->getMedia('AttendanceMonitoring');
        return MediaStream::create($terminal->proposals->project_title.'-'.'AttendanceMonitoringFiles.zip')->addMedia($downloads);
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
        $request->validate([
            'proposal_pdf' => 'mimes:pdf',
            'moa_pdf' => 'mimes:pdf',
            'special_order_pdf' => "max:10048",
            'travel_order' => "max:10048",
            'office_order' => "max:10048",
            'attendance' => "max:10048",
            'attendancem' => "max:10048",
        ]);

       $proposals = Proposal::where('id', $id)->first();
       $project_title = $proposals->project_title;
       $proposals->update();

        if ($request->hasFile('proposal_pdf')) {
        $proposals->addMediaFromRequest('proposal_pdf')->usingName('proposal')->usingFileName($project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');
        }

        if ($request->hasFile('moa_pdf')) {
            $proposals->clearMediaCollection('MoaPDF');
            $proposals->addMediaFromRequest('moa_pdf')->usingName('moa')->usingFileName($project_title.'_moa.pdf')->toMediaCollection('MoaPDF');
        }

        if ($specialorder = $request->file('special_order_pdf')) {

            $special = new UserSpecialOrder();
            $special->user_id  = auth()->id();
            $special->proposal_id  = $proposals->id;
            $special->save();

            foreach ($specialorder as $specials) {
                $special->addMedia($specials)->usingName('special_order')->toMediaCollection('specialOrderPdf');
            }
        }

        if ($travelorder = $request->file('travel_order_pdf')) {

            $travel = new UserTravelOrder();
            $travel->user_id  = auth()->id();
            $travel->proposal_id  = $proposals->id;
            $travel->save();

            foreach ($travelorder as $travels) {
                $travel->addMedia($travels)->usingName('travel_order_pdf')->toMediaCollection('travelOrderPdf');
            }
        }

        if ($officeorder = $request->file('office_order_pdf')) {

            $office = new UserOfficeOrder();
            $office->user_id  = auth()->id();
            $office->proposal_id  = $proposals->id;
            $office->save();

            foreach ($officeorder as $offices) {
                $office->addMedia($offices)->usingName('office_order_pdf')->toMediaCollection('officeOrderPdf');
            }
        }

        if ($attendance = $request->file('attendance')) {

            $attend = new UserAttendance();
            $attend->user_id  = auth()->id();
            $attend->proposal_id  = $proposals->id;
            $attend->save();

            foreach ($attendance as $attends) {
                $attend->addMedia($attends)->usingName('attendance')->toMediaCollection('Attendance');
            }
        }
        if ($attendancem = $request->file('attendancem')) {

            $attendances = new UserAttendanceMonitoring();
            $attendances->user_id  = auth()->id();
            $attendances->proposal_id  = $proposals->id;
            $attendances->save();

            foreach ($attendancem as $attendm) {
                $attendances->addMedia($attendm)->usingName('attendancemonitoring')->toMediaCollection('AttendanceMonitoring');
            }
        }


        if ($files = $request->file('other_files')) {

            foreach ($files as $file) {
                $proposals->addMedia($file)->usingName('other')->toMediaCollection('otherFile');
            }
        }


        $proposals->update();
        app('flasher')->addSuccess('Files successfully updated.');
        return back();

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


    public function updateShowData(Request $request, $id){
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

    public function UserDeleteInventoryProposal($id){

        $proposal = Proposal::findorFail($id);

        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();
        // Notify each admin individually
        foreach ($admin as $adminUser) {
            $adminUser->notify(new AdminDeletedProposaleFromUserNotification($proposal));
        }
        // Notify Users
       foreach($proposal->proposal_members as $member){

            $users = User::where('id', $member->user_id )->get();
            foreach($users as $user){
                $user->notify(new UserDeletedTheirProposaleNotification($proposal));
            }

       }
       // proposal delete
       $proposal->delete();


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


        app('flasher')->addSuccess('Proposal Delete successfully');

        return redirect(route('inventory.index'));
    }



}

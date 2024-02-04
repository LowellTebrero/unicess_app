<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\ProposalFiles;
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

    public function show($id, $notification){


        $proposals = Proposal::where('id', $id)->with(['proposalfiles' => function ($query) {
            $query->with(['medias' => function ($mediaQuery) {
                $mediaQuery->whereNot('collection_name', 'trash');
            }]);
            }])
        ->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')->orderBy('file_name', 'asc');
        }, 'programs'])
        ->first();

        $uniqueProposalFiles = $proposals->proposalfiles->unique('document_type');


        $formedia = Proposal::where('id', $id)
            ->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
            },

            'proposalfiles' => function ($query) {
                $query->with(['medias' => function ($query) {
                    $query->whereNot('collection_name', 'trash')->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
                    ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
                }]);
        },])->first();

        $uniqueformedias = $formedia->proposalfiles->unique('document_type');

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

        if($notification){
            auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        }

        return view('user.inventory.show', compact('proposals', 'proposal', 'proposal_member', 'inventory', 'program', 'members'
        ,'formedia','narrativeCount', 'terminalCount', 'memberCount','travelCount','specialCount','officeCount','attendanceCount'
        ,'attendancemCount','uniqueProposalFiles','uniqueformedias'));

    }

    public function UpdateShowInventory(Request $request, $id)
    {
        $proposals = Proposal::where('id', $id)->first();

        $request->validate([
            'program_id' => 'required',
            'project_title' => 'required',
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
        $proposal = ProposalFiles::findorFail($id);
        $pdf = $proposal->getFirstMedia('specialOrderPdf');
        return $pdf;
    }

    public function downloadsOffice($id)
    {
        $proposal = ProposalFiles::findorFail($id);
        $pdf = $proposal->getFirstMedia('officeOrderPdf');
        return $pdf;
    }

    public function downloadsTravel($id)
    {
        $proposal = ProposalFiles::findorFail($id);
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


        $narratives = ProposalFiles::where('proposal_id', $id)
        ->where('document_type', 'narrativereport')->get();

        if ($narratives->isNotEmpty()) {
            $downloads = collect();

            foreach ($narratives as $narrative) {
                $downloads = $downloads->merge($narrative->getMedia('NarrativeFile'));
            }

            return MediaStream::create($narratives->first()->proposals->project_title . '-NarrativeFiles.zip')
            ->addMedia($downloads);
        }

    }

    public function downloadTerminal($id){

        $terminals = ProposalFiles::where('proposal_id', $id)
        ->where('document_type', 'terminalreport')->get();

        if ($terminals->isNotEmpty()) {
            $downloads = collect();

            foreach ($terminals as $terminal) {
                $downloads = $downloads->merge($terminal->getMedia('TerminalFile'));
            }

            return MediaStream::create($terminals->first()->proposals->project_title . '-TerminalFiles.zip')
            ->addMedia($downloads);
        }


    }


    public function downloadTravelorder($id){

        $travelorders = ProposalFiles::where('proposal_id', $id)
        ->where('document_type', 'travelorder')->get();

        if ($travelorders->isNotEmpty()) {
            $downloads = collect();

            foreach ($travelorders as $travelorder) {
                $downloads = $downloads->merge($travelorder->getMedia('travelOrderPdf'));
            }

            return MediaStream::create($travelorders->first()->proposals->project_title . '-TravelOrderFiles.zip')
            ->addMedia($downloads);
        }


    }

    public function downloadSpecialorder($id){

        $specialorders = ProposalFiles::where('proposal_id', $id)
        ->where('document_type', 'specialorder')->get();

        if ($specialorders->isNotEmpty()) {
            $downloads = collect();

            foreach ($specialorders as $specialorder) {
                $downloads = $downloads->merge($specialorder->getMedia('specialOrderPdf'));
            }

            return MediaStream::create($specialorders->first()->proposals->project_title . '-SpecialOrderFiles.zip')
            ->addMedia($downloads);
        }


    }

    public function downloadOfficeorder($id){

        $officeorders = ProposalFiles::where('proposal_id', $id)
        ->where('document_type', 'officeorder')->get();

        if ($officeorders->isNotEmpty()) {
            $downloads = collect();

            foreach ($officeorders as $officeorder) {
                $downloads = $downloads->merge($officeorder->getMedia('officeOrderPdf'));
            }

            return MediaStream::create($officeorders->first()->proposals->project_title . '-OfficeOrderFiles.zip')
            ->addMedia($downloads);
        }


    }

    public function downloadAttendance($id){

        $attedance = ProposalFiles::where('proposal_id', $id)
        ->where('document_type', 'attendance')->get();

        if ($attedance->isNotEmpty()) {
            $downloads = collect();

            foreach ($attedance as $attend) {
                $downloads = $downloads->merge($attend->getMedia('Attendance'));
            }

            return MediaStream::create($attedance->first()->proposals->project_title . '-AttendanceFiles.zip')
            ->addMedia($downloads);
        }


    }

    public function downloadAttendancem($id){


        $attedances = ProposalFiles::where('proposal_id', $id)
        ->where('document_type', 'attendancem')->get();

        if ($attedances->isNotEmpty()) {
            $downloads = collect();

            foreach ($attedances as $attend) {
                $downloads = $downloads->merge($attend->getMedia('AttendanceMonitoring'));
            }

            return MediaStream::create($attedances->first()->proposals->project_title . '-AttendanceMonitoringFiles.zip')
            ->addMedia($downloads);
        }

    }


    // Download All
    public function download($id)
    {
        $proposals = Proposal::where('id', $id)->first();
        $proposalfiles = ProposalFiles::where('proposal_id', $id)->get();

        $download1 = Media::where('model_id',$proposals->id)->whereNot('collection_name', 'trash')->get();
        $download2 = $proposalfiles ? Media::where('model_type', ProposalFiles::class)
        ->whereIn('model_id', $proposalfiles->pluck('id'))
        ->where('collection_name', '<>', 'trash')
        ->get() : [];

        return MediaStream::create($proposals->project_title.'.zip')->addMedia($download1,$download2,);
    }




    // Delete
    public function RestoreFile($id)
    {
        $media = Media::findOrFail($id);
        // $proposal = Proposal::where('id',$media->model_id)->withTrashed()->first();

        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }

        if($media->name == 'proposal'){
            $media->collection_name = 'proposalPdf';
            $media->save();
        }elseif($media->name == 'moa'){
            $media->collection_name = 'MoaPdf';
            $media->save();
        }elseif($media->name == 'other'){
            $media->collection_name = 'otherFile';
            $media->save();
        }


        return back()->with('message', 'Resotored successfully');

    }
    public function MoveToTrash($id)
    {
        $media = Media::findOrFail($id);

        // Set the collection name to 'trash'
        $media->collection_name = 'trash';
        $media->save();
        return back()->with('message', 'Deleted successfully');

    }


    public function deleteMedias($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();


        return back()->with('message', 'Deleted successfully');

    }
    public function deleteMediasPermanently($id, $proposalId)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        $proposal = Proposal::withTrashed()->where('id', $proposalId)->first();

        // Check if the related NarrativeReport should be deleted
        if ($proposal->medias()->count() === 0) {

            $proposal->forceDelete();
            flash()->addSuccess('File and related data deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

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

            $media = $proposals->getMedia('trash')->where('name', 'proposal')->first();
            if ($media) {
                $media->delete();
            }
        $proposals->clearMediaCollection('proposalPdf');
        $proposals->addMediaFromRequest('proposal_pdf')->usingName('proposal')->usingFileName($project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');
        }

        if ($request->hasFile('moa_pdf')) {

            $media = $proposals->getMedia('trash')->where('name', 'moa')->first();
            if ($media) {
                $media->delete();
            }
            $proposals->clearMediaCollection('MoaPDF');
            $proposals->addMediaFromRequest('moa_pdf')->usingName('moa')->usingFileName($project_title.'_moa.pdf')->toMediaCollection('MoaPDF');
        }

        if ($specialorder = $request->file('special_order_pdf')) {

            $special = new ProposalFiles();
            $special->user_id  = auth()->id();
            $special->proposal_id  = $proposals->id;
            $special->document_type  = 'specialorder';
            $special->save();

            foreach ($specialorder as $specials) {
                $special->addMedia($specials)->usingName('special_order_pdf')->toMediaCollection('specialOrderPdf');
            }
        }

        if ($travelorder = $request->file('travel_order_pdf')) {

            $travel = new ProposalFiles();
            $travel->user_id  = auth()->id();
            $travel->proposal_id  = $proposals->id;
            $travel->document_type  = 'travelorder';
            $travel->save();

            foreach ($travelorder as $travels) {
                $travel->addMedia($travels)->usingName('travel_order_pdf')->toMediaCollection('travelOrderPdf');
            }
        }

        if ($officeorder = $request->file('office_order_pdf')) {

            $office = new ProposalFiles();
            $office->user_id  = auth()->id();
            $office->proposal_id  = $proposals->id;
            $office->document_type  = 'officeorder';
            $office->save();

            foreach ($officeorder as $offices) {
                $office->addMedia($offices)->usingName('office_order_pdf')->toMediaCollection('officeOrderPdf');
            }
        }

        if ($attendance = $request->file('attendance')) {

            $attend = new ProposalFiles();
            $attend->user_id  = auth()->id();
            $attend->proposal_id  = $proposals->id;
            $attend->document_type  = 'attendance';
            $attend->save();

            foreach ($attendance as $attends) {
                $attend->addMedia($attends)->usingName('attendance')->toMediaCollection('Attendance');
            }
        }
        if ($attendancem = $request->file('attendancem')) {

            $attendances = new ProposalFiles();
            $attendances->user_id  = auth()->id();
            $attendances->proposal_id  = $proposals->id;
            $attendances->document_type  = 'attendancem';
            $attendances->save();

            foreach ($attendancem as $attendm) {
                $attendances->addMedia($attendm)->usingName('attendancemonitoring')->toMediaCollection('AttendanceMonitoring');
            }
        }
        if ($narrativereport = $request->file('narrative_report')) {

            $narrative = new ProposalFiles();
            $narrative->user_id  = auth()->id();
            $narrative->proposal_id  = $proposals->id;
            $narrative->document_type  = 'narrativereport';
            $narrative->save();

            foreach ($narrativereport as $narr) {
                $narrative->addMedia($narr)->usingName('narrative')->toMediaCollection('NarrativeFile');
            }
        }
        if ($terminalreport = $request->file('terminal_report')) {

            $terminal = new ProposalFiles();
            $terminal->user_id  = auth()->id();
            $terminal->proposal_id  = $proposals->id;
            $terminal->document_type  = 'terminalreport';
            $terminal->save();

            foreach ($terminalreport as $term) {
                $terminal->addMedia($term)->usingName('terminal')->toMediaCollection('TerminalFile');
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

        // $proposal = Proposal::findorFail($id);
        $proposal = Proposal::with(['travelorder', 'specialorder', 'officeorder', 'attendance', 'attendancemonitoring', 'narrativereport', 'terminalreport'])
        ->with(['medias' => function ($mediaQuery) {
            $mediaQuery->whereNot('collection_name', 'trash');
        }])
        ->orderBy('created_at', 'DESC')
        ->distinct()
        ->first();


        // dd($proposal);
        // proposal delete

        // foreach($proposal->medias as $media){
        //     $media->collection_name = 'trash';
        //     $media->save();
        // }

        $NarrativeReports = NarrativeReport::where('proposal_id', $proposal->id)->first();
        if($NarrativeReports){
            $NarrativeReports->delete();
        }


        $TerminalReport = TerminalReport::where('proposal_id', $proposal->id)->first();
        if($TerminalReport){
            $TerminalReport->delete();
        }

        $UserTravelOrder = UserTravelOrder::where('proposal_id', $proposal->id)->first();
        if($UserTravelOrder){
            $UserTravelOrder->delete();
        }


        $UserOfficeOrder = UserOfficeOrder::where('proposal_id', $proposal->id)->first();
        if($UserOfficeOrder){
            $UserOfficeOrder->delete();
        }

        $UserSpecialOrder = UserSpecialOrder::where('proposal_id', $proposal->id)->first();
        if($UserSpecialOrder){
            $UserSpecialOrder->delete();
        }

        $UserAttendance = UserAttendance::where('proposal_id', $proposal->id)->first();
        if($UserAttendance){
            $UserAttendance->delete();
        }

        $UserAttendanceMonitoring = UserAttendanceMonitoring::where('proposal_id', $proposal->id)->first();
        if($UserAttendanceMonitoring){
            $UserAttendanceMonitoring->delete();
        }

        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

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

        $proposal->delete();

        app('flasher')->addSuccess('Proposal Delete successfully');

        return redirect(route('inventory.index'));
    }



}

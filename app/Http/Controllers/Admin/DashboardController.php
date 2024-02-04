<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Program;
use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use App\Models\AdminYear;
use App\Rules\UniqueTitle;
use Illuminate\Http\Request;
use App\Charts\ProposalChart;
use App\Models\ProposalFiles;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\UserAttendance;
use App\Models\NarrativeReport;
use App\Models\UserOfficeOrder;
use App\Models\UserTravelOrder;
use Illuminate\Validation\Rule;
use App\Models\UserSpecialOrder;
use App\Models\ParticipationName;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AdminProgramServices;
use App\Models\CustomizeAdminProposal;
use App\Models\UserAttendanceMonitoring;
use App\Notifications\ProposalNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserTagProposalNotification;

class DashboardController extends Controller
{
    public function create(){

        $programs = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $members = User::orderBy('name')
        ->doesntHave('roles', 'and', function ($query) {
            $query->where('id', 1);
        })
        ->get(['id', 'name'])
        ->mapWithKeys(function ($user) {
            return [$user->id => $user->name];
        })
        ->prepend('Select name', '');
        return view('admin.dashboard.upload-proposal', compact('programs', 'members' ));
    }

    public function store(Request $request)
    {
        $request->validate([

        'program_id' => 'required',
        'project_title' => ['regex:/^[^<>?:|\/"*]+$/','required','min:6' ,Rule::unique('proposals'), new UniqueTitle],
        'proposal_pdf' => "required_without_all:special_order_pdf,moa_pdf,office_order_pdf,travel_order_pdf,other_files,attendance,attendancem|file|mimes:pdf|max:10048",
        'moa_pdf' => "required_without_all:proposal_pdf,special_order_pdf,office_order_pdf,travel_order_pdf,other_files,attendance,attendancem|file|mimes:pdf|max:10048",
        'other_files' => "required_without_all:proposal_pdf,special_order_pdf,moa_pdf,office_order_pdf,travel_order_pdf,attendance,attendancem|max:10048",
        'office_order_pdf' => "max:10048",
        'travel_order_pdf' => "max:10048",
        'special_order_pdf' => "max:10048",
        'attendance' => "max:10048",
        'attendancem' => "max:10048",
        ],
        [
        'required_without_all' => 'Please upload at least one file among Proposal PDF, Special Order PDF, MOA PDF, Office Order PDF, Travel Order PDF.',
        'project_title.regex' => 'Invalid characters: \ / : * ? " < > |',
        ]);


        $post = new Proposal();
        $post->program_id =  $request->program_id;
        $post->project_title =  $request->project_title;
        $post->started_date =  $request->started_date;
        $post->finished_date =  $request->finished_date;
        $post->user_id  = auth()->id();
        $post->save();

        if ($request->hasFile('proposal_pdf')) {
            $post->addMediaFromRequest('proposal_pdf')->usingName('proposal')->usingFileName($request->project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');
        }


        if ($request->hasFile('moa_pdf')) {
            $post->clearMediaCollection('MoaPDF');
            $post->addMediaFromRequest('moa_pdf')->usingName('moa')->usingFileName($request->project_title.'_moa.pdf')->toMediaCollection('MoaPDF');
        }

        if ($specialorder = $request->file('special_order_pdf')) {

            $special = new ProposalFiles();
            $special->user_id  = auth()->id();
            $special->proposal_id  = $post->id;
            $special->document_type  = 'specialorder';
            $special->save();

            foreach ($specialorder as $specials) {
                $special->addMedia($specials)->usingName('special_order_pdf')->toMediaCollection('specialOrderPdf');
            }
        }

        if ($travelorder = $request->file('travel_order_pdf')) {

            $travel = new ProposalFiles();
            $travel->user_id  = auth()->id();
            $travel->proposal_id  = $post->id;
            $travel->document_type  = 'travelorder';
            $travel->save();

            foreach ($travelorder as $travels) {
                $travel->addMedia($travels)->usingName('travel_order_pdf')->toMediaCollection('travelOrderPdf');
            }
        }

        if ($officeorder = $request->file('office_order_pdf')) {

            $office = new ProposalFiles();
            $office->user_id  = auth()->id();
            $office->proposal_id  = $post->id;
            $office->document_type  = 'officeorder';
            $office->save();

            foreach ($officeorder as $offices) {
                $office->addMedia($offices)->usingName('office_order_pdf')->toMediaCollection('officeOrderPdf');
            }
        }

        if ($attendance = $request->file('attendance')) {

            $attend = new ProposalFiles();
            $attend->user_id  = auth()->id();
            $attend->proposal_id  = $post->id;
            $attend->document_type  = 'attendance';
            $attend->save();

            foreach ($attendance as $attends) {
                $attend->addMedia($attends)->usingName('attendance')->toMediaCollection('Attendance');
            }
        }
        if ($attendancem = $request->file('attendancem')) {

            $attendances = new ProposalFiles();
            $attendances->user_id  = auth()->id();
            $attendances->proposal_id  = $post->id;
            $attendances->document_type  = 'attendancem';
            $attendances->save();

            foreach ($attendancem as $attendm) {
                $attendances->addMedia($attendm)->usingName('attendancemonitoring')->toMediaCollection('AttendanceMonitoring');
            }
        }


        if ($files = $request->file('other_files')) {

            foreach ($files as $file) {
                $post->addMedia($file)->usingName('other')->toMediaCollection('otherFile');
            }
        }



        AdminProgramServices::create([
            'proposal_id' => $post->id,
            'title' => $post->project_title,
            'status' => $post->programs->program_name,
        ]);

        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        Notification::send($admin, new ProposalNotification($post));



        if($request->member !== null){

            foreach ($request->member as $item) {

                $model = new ProposalMember();
                $model->proposal_id = $post->id;
                $model->user_id = $item['id'];
                $model->save();


                $users = User::where('id', $item['id'])->get();
                Notification::send($users, new UserTagProposalNotification($model));

                $duplicateCount = DB::table('notifications')
                ->whereJsonContains('data->tag_id', $item['id'])
                ->whereJsonContains('data->proposal_id', $post->id)
                ->count();

                if ($duplicateCount > 1) {
                    // Use the offset method to skip the first occurrence
                    $firstDuplicate = DB::table('notifications')
                    ->whereJsonContains('data->tag_id', $item['id'])
                    ->whereJsonContains('data->proposal_id', $post->id)
                    ->offset(1)
                    ->first();

                    // Delete the second occurrence of duplicated data
                    DB::table('notifications')->where('id', $firstDuplicate->id)->delete();
                }

            }

            ProposalMember::whereNull('user_id')->where('proposal_id', $post->id)->delete();

        }

        flash()->addSuccess('Project Uploaded Successfully.');


        return redirect(route('admin.dashboard.index'));
    }


       //  Edit Proposal
    public function checkProposal(Request $request, $id, $notification )
    {
        $proposal = Proposal::where('id', $id)->first();


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


        $latest = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
            $query->latest()->first();
        }])->first();

        $program = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $members = User::orderBy('name')
        ->doesntHave('roles', 'and', function ($query) {
            $query->where('id', 1);
        })
        ->get(['id', 'name'])
        ->mapWithKeys(function ($user) {
            return [$user->id => $user->name];
        });


        if($notification){
            auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        }
        return view('admin.dashboard.proposal.edit-proposal', compact('proposal','proposals', 'program', 'members', 'formedia', 'latest',
        'uniqueProposalFiles', 'uniqueformedias'));
    }

    public function AdminUpdateFiles(Request $request, $id)
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

            $special = new ProposalFiles();
            $special->user_id  = auth()->id();
            $special->proposal_id  = $proposals->id;
            $special->document_type  = 'specialorder';
            $special->save();

            foreach ($specialorder as $specials) {
                $special->addMedia($specials)->usingName('special_order')->toMediaCollection('specialOrderPdf');
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


        if ($files = $request->file('other_files')) {

            foreach ($files as $file) {
                $proposals->addMedia($file)->usingName('other')->toMediaCollection('otherFile');
            }
        }


        app('flasher')->addSuccess('Files successfully updated.');
        return back();

    }


    public function updateDetails(Request $request, $id)
    {
        $proposals = Proposal::where('id', $id)->first();

        $request->validate([
            'program_id' => 'required',
            'project_title' => 'required',
        ]);

        Proposal::where('id', $proposals->id)->update([

            'program_id' => $request->program_id,
            'project_title' => $request->project_title,
            'started_date' =>  $request->started_date,
            'finished_date' =>  $request->finished_date,
        ]);

        if($request->member !== null){
            ProposalMember::where('proposal_id', $proposals->id)->delete();
            foreach ($request->member as $item) {

                $model = new ProposalMember();
                $model->proposal_id = $proposals->id;
                $model->user_id = $item['id'];
                $model->save();
            }

        }else{
            ProposalMember::where('proposal_id', $proposals->id)->delete();
        }

        flash()->addSuccess('Details Updated Successfully');
        return redirect("/admin/dashboard/user-proposal/{$proposals->id}/{$proposals->id}");
    }

    public function DeleteProposal(Request $request){

        $ids = $request->ids;
        $proposalDelete = Proposal::where('id', $ids)->first();
        $proposalDelete->delete();
        return response()->json(["success", "Proposal has been deleted"]);
    }


    public function chart(Request $request){

        $customizes = CustomizeAdminProposal::where('id', 1)->get();
        $statusCount = Proposal::select('authorize')->whereYear('created_at', date('Y'))->count();
        $pendingCount = Proposal::where('authorize','pending')->whereYear('created_at', date('Y'))->count();
        $ongoingCount = Proposal::where('authorize' ,'ongoing')->whereYear('created_at', date('Y'))->count();
        $finishedCount = Proposal::where('authorize' ,'finished')->whereYear('created_at', date('Y'))->count();

        $allProposal = Proposal::orderBy('created_at', 'desc')->with('programs')->with('proposal_members')->whereYear('created_at', date('Y'))->get();

        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

        $users = Proposal::select(DB::raw("COUNT(*) as count"),  DB::raw("MONTHNAME(created_at) as month_name"))
        ->groupBy(DB::raw("month_name"))
        ->orderBy('month_name','ASC')
        ->pluck('count','month_name');

        $labels = $users->keys();
        $data = $users->values();


        $proposals = Proposal::leftJoin('programs', 'proposals.program_id', '=', 'programs.id')
        ->select(DB::raw("COUNT(*) as count"), 'programs.program_name as name')
        ->groupBy(DB::raw("name"))
        ->pluck('count','name');

        $programLabel = $proposals->keys();
        $programData = $proposals->values();

        $proposals->keys();
        $proposals->values();


        return view('admin.dashboard.chart.index',compact( 'programLabel', 'programData', 'statusCount', 'pendingCount', 'ongoingCount', 'finishedCount',
            'labels','data','customizes', 'allProposal', 'years'));
    }


    public function updateData(Request $request, $id){
        // Find the model instance you want to update
        $model = CustomizeAdminProposal::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Update the model attributes based on the dropdown value
        $model->number = $request->input('selected_value');
        $model->save();

        return response()->json(['message' => 'Data updated successfully']);
    }


    public function FilterStatus(Request $request)
    {
        $query = $request->input('query');

            $customizes = CustomizeAdminProposal::where('id', 1)->get();

            $statusCount = Proposal::select('authorize')
            ->where(function ($query) {
                if($year = request('year')){
                $query->whereYear('created_at', $year);
            }})->count();

            $pendingCount = Proposal::where('authorize','pending')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $ongoingCount = Proposal::where('authorize' ,'ongoing')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $finishedCount = Proposal::where('authorize' ,'finished')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

            $users = Proposal::select(DB::raw("COUNT(*) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('month_name','ASC')
            ->pluck('count','month_name');

            $labels = $users->keys();
        $data = $users->values();


        $proposals = Proposal::leftJoin('programs', 'proposals.program_id', '=', 'programs.id')
            ->select(DB::raw("COUNT(*) as count"), 'programs.program_name as name')
            ->groupBy(DB::raw("name"))
            ->pluck('count','name');

            $programLabel = $proposals->keys();
            $programData = $proposals->values();

            $proposals->keys();
        $proposals->values();


        $allProposal = Proposal::orderBy('authorize', 'desc')->with('programs')->with('proposal_members')

        ->when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%")
            ->orWhere('authorize', 'like', "%$query%")
            ->orWhere('created_at', 'like', "%$query%");
        })
        ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
        }})
        ->where(function ($query) {
                if($companyId = request('status')){
                    $query->where('authorize', $companyId);
        }})->get();



        return view('admin.dashboard.chart.filter_index._index-dashboard',compact( 'programLabel', 'programData', 'statusCount', 'pendingCount', 'ongoingCount', 'finishedCount',
            'labels','data','customizes', 'allProposal', 'years'));
    }

    public function SearchData(Request $request)
    {
        $query = $request->input('query');

            $customizes = CustomizeAdminProposal::where('id', 1)->get();

            $statusCount = Proposal::select('authorize')
            ->where(function ($query) {
                if($year = request('year')){
                $query->whereYear('created_at', $year);
            }})->count();

            $pendingCount = Proposal::where('authorize','pending')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $ongoingCount = Proposal::where('authorize' ,'ongoing')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $finishedCount = Proposal::where('authorize' ,'finished')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

            $users = Proposal::select(DB::raw("COUNT(*) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('month_name','ASC')
            ->pluck('count','month_name');

            $labels = $users->keys();
        $data = $users->values();


        $proposals = Proposal::leftJoin('programs', 'proposals.program_id', '=', 'programs.id')
            ->select(DB::raw("COUNT(*) as count"), 'programs.program_name as name')
            ->groupBy(DB::raw("name"))
            ->pluck('count','name');

            $programLabel = $proposals->keys();
            $programData = $proposals->values();

            $proposals->keys();
        $proposals->values();


        $allProposal = Proposal::orderBy('authorize', 'desc')->with('programs')->with('proposal_members')
        ->where(function ($query) {
            if($companyId = request('status')){
                $query->where('authorize', $companyId);
        }})->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
        }})
        ->when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%")
            ->orWhere('authorize', 'like', "%$query%")
            ->orWhere('created_at', 'like', "%$query%");
        })->get();



        return view('admin.dashboard.chart.filter_index._index-dashboard',compact( 'programLabel', 'programData', 'statusCount', 'pendingCount', 'ongoingCount', 'finishedCount',
            'labels','data','customizes', 'allProposal', 'years'));
    }


    public function FilterYears(Request $request)
    {
        $query = $request->input('query');

            $customizes = CustomizeAdminProposal::where('id', 1)->get();

            $statusCount = Proposal::select('authorize')
            ->where(function ($query) {
                if($year = request('year')){
                $query->whereYear('created_at', $year);
            }})->count();

            $pendingCount = Proposal::where('authorize','pending')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $ongoingCount = Proposal::where('authorize' ,'ongoing')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $finishedCount = Proposal::where('authorize' ,'finished')
            ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
            }})->count();

            $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

            $users = Proposal::select(DB::raw("COUNT(*) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('month_name','ASC')
            ->pluck('count','month_name');

            $labels = $users->keys();
        $data = $users->values();


        $proposals = Proposal::leftJoin('programs', 'proposals.program_id', '=', 'programs.id')
            ->select(DB::raw("COUNT(*) as count"), 'programs.program_name as name')
            ->groupBy(DB::raw("name"))
            ->pluck('count','name');

            $programLabel = $proposals->keys();
            $programData = $proposals->values();

            $proposals->keys();
        $proposals->values();


        $allProposal = Proposal::orderBy('authorize', 'desc')->with('programs')->with('proposal_members')
        ->where(function ($query) {
            if($companyId = request('status')){
                $query->where('authorize', $companyId);
        }})
        ->when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%")
            ->orWhere('authorize', 'like', "%$query%")
            ->orWhere('created_at', 'like', "%$query%");
        })
        ->where(function ($query) {
            if($year = request('year')){
            $query->whereYear('created_at', $year);
        }})
        ->get();

        return view('admin.dashboard.chart.filter_index._index-dashboard',compact( 'programLabel', 'programData', 'statusCount', 'pendingCount', 'ongoingCount', 'finishedCount',
            'labels','data','customizes', 'allProposal', 'years'));
    }


    public function NarrativeIndex(){

        $narrativeReports = NarrativeReport::select('user_id')->with('users')->with('proposals')->groupBy('user_id')->get();
        return view('admin.dashboard.narrative-report.index', compact('narrativeReports'));
    }

    public function NarrativeShow($id, $notification){

        $narrativeReports = NarrativeReport::where('user_id', $id)->with('users')->with('proposals')->get();

        if($notification){
            auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        }
        return view('admin.dashboard.narrative-report.show', compact('narrativeReports'));
    }

    public function TerminalIndex(){

        $terminalReports = TerminalReport::all();

        return view('admin.dashboard.terminal-report.index', compact('terminalReports'));
    }

    public function TerminalShow($id, $notification){

        $terminalReports = TerminalReport::where('user_id', $id)->with('users')->with('proposals')->get();
        if($notification){
            auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        }
        return view('admin.dashboard.terminal-report.show', compact('terminalReports'));
    }

    public function deleteAllNarrative($id){
        NarrativeReport::where('proposal_id', $id)->delete();

        flash()->addSuccess('Narratives Delete Successfully');
        return back();
    }

    public function deleteAllTerminal($id){
        TerminalReport::where('proposal_id', $id)->delete();

        flash()->addSuccess('Terminals Delete Successfully');
        return back();
    }




}

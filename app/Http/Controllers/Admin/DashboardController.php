<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Program;
use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Charts\ProposalChart;
use App\Models\ProposalMember;
use Illuminate\Validation\Rule;
use App\Models\ParticipationName;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CustomizeAdminProposal;

class DashboardController extends Controller
{
    public function create(){

        $programs = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $members = User::orderBy('name')->whereNot('name', 'Administrator')->pluck('name', 'id')->prepend('Select Username', '');
        $ceso_roles = CesoRole::orderBy('role_name')->pluck('role_name', 'id')->prepend('Select Role', '');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $parts_names = ParticipationName::orderBy('participation_name')->pluck('participation_name', 'id');

        return view('admin.dashboard.upload-proposal', compact('programs', 'members','ceso_roles', 'locations','parts_names'  ));
    }

    public function store(Request $request)
    {
       $request->validate([

            'program_id' => 'required',
            'location_id' => Rule::requiredIf(function () {
                return in_array(request()->ceso_role_id,
                ['Facilitator/Moderator','Reactor/Panel member','Technical Assistance/Consultancy','Resource Speaker/Trainer', 'nullable']);
            }),
            'project_title' => ['regex:/^[^<>?:|\/"*]+$/','required','min:6' ,Rule::unique('proposals')],
            'started_date' => 'required',
            'finished_date' => 'required',
            'proposal_pdf' => "required|mimes:pdf|max:10048",
            'special_order_pdf' => "required|mimes:pdf|max:10048",

           ],  [
            'project_title.regex' => 'Invalid characters: \ / : * ? " < > |',
        ]);


        $post = new Proposal();
        $post->program_id =  $request->program_id;
        $post->project_title =  $request->project_title;
        $post->started_date =  $request->started_date;
        $post->finished_date =  $request->finished_date;
        $post->user_id  = auth()->id();


        if ($request->hasFile('proposal_pdf')) {
            $post->addMediaFromRequest('proposal_pdf')->usingName('proposal')->usingFileName($request->project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');
        }

        if ($request->hasFile('special_order_pdf')) {
            $post->addMediaFromRequest('special_order_pdf')->usingName('special_order')->usingFileName($request->project_title.'_special_order.pdf')->toMediaCollection('specialOrderPdf');
        }

        $post->save();



        if($request->leader_id){

            $leadersave = [
                'proposal_id' => $post->id,
                'user_id'=> $request->input('leader_id'),
                'leader_member_type' => $request->input('leader_member_type'),
                'location_id' => $request->input('location_id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            DB::table('proposal_members')->insert($leadersave);
        };


        if($request->member !== null){

            foreach ($request->member as $item) {

            $model = new ProposalMember();
            $model->proposal_id = $post->id;
            $model->user_id = $item['id'];
            $model->member_type = $item['type'];
            $model->save();
            }

            ProposalMember::whereNull('user_id')->where('proposal_id', $post->id)->delete();

        }

        flash()->addSuccess('Proposal Uploaded Successfully.');

        return redirect(route('admin.dashboard.index'));
    }




       //  Edit Proposal
    public function checkProposal(Request $request, $id, $notification )
    {


        $proposal = Proposal::where('id', $id)->first();
        $proposals = Proposal::where('id', $id)->first();
        $program = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $members = User::orderBy('name')->whereNot('name', 'Administrator')->pluck('name', 'id')->prepend('Select Username', '');
        $ceso_roles = CesoRole::orderBy('role_name')->pluck('role_name', 'id')->prepend('Select Role', '');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $parts_names = ParticipationName::orderBy('participation_name')->pluck('participation_name', 'id');

        if($notification){
            auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        }
        return view('admin.dashboard.proposal.edit-proposal', compact('proposal','proposals', 'program', 'members', 'ceso_roles', 'locations', 'parts_names'));
    }


    public function updateDetails(Request $request, $id)
    {
        $proposals = Proposal::where('id', $id)->first();

        $request->validate([
            'program_id' => 'required',
            'project_title' => 'required',
            'started_date' => 'required',
            'finished_date' => 'required',
        ]);

        Proposal::where('id', $proposals->id)->update([

            'program_id' => $request->program_id,
            'project_title' => $request->project_title,
            'started_date' =>  $request->started_date,
            'finished_date' =>  $request->finished_date,
        ]);

        if($request->leader_id !== null){

            ProposalMember::whereNotNull('leader_member_type')->where('proposal_id', $proposals->id)->delete();
            ProposalMember::whereNotNull('leader_member_type')->where('proposal_id', $proposals->id)->create([
                    'proposal_id' => $proposals->id,
                    'user_id'=> $request->leader_id,
                    'leader_member_type' => $request->leader_member_type,
                    'location_id' => $request->location_id,
                ]);
            }else{
                ProposalMember::whereNotNull('leader_member_type')->where('proposal_id', $proposals->id)->delete();
            }

            if($request->member !== null){


            ProposalMember::whereNotNull('member_type')->where('proposal_id', $proposals->id)->delete();


            foreach ($request->member as $item) {

                $model = new ProposalMember();
                $model->proposal_id = $proposals->id;
                $model->user_id = $item['id'];
                $model->member_type = $item['type'];
                $model->save();
            }

         }else {
            ProposalMember::whereNotNull('member_type')->where('proposal_id', $proposals->id)->delete();
         }



        return back()->with('message', 'Status updated successfully');
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

        $users = Proposal::select(DB::raw("COUNT(*) as count"),
        DB::raw("MONTHNAME(created_at) as month_name"))
        ->groupBy(DB::raw("month_name"))
        ->orderBy('created_at','ASC')
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
            ->orderBy('created_at','ASC')
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
            ->orderBy('created_at','ASC')
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
            ->orderBy('created_at','ASC')
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

}

<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Charts\ProposalChart;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\NarrativeReport;
use App\Models\ProposalRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\ProposalNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

    class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projectProposal = Proposal::where('authorize', 'pending')->count();
        $ongoingProposal = Proposal::where('authorize', 'ongoing')->count();
        $finishedProposal = Proposal::where('authorize', 'finished')->count();
        $allProposal = Proposal::orderBy('created_at', 'desc')->with('programs')->with('proposal_members')->get();
        $pendingAccount = User::where('authorize', 'pending')->count();
        $totalAccount = DB::table('users')->select('id')->count();
        $totalProposal = DB::table('proposals')->select('id')->count();
        $getCountProposals = DB::table('proposals')->whereDate('created_at', Carbon::today())->count();
        $getCountUsers = DB::table('users')->whereDate('created_at', Carbon::today())->count();
        $programs = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $evaluation = Evaluation::whereYear('created_at', date('Y'))->count();
        $narrativeCount = NarrativeReport::distinct('user_id')->count();
        $terminalCount = TerminalReport::distinct('user_id')->count();
        $latestfour = Proposal::latest()->take(4)->get();
        $latestfourfile = Media::latest()->take(4)->get();
        $latestfouruser = User::latest()->take(4)->get();
        $latestfourevaluation = Evaluation::latest()->take(4)->get();
        $latestfourpoints = Evaluation::latest()->take(4)->orderBy('total_points', 'desc')->get();

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        // dd($notifications);


        return view('admin.dashboard.index', compact('projectProposal', 'allProposal', 'getCountProposals', 'getCountUsers',
             'pendingAccount', 'totalAccount', 'ongoingProposal', 'currentYear' , 'previousYear',
             'finishedProposal', 'totalProposal', 'programs', 'evaluation', 'narrativeCount', 'terminalCount','latestfour','latestfourfile'
            ,'latestfouruser','latestfourevaluation','latestfourpoints' ));
    }

    public function store(Request $request)
    {
        $request->validate([

            'program_id' => 'required',
            'project_title' => 'required|string|min:6',
            'started_date' => 'required',
            'finished_date' => 'required',
            'project_leader' => 'required',
            'authorize' => 'required',
           ]);

        $post = new Proposal();
        $post->program_id =  $request->program_id;
        $post->project_title =  $request->project_title;
        $post->started_date =  $request->started_date;
        $post->finished_date =  $request->finished_date;
        $post->project_leader = $request->project_leader;
        $post->authorize = $request->authorize;
        $post->user_id  = auth()->id();

        if ($request->hasFile('proposal_pdf')){
            $post->addMediaFromRequest('proposal_pdf')->usingName('proposal')->usingFileName($request->project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');
        }

        if ($request->hasFile('moa')) {

            $post->addMediaFromRequest('moa')->usingName('moa')->usingFileName($request->project_title.'_moa.pdf')->toMediaCollection('MoaPDF');
        }

        if ($request->hasFile('office_order')) {

            $post->addMediaFromRequest('office_order')->usingName('office')->usingFileName($request->project_title.'_office_order.pdf')->toMediaCollection('officeOrder');
        }

        if ($request->hasFile('travel_order')) {

            $post->addMediaFromRequest('travel_order')->usingName('travel')->usingFileName($request->project_title.'_travel_order.pdf')->toMediaCollection('travelOrder');
        }

        if ($images = $request->file('other_files')) {
           foreach ($images as $image) {
               $post->addMedia($image)->usingName('other')->toMediaCollection('otherFile');
            }
        }

        $post->save();


        $partners = User::whereHas('roles', function ($query) {
            $query->where('id', 5);
        })->get();

        foreach ($partners as $partner) {
            $partner->notify(new ProposalNotification($post));
        }
        // User::find(Auth::user()->id)->notify(new DepositSuccessful($deposit->amount));

        //  Notification::send($partners, new ProposalNotification($post));



        return redirect(route('admin.dashboard.index'))->with('message', 'Proposal created successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;
        $projectProposal = Proposal::where('authorize', 'pending')->count();
        $ongoingProposal = Proposal::where('authorize', 'ongoing')->count();
        $finishedProposal = Proposal::where('authorize', 'finished')->count();

        $pendingAccount = User::where('authorize', 'pending')->count();
        $totalAccount = DB::table('users')->select('id')->count();
        $totalProposal = DB::table('proposals')->select('id')->count();
        $programs = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');

        $allProposal = Proposal::orderBy('authorize', 'desc')->with('programs')->with('proposal_members')->where(function ($query) {
            if($companyId = request('selected_value')){
                $query->where('authorize', $companyId);
            }})->when($query, function ($querys) use ($query) {
                return $querys->where('project_title', 'like', "%$query%");
            })->get();



        return view('admin.dashboard._proposal-dashboard', compact('projectProposal', 'allProposal',
        'pendingAccount', 'totalAccount', 'ongoingProposal', 'currentYear' , 'previousYear',
        'finishedProposal', 'totalProposal', 'programs' ));
    }

    public function filter(Request $request)
    {
        $query = $request->input('query');

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;
        $projectProposal = Proposal::where('authorize', 'pending')->count();
        $ongoingProposal = Proposal::where('authorize', 'ongoing')->count();
        $finishedProposal = Proposal::where('authorize', 'finished')->count();

        $pendingAccount = User::where('authorize', 'pending')->count();
        $totalAccount = DB::table('users')->select('id')->count();
        $totalProposal = DB::table('proposals')->select('id')->count();
        $programs = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');



        $allProposal = Proposal::orderBy('authorize', 'desc')->with('programs')->with('proposal_members')->when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%");
        })->where(function ($query) {
            if($companyId = request('selected_value')){
                $query->where('authorize', $companyId);
            }})->get();



        return view('admin.dashboard._proposal-dashboard', compact('projectProposal', 'allProposal',
        'pendingAccount', 'totalAccount', 'ongoingProposal', 'currentYear' , 'previousYear',
        'finishedProposal', 'totalProposal', 'programs' ));
    }
}

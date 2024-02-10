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
        $latestfour = Proposal::latest()->take(4)->get();
        $latestfourfile = Media::latest()->take(4)->get();
        $latestfouruser = User::latest()->take(4)->get();
        $latestfourevaluation = Evaluation::latest()->take(4)->get();
        $latestfourpoints = Evaluation::latest()->take(4)->orderBy('total_points', 'desc')->get();

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        return view('admin.dashboard.index', compact('projectProposal', 'allProposal', 'getCountProposals', 'getCountUsers',
        'pendingAccount', 'totalAccount', 'ongoingProposal', 'currentYear' , 'previousYear',
        'finishedProposal', 'totalProposal', 'programs', 'evaluation','latestfour','latestfourfile',
        'latestfouruser','latestfourevaluation','latestfourpoints' ));
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

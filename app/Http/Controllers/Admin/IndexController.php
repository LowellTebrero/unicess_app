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

        // $proposals = Proposal::all();


        // foreach ($proposals as $proposal) {

        //     $terminalMediaExists = $proposal->medias()
        //     ->where('created_at', '>', $proposal->created_at)
        //     ->where('created_at', '<=', $proposal->status_check_at)
        //     ->exists();

        //     $proposal->status = $terminalMediaExists ? 'active' : 'inactive';
        //     $proposal->save();
        // }





        $activeProject = Proposal::where('status', 'active')->count();
        $projectProposal = Proposal::where('authorize', 'pending')->count();
        $ongoingProposal = Proposal::where('authorize', 'ongoing')->count();
        $finishedProposal = Proposal::where('authorize', 'finished')->count();
        $allProposal = Proposal::orderBy('created_at', 'desc')->with('programs')->with('proposal_members')->paginate(7);
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



        $proposalsWithCounts = Proposal::
        whereYear('created_at', date('Y'))
        ->select('authorize', \DB::raw('count(*) as count'))
        ->groupBy('authorize')
        ->get();

        $statusCounts = $proposalsWithCounts->pluck('count', 'authorize');
        $CountStatuslabels = $statusCounts->keys();
        $CountStatusdata = $statusCounts->values();

        return view('admin.dashboard.index', compact('projectProposal', 'allProposal', 'getCountProposals', 'getCountUsers',
        'pendingAccount', 'totalAccount', 'ongoingProposal', 'currentYear' , 'previousYear',
        'finishedProposal', 'totalProposal', 'programs', 'evaluation','latestfour','latestfourfile',
        'latestfouruser','latestfourevaluation','latestfourpoints','activeProject','labels','data','programLabel','programData',
        'CountStatuslabels','CountStatusdata' ));
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
            })->paginate(7);



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
            }})->paginate(7);



        return view('admin.dashboard._proposal-dashboard', compact('projectProposal', 'allProposal',
        'pendingAccount', 'totalAccount', 'ongoingProposal', 'currentYear' , 'previousYear',
        'finishedProposal', 'totalProposal', 'programs' ));
    }
}

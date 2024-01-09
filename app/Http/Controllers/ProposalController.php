<?php

namespace App\Http\Controllers;

use toastr;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Point;
use App\Models\Program;
use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use App\Models\AdminYear;
use App\Models\Evaluation;
use App\Models\Template;
use App\Rules\UniqueTitle;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use Illuminate\Validation\Rule;
use App\Models\ParticipationName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\AdminProgramServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\TemporaryEvaluationFile;
use App\Notifications\ProposalNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserTagProposalNotification;
use App\Notifications\UserTagRemoveProposalNotification;




class ProposalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();
        $currentYear = date('Y');
        $Temporary = TemporaryEvaluationFile::all();
        $templates = Template::with('medias')->get();
        $proposals = Proposal::with(['proposal_members' => function ($query) {
        $query->select('proposal_id')->where('user_id', auth()->user()->id)->distinct();
        }])->orderBy('created_at', 'DESC')->whereYear('created_at', date('Y'))->get();

        $counts = Proposal::where('user_id', auth()->user()->id)->where('authorize', 'finished')->whereYear('created_at', $currentYear)->count();
        $second = ProposalMember::where('user_id', auth()->user()->id)->whereYear('created_at', date('Y'))->count();
        $proposalMembers = ProposalMember::with('proposal')->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(6);
        $latestYearPoints = Evaluation::select(DB::raw('MAX(YEAR(created_at)) as max_year'), 'total_points')
        ->groupBy('total_points')
        ->latest('max_year')
        ->where('user_id', auth()->user()->id)
        ->whereYear('created_at', $currentYear)
        ->first();

        return view('user.dashboard.index',compact(
        'proposalMembers','latestYearPoints','proposals', 'user', 'counts',
               'currentYear',  'second', 'Temporary', 'templates'));
    }

    public function getCurrentTime()
    {
        return response()->json(['time' => Carbon::now()->format('h:i A')]);
    }

    public function create()
    {
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

        $ceso_roles = CesoRole::orderBy('role_name')->pluck('role_name', 'id');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $parts_names = ParticipationName::orderBy('participation_name')->pluck('participation_name', 'id');

        return view('user.dashboard.create', compact('programs', 'members','ceso_roles', 'locations','parts_names'  ));
    }

    public function store(Request $request)
    {

       $request->validate([

            'program_id' => 'required',
            'location_id' => Rule::requiredIf(function () {
                return in_array(request()->ceso_role_id,
                ['Facilitator/Moderator','Reactor/Panel member','Technical Assistance/Consultancy','Resource Speaker/Trainer', 'nullable']);
            }),
            'project_title' => ['regex:/^[^<>?:|\/"*]+$/','required','min:6' ,Rule::unique('proposals'), new UniqueTitle],
            'proposal_pdf' => "required_without_all:special_order_pdf,moa_pdf,office_order_pdf,travel_order_pdf,other_files|file|mimes:pdf|max:10048",
            'special_order_pdf' => "required_without_all:proposal_pdf,moa_pdf,office_order_pdf,travel_order_pdf,other_files|file|mimes:pdf|max:10048",
            'moa_pdf' => "required_without_all:proposal_pdf,special_order_pdf,office_order_pdf,travel_order_pdf,other_files|file|mimes:pdf|max:10048",
            'office_order_pdf' => "required_without_all:proposal_pdf,special_order_pdf,moa_pdf,travel_order_pdf,other_files|file|mimes:pdf|max:10048",
            'travel_order_pdf' => "required_without_all:proposal_pdf,special_order_pdf,moa_pdf,office_order_pdf,other_files|file|mimes:pdf|max:10048",
            'other_files' => "required_without_all:proposal_pdf,special_order_pdf,moa_pdf,office_order_pdf,travel_order_pdf|max:10048",

           ],
           [
            'required_without_all' => 'Please upload at least one file among Proposal PDF, Special Order PDF, MOA PDF, Office Order PDF, Travel Order PDF, Other Files.',
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

        if ($request->hasFile('moa_pdf')) {
            $post->clearMediaCollection('MoaPDF');
            $post->addMediaFromRequest('moa_pdf')->usingName('moa')->usingFileName($request->project_title.'_moa.pdf')->toMediaCollection('MoaPDF');
        }

        if ($request->hasFile('travel_order')) {
            $post->clearMediaCollection('officeOrder');
            $post->addMediaFromRequest('travel_order')->usingName('travel')->usingFileName($request->project_title.'_travel_order.pdf')->toMediaCollection('officeOrder');
        }
        if ($request->hasFile('office_order')) {
            $post->clearMediaCollection('travelOrder');
            $post->addMediaFromRequest('office_order')->usingName('office')->usingFileName($request->project_title.'_office_order.pdf')->toMediaCollection('travelOrder');
        }

        if ($files = $request->file('other_files')) {

            foreach ($files as $file) {
                $post->addMedia($file)->usingName('other')->toMediaCollection('otherFile');
            }
        }

        $post->save();


        AdminProgramServices::create([
            'proposal_id' => $post->id,
            'title' => $post->project_title,
            'status' => $post->programs->program_name,
        ]);

        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        Notification::send($admin, new ProposalNotification($post));


        if($request->leader_id){

            $model = new ProposalMember();
            $model->proposal_id = $post->id;
            $model->user_id = $request->input('leader_id');
            $model->leader_member_type = $request->input('leader_member_type');
            $model->location_id = $request->input('location_id');
            $model->save();

            $users = User::where('id', $request->leader_id)->get();
            Notification::send($users, new UserTagProposalNotification($model));
        };


        if($request->member !== null){

            foreach ($request->member as $item) {

            $model = new ProposalMember();
            $model->proposal_id = $post->id;
            $model->user_id = $item['id'];
            $model->member_type = $item['type'];
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



        return redirect(route('User-dashboard.index'));
    }


    public function showProposal($id)
    {
        $users = User::all();
        $proposals = Proposal::where('id', $id)->with('medias')->with('proposal_members')->with('programs')->first();
        $proposal_member = ProposalMember::with('user')->where('user_id', auth()->user()->id)->first();
        $proposal = Proposal::with('programs')->with('proposal_members')->with('user')->where('id', $id)->first();
        $program = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $parts_names = ParticipationName::orderBy('participation_name')->pluck('participation_name', 'id');
        $members = User::orderBy('name')
        ->doesntHave('roles', 'and', function ($query) {
            $query->where('id', 1);
        })
        ->get(['id', 'name'])
        ->mapWithKeys(function ($user) {
            return [$user->id => $user->name];
        })
        ->prepend('Select name', '');
        $ceso_roles = CesoRole::orderBy('role_name')->pluck('role_name', 'id')->prepend('Select Role', '');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');


        return view('user.dashboard.show-user-proposal', compact('proposals', 'proposal', 'proposal_member', 'program'
        ,'parts_names','members', 'ceso_roles', 'locations', 'users' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposal = Proposal::with('programs')->where('id', $id)->first();
        return view('dashboard.edit', compact('proposal'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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

                $model = new ProposalMember();
                $model->proposal_id = $proposals->id;
                $model->user_id = $request->input('leader_id');
                $model->leader_member_type = $request->input('leader_member_type');
                $model->location_id = $request->input('location_id');
                $model->save();

                $ifExists =  DB::table('notifications')->where('notifiable_id',$request->input('leader_id'))->whereJsonContains('data->proposal_id', $proposals->id)->exists();

                if(!$ifExists){

                    $users = User::where('id', $model->user_id)->get();
                    Notification::send($users, new UserTagProposalNotification($model));
                    DB::table('notifications')->where('notifiable_id', $model->user_id)->whereJsonContains('data->remove_proposal_id', $proposals->id)->delete();

                }


            }else{
              $leaderId = ProposalMember::whereNotNull('leader_member_type')->where('proposal_id', $proposals->id)->get();

                foreach($leaderId as $user)
                {
                DB::table('notifications')->where('notifiable_id', $user->user_id)->whereJsonContains('data->proposal_id', $proposals->id)->delete();
                $userLeader = User::where('id', $user->user_id)->get();
                Notification::send($userLeader, new UserTagRemoveProposalNotification($user));
                }

                ProposalMember::whereNotNull('leader_member_type')->where('proposal_id', $proposals->id)->delete();
                ProposalMember::whereNull('leader_member_type')->where('proposal_id', $proposals->id)->delete();

            }

            if($request->member !== null){

                ProposalMember::whereNotNull('member_type')->where('proposal_id', $proposals->id)->delete();

                foreach ($request->member as $item) {

                    $model = new ProposalMember();
                    $model->proposal_id = $proposals->id;
                    $model->user_id = $item['id'];
                    $model->member_type = $item['type'];
                    $model->save();

                    $ifExists =  DB::table('notifications')->where('notifiable_id',$item['id'])->whereJsonContains('data->proposal_id', $proposals->id)->exists();

                    if(!$ifExists){

                        $users = User::where('id', $model->user_id)->get();
                        Notification::send($users, new UserTagProposalNotification($model));
                        DB::table('notifications')->where('notifiable_id', $model->user_id)->whereJsonContains('data->remove_proposal_id', $proposals->id)->delete();
                        // DB::table('notifications')->where('notifiable_id','!==' ,$model->user_id)->whereJsonContains('data->remove_proposal_id', $proposals->id)->delete();
                    }
                }

            }else {
                $memberIds = ProposalMember::whereNotNull('member_type')->where('proposal_id', $proposals->id)->get();

                foreach($memberIds as $user){
                    DB::table('notifications')->where('notifiable_id', $user->user_id )->whereJsonContains('data->proposal_id', $proposals->id)->delete();
                    $userLeader = User::where('id', $user->user_id)->get();
                    Notification::send($userLeader, new UserTagRemoveProposalNotification($user));
                }

                ProposalMember::whereNotNull('member_type')->where('proposal_id', $proposals->id)->delete();

            }
            app('flasher')->addSuccess('Updated Successfully.');

        return redirect(route('User-dashboard.show-proposal', $proposals->id ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fileIndex()
    {

        $views = collect(File::allFiles(public_path('upload')))->map->getPathName();
        return view('makefile', compact('views'));
    }


     // Create Make Directory
     public function createDirecrotory(Request $request)
     {

         $request->validate([
             'filename' => 'required',
            ]);

         $path = public_path('upload/filefolder/'. $request->filename);

         if(!File::isDirectory($path)){
             File::makeDirectory($path, 0775, true, true);

     // retry storing the file in newly created path.
         }

         return redirect(route('index-file'));
     }


     public function tagsInput(Request $request)
     {
        $keyword = $request->input('keyword');
        Log::info($keyword);
        $skills = DB::table('users')->where('name','like','%'.$keyword.'%')->select('users.id','users.name')->get();
        return json_encode($skills);

        return view('makefile');
     }

     public function UserDeleteProposal($id){

        $proposal = Proposal::findorFail($id);
        $proposal->delete();

        return redirect(route('User-dashboard.index'))->with('message', 'Proposal Deleted Successfully');
     }

     public function search(Request $request, $id)
    {
        $query = $request->input('query');
        $selected_value = $request->input('selected_value');

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;
        $proposal = Proposal::with('programs')->get();
        $user = Auth::user();
        $programs = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $ceso_roles = CesoRole::orderBy('role_name')->pluck('role_name', 'id')->prepend('Select Role', '');
        $counts = Proposal::where('user_id', auth()->user()->id)->where('authorize', 'finished')->whereYear('created_at', $currentYear)->count();
        $members = User::orderBy('name')->whereNot('name', 'Administrator')->pluck('name', 'id')->prepend('Select Username', '');
        $parts_names = ParticipationName::orderBy('participation_name')->pluck('participation_name', 'id')->prepend('Select Participation', '');
        $second = ProposalMember::select('user_id')->with('proposal')->where('user_id', auth()->user()->id)->whereYear('created_at', $currentYear)->count();
        $Temporary = TemporaryEvaluationFile::all();
        $latestYearPoints = Evaluation::select(DB::raw('MAX(YEAR(created_at)) as max_year'), 'total_points')->groupBy('total_points')->latest('max_year')->where('user_id', auth()->user()->id)->whereYear('created_at', $currentYear)->first();
        $proposalMembers = ProposalMember::with('proposal')->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(6);



        $proposals = Proposal::where(function ($query) {
            if($companyId = request('selected_value')){
                $query->where('authorize', $companyId);
            }})->when($query, function ($querys) use ($query) {
                return $querys->where('project_title', 'like', "%$query%");
                })->with(['proposal_members' => function ($query) {
                $query->where('user_id', auth()->user()->id);
            }])->orderBy('created_at', 'DESC')->whereYear('created_at', $currentYear )->get();




        return view('user.dashboard.user-dashboard._dashboard', compact(
        'proposalMembers','latestYearPoints','proposals', 'user', 'counts',
        'programs', 'locations', 'ceso_roles', 'members' , 'parts_names','currentYear',
        'previousYear', 'second', 'Temporary'));
    }

     public function filter(Request $request, $id)
    {

        $selected_value = $request->input('selected_value');
        $query = $request->input('query');
        $currentYear = date('Y');
        $previousYear = $currentYear + 1;
        $proposal = Proposal::with('programs')->get();
        $user = Auth::user();
        $programs = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $ceso_roles = CesoRole::orderBy('role_name')->pluck('role_name', 'id')->prepend('Select Role', '');
        $counts = Proposal::where('user_id', auth()->user()->id)->where('authorize', 'finished')->whereYear('created_at', $currentYear)->count();
        $members = User::orderBy('name')->whereNot('name', 'Administrator')->pluck('name', 'id')->prepend('Select Username', '');
        $parts_names = ParticipationName::orderBy('participation_name')->pluck('participation_name', 'id')->prepend('Select Participation', '');
        $second = ProposalMember::select('user_id')->with('proposal')->where('user_id', auth()->user()->id)->whereYear('created_at', $currentYear)->count();
        $Temporary = TemporaryEvaluationFile::all();
        $latestYearPoints = Evaluation::select(DB::raw('MAX(YEAR(created_at)) as max_year'), 'total_points')->groupBy('total_points')->latest('max_year')->where('user_id', auth()->user()->id)->whereYear('created_at', $currentYear)->first();
        $proposalMembers = ProposalMember::with('proposal')->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(6);


        $proposals = Proposal::with(['proposal_members' => function ($query) {
                $query->where('user_id', auth()->user()->id);
                }])->when($query, function ($querys) use ($query) {
                    return $querys->where('project_title', 'like', "%$query%");
                })->where(function ($query) {
                    if($companyId = request('selected_value')){
                        $query->where('authorize', $companyId);
                    }})->orderBy('created_at', 'DESC')->whereYear('created_at', $currentYear )->get();



        return view('user.dashboard.user-dashboard._dashboard', compact(
        'proposalMembers','latestYearPoints','proposals', 'user', 'counts',
        'programs', 'locations', 'ceso_roles', 'members' , 'parts_names','currentYear',
        'previousYear', 'second', 'Temporary'));

    }

    public function UserProfile(){

        $user = User::where('id', Auth()->user()->id)->get();
        $facultyUsers = User::whereNot('name', 'Administrator')->whereNot('id', Auth()->user()->id)->where('faculty_id', Auth()->user()->faculty_id)->get();


        return view('user.dashboard.profile.index', compact('facultyUsers', 'user'));
    }

    public function MyProposal(){
        $count = ProposalMember::where('user_id', auth()->user()->id)->where(function ($query) {
            if($year = request('selected_value')){
                $query->whereYear('created_at', $year);
        }})->count();

        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposals = Proposal::with(['proposal_members' => function ($query) {
        $query->where('user_id', auth()->user()->id);
        }])->whereYear('created_at', date('Y'))->get();

        return view('user.dashboard.MyProposal.index', compact('proposals', 'years', 'count'));
    }

    public function MyProposalSearch(Request $request, $id){

        $query = $request->input('query');
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

        $count = ProposalMember::where('user_id', auth()->user()->id)->where(function ($query) {
            if($year = request('selected_value')){
                $query->whereYear('created_at', $year);
        }})->count();

        $proposals = Proposal::where(function ($query) {
            if($year = request('selected_value')){
                $query->whereYear('created_at', $year);
            }})->when($query, function ($querys) use ($query) {
                return $querys->where('project_title', 'like', "%$query%");
        })->with(['proposal_members' => function ($query) {
        $query->where('user_id', auth()->user()->id);
        }])->get();

        return view('user.dashboard.MyProposal._filter-dashboard', compact('proposals', 'years', 'count'));
    }

    public function MyProposalFilterYear(Request $request, $id){

        $query = $request->input('query');
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');

        $count = ProposalMember::where('user_id', auth()->user()->id)->where(function ($query) {
            if($year = request('selected_value')){
                $query->whereYear('created_at', $year);
        }})->count();


        $proposals = Proposal::when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%");
        })
        ->where(function ($query) {
            if($year = request('selected_value')){
                $query->whereYear('created_at', $year);
        }})
        ->with(['proposal_members' => function ($query) {
            $query->where('user_id', auth()->user()->id);
            }])->get();

        return view('user.dashboard.MyProposal._filter-dashboard', compact('proposals', 'years', 'count'));
    }

}

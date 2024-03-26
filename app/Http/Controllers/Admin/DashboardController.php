<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use App\Models\Evaluation;
use App\Rules\UniqueTitle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\CollectionMedia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\AdminProgramServices;
use Illuminate\Support\Facades\Http;
use App\Models\CustomizeAdminProposal;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ProposalNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserTagProposalNotification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Notifications\UserTagRemoveProposalNotification;

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



        $uuid = Str::random(7);
        $post = new Proposal();
        $post->uuid = $uuid;
        $post->program_id =  $request->program_id;
        $post->project_title =  $request->project_title;
        $post->started_date =  $request->started_date;
        $post->finished_date =  $request->finished_date;
        $post->user_id  = auth()->id();
        $post->save();

        if($request->tags == !null){

            foreach ($request->tags as $tag) {

                ProposalMember::create([
                    'proposal_id' => $post->id, // Set proposal_id to the newly created proposal's ID
                    'user_id' => $tag, // Set user_id to the current tag (user's ID)
                ]);

                $users = User::where('id',$tag)->get();
                Notification::send($users, new ProposalNotification($post));
            }
        }


        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();
        Notification::send($admin, new ProposalNotification($post));

        if ($request->hasFile('proposal_pdf')) {
            $media =  $post->addMediaFromRequest('proposal_pdf')->usingName(auth()->id())->usingFileName($request->project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');

            $collect = new CollectionMedia();
            $collect->media_id = $media->id ;
            $collect->proposal_id =  $post->id;
            $collect->user_id = auth()->id();
            $collect->collection_name = 'proposalPdf' ;
            $collect->save();

        }

        if ($request->hasFile('moa_pdf')) {
            $media =  $post->addMediaFromRequest('moa_pdf')->usingName(auth()->id())->usingFileName($request->project_title.'_moa.pdf')->toMediaCollection('moaPdf');

            $collect = new CollectionMedia();
            $collect->media_id = $media->id ;
            $collect->proposal_id =  $post->id;
            $collect->user_id = auth()->id();
            $collect->collection_name = 'moaPdf';
            $collect->save();
        }

        if ($specialorder = $request->file('special_order_pdf')) {

            foreach ($specialorder as $specials) {
                $media =   $post->addMedia($specials)->usingName(auth()->id())->toMediaCollection('specialOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $post->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'specialOrderPdf';
                $collect->save();
            }
        }

        if ($travelorder = $request->file('travel_order_pdf')) {

            foreach ($travelorder as $travels) {
                $media = $post->addMedia($travels)->usingName(auth()->id())->toMediaCollection('travelOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $post->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'travelOrderPdf';
                $collect->save();
            }
        }

        if ($officeorder = $request->file('office_order_pdf')) {

            foreach ($officeorder as $offices) {
                $media =  $post->addMedia($offices)->usingName(auth()->id())->toMediaCollection('officeOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $post->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'officeOrderPdf';
                $collect->save();
            }
        }

        if ($attendance = $request->file('attendance')) {

            foreach ($attendance as $attends) {
                $media =  $post->addMedia($attends)->usingName(auth()->id())->toMediaCollection('Attendance');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $post->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'Attendance';
                $collect->save();
            }
        }

        if ($attendancem = $request->file('attendancem')) {

            foreach ($attendancem as $attendm) {
                $media = $post->addMedia($attendm)->usingName(auth()->id())->toMediaCollection('AttendanceMonitoring');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $post->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'AttendanceMonitoring';
                $collect->save();
            }
        }
        if ($files = $request->file('other_files')) {

            foreach ($files as $file) {
                $media = $post->addMedia($file)->usingName(auth()->id())->toMediaCollection('otherFile');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $post->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'otherFile';
                $collect->save();
            }
        }






        AdminProgramServices::create([
            'proposal_id' => $post->id,
            'title' => $post->project_title,
            'status' => $post->programs->program_name,
        ]);

        // Get the year from the created_at timestamp of the Proposal
        $year = Carbon::parse($post->created_at)->format('Y');

        // Check if the year already exists in the AdminYear database
        $existingYear = AdminYear::where('year', $year)->first();

        // If the year does not exist, save it to the AdminYear database
        if (!$existingYear) {
            AdminYear::create([
                'year' => $year,
        ]);

        }


        flash()->addSuccess('Project Uploaded Successfully.');
        return redirect(route('admin.dashboard.index'));
    }

    //  Edit Proposal
    public function checkProposal(Request $request, $id )
    {
        $users = User::all();
        $proposal = Proposal::where('id', $id)->first();

        $proposals = Proposal::where('id', $id)->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')->orderBy('file_name', 'asc');
        }, 'programs'])
        ->first();

        $formedia = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
        $query->whereNot('collection_name', 'trash')->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
        ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
        },])->first();



        $uniqueProposalFiles = null;
        $existingTagIds = null;
        $existingTags = null;



        if ($proposals) {
            $uniqueProposalFiles = $proposals->medias ? $proposals->medias->unique('collection_name') : collect();
            $existingTagIds = $proposals->proposal_members()->pluck('user_id')->toArray();
            $existingTags = User::whereIn('id', $existingTagIds)->pluck('name', 'id')->toArray();
        }



        $uniqueformedias = null;
        if ($formedia) {
            $uniqueformedias = $formedia->medias ? $formedia->medias->unique('collection_name'): collect();
        }






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


        $otherFilePdfCount = Media::where('collection_name', 'otherFile')->count();
        $travelCount = Media::where('collection_name', 'travelOrderPdf')->count();
        $officeCount = Media::where('collection_name', 'officeOrderPdf')->count();
        $specialPdfCount = Media::where('collection_name', 'specialOrderPdf')->count();
        $attendancePdfCount = Media::where('collection_name', 'Attendance')->count();
        $attendancemPdfCount = Media::where('collection_name', 'AttendanceMonitoring')->count();
        $narrativePdfCount = Media::where('collection_name', 'NarrativeFile')->count();
        $terminalPdfCount = Media::where('collection_name', 'TerminalFile')->count();
        $mediaCount = Media::whereNot('collection_name','trash')->count();



        return view('admin.dashboard.proposal.edit-proposal', compact('proposal','proposals', 'program', 'members', 'formedia', 'latest',
        'uniqueProposalFiles', 'uniqueformedias','users','otherFilePdfCount','travelCount','officeCount','specialPdfCount','attendancePdfCount',
        'attendancemPdfCount','narrativePdfCount','terminalPdfCount','mediaCount','existingTags'));
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
            $proposals->clearMediaCollection('proposalPdf');
            $media =  $proposals->addMediaFromRequest('proposal_pdf')->usingName(auth()->id())->usingFileName($request->project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');


            $collect = new CollectionMedia();
            $collect->media_id = $media->id ;
            $collect->proposal_id =  $proposals->id;
            $collect->user_id = auth()->id();
            $collect->collection_name = 'proposalPdf' ;
            $collect->save();
        }

        if ($request->hasFile('moa_pdf')) {
            $proposals->clearMediaCollection('moaPdf');
            $media = $proposals->addMediaFromRequest('moa_pdf')->usingName('moa')->usingFileName($project_title.'_moa.pdf')->toMediaCollection('moaPdf');

            $collect = new CollectionMedia();
            $collect->media_id = $media->id ;
            $collect->proposal_id =  $proposals->id;
            $collect->user_id = auth()->id();
            $collect->collection_name = 'moaPdf';
            $collect->save();
        }


        if ($specialorder = $request->file('special_order_pdf')) {

            foreach ($specialorder as $specials) {
                $media =   $proposals->addMedia($specials)->usingName(auth()->id())->toMediaCollection('specialOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'specialOrderPdf';
                $collect->save();
            }
        }

        if ($travelorder = $request->file('travel_order_pdf')) {

            foreach ($travelorder as $travels) {
                $media = $proposals->addMedia($travels)->usingName(auth()->id())->toMediaCollection('travelOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'travelOrderPdf';
                $collect->save();
            }
        }

        if ($officeorder = $request->file('office_order_pdf')) {

            foreach ($officeorder as $offices) {
                $media =  $proposals->addMedia($offices)->usingName(auth()->id())->toMediaCollection('officeOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'officeOrderPdf';
                $collect->save();
            }
        }

        if ($attendance = $request->file('attendance')) {

            foreach ($attendance as $attends) {
                $media =  $proposals->addMedia($attends)->usingName(auth()->id())->toMediaCollection('Attendance');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'Attendance';
                $collect->save();
            }
        }

        if ($attendancem = $request->file('attendancem')) {

            foreach ($attendancem as $attendm) {
                $media = $proposals->addMedia($attendm)->usingName(auth()->id())->toMediaCollection('AttendanceMonitoring');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'AttendanceMonitoring';
                $collect->save();
            }
        }
        if ($files = $request->file('other_files')) {

            foreach ($files as $file) {
                $media = $proposals->addMedia($file)->usingName(auth()->id())->toMediaCollection('otherFile');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'otherFile';
                $collect->save();
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

        $existingTags  = $proposals->proposal_members()->pluck('user_id')->toArray();

        $newTags = $request->input('tags');

        // Find tags to add (new tags not in existing tags)
        $tagsToAdd = array_diff($newTags, $existingTags);
        // Find tags to remove (existing tags not in new tags)
        $tagsToRemove = array_diff($existingTags, $newTags);


        // To add -- -- -- -- -- -- -- -- --
        foreach ($tagsToAdd as $tag) {
            // Check if the tag already exists
            if (!ProposalMember::where('proposal_id', $proposals->id)->where('user_id', $tag)->exists()) {
                $model =  ProposalMember::create([
                'proposal_id' => $proposals->id,
                'user_id' => $tag,
                ]);

                $users = User::where('id',$tag)->get();
                Notification::send($users, new UserTagProposalNotification($model));

                DB::table('notifications')
                ->where('data->remove_tag_id', $tag)
                ->where('data->remove_proposal_id', $proposals->id)
                ->where('type', 'App\Notifications\UserTagRemoveProposalNotification')
                ->delete();


            }
        }

        // To remove -- -- -- -- -- -- --
        $toRemove = ProposalMember::where('proposal_id', $proposals->id)->whereIn('user_id', $tagsToRemove)->get();
        foreach ($toRemove as $remove){
          $user = User::where('id',$tagsToRemove)->get();
          Notification::send($user, new UserTagRemoveProposalNotification($remove));
        }

        DB::table('notifications')
        ->where('data->id', $proposals->id)
        ->where('notifiable_id', $tagsToRemove)
        ->where('type', 'App\Notifications\ProposalNotification')
        ->delete();

        DB::table('notifications')
        ->where('data->proposal_id', $proposals->id)
        ->where('data->tag_id', $tagsToRemove)
        ->where('type', 'App\Notifications\UserTagProposalNotification')
        ->delete();


        // Remove tags
        ProposalMember::where('proposal_id', $proposals->id)
        ->whereIn('user_id', $tagsToRemove)
        ->delete();

        flash()->addSuccess('Details Updated Successfully');
        return redirect("/admin/dashboard/user-proposal/{$proposals->id}");
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



        $proposalsWithCounts = Proposal::
        whereYear('created_at', date('Y'))
        ->select('authorize', \DB::raw('count(*) as count'))
        ->groupBy('authorize')
        ->get();

        $statusCounts = $proposalsWithCounts->pluck('count', 'authorize');
        $CountStatuslabels = $statusCounts->keys();
        $CountStatusdata = $statusCounts->values();


        return view('admin.dashboard.chart.index',compact( 'programLabel', 'programData', 'statusCount', 'pendingCount', 'ongoingCount', 'finishedCount',
            'labels','data','customizes', 'allProposal', 'years','CountStatuslabels','CountStatusdata'));
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


    public function EvaluationChart(){

        $evaluations = Evaluation::all();

        $progressPoints = Evaluation::select('total_points', 'users.first_name')
        ->join('users', 'evaluations.user_id', '=', 'users.id')
        ->orderByDesc('total_points')
        ->take(10)
        ->get();
        $maximumPoints = 100;



        $points = Evaluation::select('total_points', 'users.first_name')
        ->join('users', 'evaluations.user_id', '=', 'users.id')
        ->orderByDesc('total_points')
        ->take(10)
        ->pluck('total_points', 'users.first_name');
        $totalPoints = $points->values();
        $userNames = $points->keys();

        $roleCounts = Role::select('roles.name', DB::raw('COUNT(*) as count'))
        ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('users', 'model_has_roles.model_id', '=', 'users.id')
        ->join('evaluations', 'users.id', '=', 'evaluations.user_id')
        ->groupBy('roles.name')
        ->pluck('count', 'roles.name');
        $RoleCount = $roleCounts->values();
        $RoleNames = $roleCounts->keys();


        $statusCounts = Evaluation::select('status', DB::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status');
        $StatusCount = $statusCounts->values();
        $StatusNames = $statusCounts->keys();

        $facultyCounts = Evaluation::select('faculty_id', DB::raw('COUNT(*) as count'))
        ->groupBy('faculty_id')
        ->pluck('count', 'faculty_id');
        $facultyCount = $facultyCounts->values();
        $facultyNames = $facultyCounts->keys();

        return view('admin.dashboard.evaluation-chart.index',
        compact('evaluations', 'totalPoints', 'userNames','StatusCount','StatusNames','facultyCount','facultyNames'
        ,'RoleCount','RoleNames','progressPoints','maximumPoints'));
    }

}

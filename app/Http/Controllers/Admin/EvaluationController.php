<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\AdminYear;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\TrashedRecord;
use App\Models\EvaluationFile;
use App\Models\ProposalMember;
use App\Models\EvaluationStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminDeleteUserEvaluationNotification;
use App\Notifications\AdminSubmitEvaluationStatusToUserNotification;


class EvaluationController extends Controller
{
    public function index(){


        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        // First Semester: January to June
        $firstSemesterStart = "{$currentYear}-01-01";
        $firstSemesterEnd = "{$currentYear}-06-30";

        // Second Semester: July to December
        $secondSemesterStart = "{$currentYear}-07-01";
        $secondSemesterEnd = "{$currentYear}-12-31";

        $firstSemesterEvaluations = Evaluation::with('users')->with('evaluationfile')->whereBetween('created_at', [$firstSemesterStart, $firstSemesterEnd])->get();
        $secondSemesterEvaluations = Evaluation::with('users')->with('evaluationfile')->whereBetween('created_at', [$secondSemesterStart, $secondSemesterEnd])->get();


        $id = 1;
        $toggle = EvaluationStatus::findorFail($id);
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        // $latestData = Evaluation::whereYear('created_at', $currentYear)->get();
        // $users = User::with('evaluation')->get();



        return view('admin.evaluation.index', compact('currentYear', 'toggle' ,'years'
        ,'firstSemesterEvaluations','secondSemesterEvaluations'));
    }


    public function updateSystem(Request $request, $id)
    {
        // Find the record in the database
        $toggle = EvaluationStatus::findOrFail($id);

        // Toggle the data in the table based on the current state
        $toggle->update([
            'status' => $request->input('state') ? 'checked' : 'close',
        ]);

        return response()->json(['success' => true]);

    }


    public function show($id, $year){


        $evaluation = Evaluation::with('evaluationfile')->where('id', $id)
        ->with(['users' => function ($query) use ($year) {
                $query->with([
                    'proposal' => function ($query) use ($year) {
                        $query->whereYear('created_at', $year);
                    }
                ]);
                $query->with([
                    'proposals' => function ($query) use ($year) {
                        $query->whereYear('created_at', $year);
                    }
                ]);
            }
        ])->first();

        return view('admin.evaluation.show', compact('evaluation'));
    }

    public function update(Request $request, $id){

        $total =  $request->input('chairmanship_university') + $request->input('chairmanship_college') + $request->input('membership_university') + $request->input('membership_college') + $request->input('advisorship')
        + $request->input('oic') + $request->input('judge') + $request->input('resource') + $request->input('chairmanship_membership') + $request->input('facilication_on_going') + $request->input('facilication_regional')
        + $request->input('facilication_national') +  $request->input('facilication_international') +  $request->input('training_director_local')  + $request->input('training_director_international')
        + $request->input('resource_speaker_local') + $request->input('resource_speaker_international') + $request->input('facilitator_moderator_local')

        + $request->input('facilitator_moderator_international') + $request->input('reactor_panel_member_local') + $request->input('reactor_panel_member_international') + $request->input('technical_assistance')
        + $request->input('judge_community') + $request->input('commencement_guest_speaker') +  $request->input('coordinator_organizer_consultants') + $request->input('resource_person_lecturer')
        + $request->input('facilitator') + $request->input('member');

        $evaluation = Evaluation::find($id);

        if($evaluation->status == 'pending'){
            $users = User::where('id',$evaluation->user_id)->get();
            Notification::send($users, new AdminSubmitEvaluationStatusToUserNotification($evaluation));
        }


        Evaluation::where('id', $id)->update([

            'faculty_id' => $request->faculty_id,
            'period_of_evaluation' => $request->period_of_evaluation,
            'chairmanship_university' => $request->chairmanship_university,
            'chairmanship_college' => $request->chairmanship_college,
            'membership_university' => $request->membership_university,
            'membership_college' => $request->membership_college,
            'advisorship' => $request->advisorship,
            'oic' => $request->oic,
            'judge' => $request->judge,
            'resource' => $request->resource,
            'chairmanship_membership' => $request->chairmanship_membership,
            'facilication_on_going' => $request->facilication_on_going,
            'facilication_regional' => $request->facilication_regional,
            'facilication_national' => $request->facilication_national,
            'facilication_international' => $request->facilication_international,
            'training_director_local' => $request->training_director_local,
            'training_director_international' => $request->training_director_international,
            'resource_speaker_local' => $request->resource_speaker_local,
            'resource_speaker_international' => $request->resource_speaker_international,
            'facilitator_moderator_local' => $request->facilitator_moderator_local,
            'facilitator_moderator_international' => $request->facilitator_moderator_international,
            'reactor_panel_member_local' => $request->reactor_panel_member_local,
            'reactor_panel_member_international' => $request->reactor_panel_member_international,
            'technical_assistance' => $request->technical_assistance,
            'judge_community' => $request->judge_community,
            'commencement_guest_speaker' => $request->commencement_guest_speaker,
            'coordinator_organizer_consultants' => $request->coordinator_organizer_consultants,
            'resource_person_lecturer' => $request->resource_person_lecturer,
            'facilitator' => $request->facilitator,
            'member' => $request->member,
            'name_of_faculty' => $request->name_of_faculty,
            'status' => $request->status,
            'total_points' => $total,
        ]);




        flash()->addSuccess('Evaluation Updated Successfully.');
        return redirect(route('admin.evaluation.index'))->with('message', 'Evaluation update successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        EvaluationStatus::where('id', 1)->update([

            'status' => $request->input('status')  ==  true ? 'open' : 'close'
        ]);


        return response()->json(['success' => true]);
    }


    public function deleteEvaluation($id){


        $delete = Evaluation::withTrashed()->findorFail($id);

        $files = EvaluationFile::where('evaluation_id', $id)->get();

        foreach ($files as $file) {
            $filePath = public_path('file/'.$file->path);

            if (File::exists($filePath)) {
                // Delete the file
                File::delete($filePath);

                // Extract the directory path from the file path
                $directoryPath = dirname($filePath);

                // Check if the directory is empty
                if (count(File::allFiles($directoryPath)) === 0) {
                    // If the directory is empty, delete it
                    File::deleteDirectory($directoryPath);
                }
            }
        }

        $user = User::where('id', $delete->user_id)->get();
        Notification::send($user, new AdminDeleteUserEvaluationNotification($delete));

        $delete->forceDelete();

        flash()->addSuccess('Evaluation has been deleted');
        return back();
    }


    public function RestoreEvaluation($id){

        $restore = Evaluation::withTrashed()->where('id', $id)->first();
        $removeTrashed = TrashedRecord::where('uuid', $id)->first();

        if($restore && $restore->trashed()){
            $restore->restore();
            $removeTrashed->delete();
        }

        flash()->addSuccess('Evaluation has been restored');
        return back();
    }

    public function TrashEvaluation($id){

        $delete = Evaluation::findorFail($id);

        $trashRecord = new TrashedRecord();
        $trashRecord->uuid = $delete->uuid;
        $trashRecord->name = $delete->users->name;
        $trashRecord->type = 'evaluation';
        $trashRecord->user_id = Auth()->user()->id;
        $trashRecord->save();

        $delete->delete();

        return response()->json(['success' => 'Trashed Successfully']);
    }



}

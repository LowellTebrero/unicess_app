<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\EvaluationStatus;
use App\Http\Controllers\Controller;
use App\Models\ProposalMember;

class EvaluationController extends Controller
{
    public function index(){

        $evaluations = Evaluation::with('users')->with('evaluationfile')->get();
        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        $id = 1;
        $toggle = EvaluationStatus::findorFail($id);

        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();
        $latestData = Evaluation::whereYear('created_at', '>=', $currentYear)
        ->whereYear('created_at', '<=', $previousYear)->get();

        return view('admin.evaluation.index', compact( 'latestData','currentYear', 'previousYear', 'evaluations', 'toggle'));
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

    public function filters(Request $request){

        $selectedYear = $request->input('year');

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        [$startYear, $endYear] = explode('-', $selectedYear);

        $currentYear = $startYear;
        $previousYear = $endYear;

        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();
        $latestData = Evaluation::whereYear('created_at', $startYear)->get();


        $evaluations = Evaluation::whereYear('created_at', '>=', $startYear)
        ->whereYear('created_at', '<=', $endYear)
        ->with('users')->get();

        $id = 1;
        $toggle = EvaluationStatus::findOrFail($id);

        return view('admin.evaluation.index', compact( 'latestData','currentYear', 'previousYear', 'evaluations', 'toggle'));
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

        // dd($evaluation);

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
        return redirect(route('admin.evaluation.index'))->with('message', 'Evaluation update successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        EvaluationStatus::where('id', 1)->update([

            'status' => $request->input('status')  ==  true ? 'open' : 'close'
        ]);

        return response()->json(['success' => true]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\EvaluationStatus;
use Illuminate\Support\Facades\DB;

class UserFilterEvaluationController extends Controller
{
    public function user_filter_evaluation(Request $request, $id){

        $selectedYear = $request->input('years');
        $dateNow = date('Y-m-d');
        $currentYear = $selectedYear;
        $previousYear = $currentYear + 1;


        // First Semester: January to June
        $firstSemesterStart = "{$currentYear}-01-01";
        $firstSemesterEnd = "{$currentYear}-06-30";

        // Second Semester: July to December
        $secondSemesterStart = "{$currentYear}-07-01";
        $secondSemesterEnd = "{$currentYear}-12-31";



        $firstSemesterEvaluations = Evaluation::where('user_id', $id)->whereBetween('created_at', [$firstSemesterStart, $firstSemesterEnd])->first();
        $secondSemesterEvaluations = Evaluation::where('user_id', $id)->whereBetween('created_at', [$secondSemesterStart, $secondSemesterEnd])->first();

        $evaluation = Evaluation::where('user_id', $id)->whereYear('created_at', '>=', $currentYear)->whereYear('created_at', '<=', $previousYear)->get();
        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year') , 'status', 'id')->where('user_id', $id)->get();
        $status = EvaluationStatus::where('id', 1)->first();
        $proposal_member = ProposalMember::where('user_id', $id)->with('proposal')->get();

        $latesEvaluationtYear = Evaluation::select(DB::raw('MAX(YEAR(created_at)) as max_year'))->where('user_id', $id)->value('max_year');
        $result = Evaluation::select('status', DB::raw('MAX(YEAR(created_at)) as max_year'))->groupBy('status')->where('user_id', $id)->get();
        $latestYearAndId = Evaluation::select(DB::raw('YEAR(created_at) as year'),DB::raw('MAX(id) as id'))->groupBy('year')->orderByDesc('year')->where('user_id', $id)->first();



        $data = [
            'evaluation' => $evaluation,
            'evaluation_status'  => $evaluation_status,
            'status'  => $status,
            'result'  => $result,
            'latesEvaluationtYear'   => $latesEvaluationtYear,
            'latestYearAndId' => $latestYearAndId,
            'id' => $id,
            'currentYear'=> $currentYear,
            'previousYear' => $previousYear,
            'proposal_member' => $proposal_member,
            'firstSemesterEvaluations' => $firstSemesterEvaluations,
            'secondSemesterEvaluations' => $secondSemesterEvaluations,
            'firstSemesterStart' => $firstSemesterStart,
            'firstSemesterEnd' => $firstSemesterEnd,
            'secondSemesterStart' => $secondSemesterStart,
            'secondSemesterEnd' => $secondSemesterEnd,
            'dateNow' => $dateNow,

        ];









        return view('user.evaluate.index_filter._filter_new_index')->with( $data );
    }



}






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
        $currentYear = $selectedYear;
        $previousYear = $currentYear + 1;

        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year') , 'status' , 'id')->where('user_id', $id)->whereYear('created_at', $selectedYear)->get();
        $status = EvaluationStatus::select('status')->get();
        $latestYear = ProposalMember::select(DB::raw('MAX(YEAR(created_at)) as max_year'))->where('user_id',  $id)->value('max_year');
        $result = Evaluation::select('status', DB::raw('MAX(YEAR(created_at)) as max_year'))->groupBy('status')->get();
        $latesEvaluationtYear = Evaluation::select(DB::raw('MAX(YEAR(created_at)) as max_year'))->where('user_id',  $id)->value('max_year');
        $latestYearAndId = Evaluation::select(DB::raw('YEAR(created_at) as year'), DB::raw('MAX(id) as id'))->groupBy('year')->orderByDesc('year')->first();
        $evaluation = Evaluation::where('user_id', $id)->whereYear('created_at', $selectedYear)->get();


        $data = [
            'evaluation' => $evaluation,
            'evaluation_status'  => $evaluation_status,
            'latestYear'  => $latestYear,
            'status'  => $status,
            'result'  => $result,
            'latesEvaluationtYear'   => $latesEvaluationtYear,
            'latestYearAndId' => $latestYearAndId,
            'id' => $id,
            'currentYear'=> $currentYear,
            'previousYear' => $previousYear,

        ];

        return view('user.evaluate.index_filter._filter_index')->with( $data );
    }



}






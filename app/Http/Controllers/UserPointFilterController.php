<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CesoRole;
use App\Models\Proposal;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\EvaluationStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserPointFilterController extends Controller
{
    public function user_filter_points(Request $request, $id){

        $selectedYear = $request->input('selected_value');
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


        
        $evaluations = Evaluation::where('user_id', $id)->whereYear('created_at', $selectedYear)->get();
        $proposals = ProposalMember::where('user_id', $id)->whereYear('created_at', $selectedYear)->get();
        $latestYearPoints = Evaluation::select('created_at', 'total_points')->latest('created_at')
        ->where('user_id', $id)->whereYear('created_at', $selectedYear)->first();

     
       
        $status = EvaluationStatus::select('status')->get();
        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year'),'status')->get();


        $data = [
            'proposals'  => $proposals,
            'latestYearPoints'  => $latestYearPoints,
            'status'  => $status,
            'evaluation_status'  => $evaluation_status,
            'dateNow'   => $dateNow,
            'currentYear'   => $currentYear,
            'previousYear' => $previousYear,
            'evaluations' => $evaluations,
            'firstSemesterStart' => $firstSemesterStart,
            'firstSemesterEnd' => $firstSemesterEnd,
            'secondSemesterStart' => $secondSemesterStart,
            'secondSemesterEnd' => $secondSemesterEnd,
            'firstSemesterEvaluations' => $firstSemesterEvaluations,
            'secondSemesterEvaluations' => $secondSemesterEvaluations,
        ];

        // dd($proposals);

        return view('user.point-system._filter_index')->with( $data );
    }

}

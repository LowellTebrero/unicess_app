<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposal;
use App\Models\AdminYear;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\EvaluationStatus;
use Illuminate\Support\Facades\DB;

class PointsController extends Controller
{
    public function index(Request $request){


        $currentYear = date('Y');
        $dateNow = date('Y-m-d');
        $previousYear = $currentYear + 1;

        // First Semester: January to June
        $firstSemesterStart = "{$currentYear}-01-01";
        $firstSemesterEnd = "{$currentYear}-06-30";

        // Second Semester: July to December
        $secondSemesterStart = "{$currentYear}-07-01";
        $secondSemesterEnd = "{$currentYear}-12-31";

        $firstSemesterEvaluations = Evaluation::where('user_id', Auth()->user()->id)->whereBetween('created_at', [$firstSemesterStart, $firstSemesterEnd])->first();
        $secondSemesterEvaluations = Evaluation::where('user_id', Auth()->user()->id)->whereBetween('created_at', [$secondSemesterStart, $secondSemesterEnd])->first();


        $status = EvaluationStatus::select('status')->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposals = ProposalMember::where('user_id', auth()->user()->id)->whereYear('created_at', $currentYear)->get();
        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year') , 'status')->where('user_id', auth()->user()->id)->get();
        $latestYearPoints = Evaluation::select('created_at', 'total_points')->latest('created_at')->where('user_id', auth()->user()->id)->whereYear('created_at', $currentYear)->first();
        $evaluations = Evaluation::where('user_id', Auth()->user()->id)->whereYear('created_at', $currentYear)->get();

        return view('user.point-system.index', compact('proposals',
        'currentYear','status', 'evaluation_status','latestYearPoints', 'years', 'evaluations','firstSemesterEvaluations','secondSemesterEvaluations'
        ,'firstSemesterStart','secondSemesterStart','dateNow','previousYear'));
    }

    public function filter(Request $request){
        $selectedYear = $request->input('year');

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        [$startYear, $endYear] = explode('-', $selectedYear);

        $currentYear = $startYear;
        $previousYear = $endYear;

        $proposals = Proposal::whereYear('created_at', $startYear)
            ->get();



        $member = ProposalMember::where('user_id', auth()->user()->id)
        ->whereYear('created_at', '<=', $endYear)
        ->sum('points');



        $count2 = ProposalMember::whereYear('created_at', '>=', $startYear)
        ->whereYear('created_at', '<=', $endYear)
        ->where('user_id', auth()->user()->id)->count();

        $result =  $member;
        $countResult =  $count2;

        $status = EvaluationStatus::select('status')->get();

        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year'),'status')->get();

        $latestYearPoints = Evaluation::select('created_at', 'total_points')->latest('created_at')->whereYear('created_at', $startYear)->where('user_id', auth()->user()->id)->first();


    return view('user.point-system.index', compact('latestYearPoints','proposals',
    'result', 'countResult', 'currentYear', 'previousYear',
    'status', 'evaluation_status'));
}


}

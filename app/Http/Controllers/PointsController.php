<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CesoRole;
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


        $cesos = CesoRole::all();

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        $status = EvaluationStatus::select('status')->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposals = ProposalMember::where('user_id', auth()->user()->id)->whereYear('created_at', '>=', $currentYear)
        ->whereYear('created_at', '<=', $previousYear)->get();


        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year') , 'status')->where('user_id', auth()->user()->id)->get();
        $latestYearPoints = Evaluation::select('created_at', 'total_points')->latest('created_at')->where('user_id', auth()->user()->id)->whereYear('created_at', '>=', $currentYear)
        ->whereYear('created_at', '<=', $previousYear)->first();

        $ceso_roles = CesoRole::all();



        return view('user.point-system.index', compact('proposals',
         'cesos',   'ceso_roles',
         'currentYear', 'previousYear',
         'status', 'evaluation_status',
          'latestYearPoints', 'years'));
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

        $cesos = CesoRole::whereYear('created_at', '>=', $startYear)
        ->whereYear('created_at', '<=', $endYear)
        ->get();

        $member = ProposalMember::where('user_id', auth()->user()->id)
        ->whereYear('created_at', '<=', $endYear)
        ->sum('points');

        $ceso_roles = CesoRole::all();

        $count2 = ProposalMember::whereYear('created_at', '>=', $startYear)
        ->whereYear('created_at', '<=', $endYear)
        ->where('user_id', auth()->user()->id)->count();

        $result =  $member;
        $countResult =  $count2;

        $status = EvaluationStatus::select('status')->get();

        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year'),'status')->get();

        $latestYearPoints = Evaluation::select('created_at', 'total_points')->latest('created_at')->whereYear('created_at', $startYear)->where('user_id', auth()->user()->id)->first();


    return view('user.point-system.index', compact('latestYearPoints','proposals', 'cesos',
    'result', 'countResult', 'currentYear', 'previousYear',
    'status', 'evaluation_status', 'ceso_roles'));
}


}

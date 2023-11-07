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
        $evaluations = Evaluation::where('user_id', $id)->whereYear('created_at', $selectedYear)->get();

        $proposals = ProposalMember::where('user_id', $id)->whereYear('created_at', $selectedYear)->get();

        $latestYearPoints = Evaluation::select('created_at', 'total_points')->latest('created_at')
        ->where('user_id', $id)->whereYear('created_at', $selectedYear)->first();


        $cesos = CesoRole::whereYear('created_at', '>=', $selectedYear)
        // ->whereYear('created_at', '<=', $endYear)
        ->get();

        $ceso_roles = CesoRole::all();

        $status = EvaluationStatus::select('status')->get();

        $evaluation_status = Evaluation::select(DB::raw('YEAR(created_at) year'),'status')->get();



        $data = [
            'proposals'  => $proposals,
            'cesos'  => $cesos,
            'latestYearPoints'  => $latestYearPoints,
            'status'  => $status,
            'evaluation_status'  => $evaluation_status,
            'ceso_roles'  => $ceso_roles,
            'currentYear'   => $selectedYear,
            'previousYear' => $selectedYear,
            'evaluations' => $evaluations
        ];

        // dd($proposals);

        return view('user.point-system._filter_points')->with( $data );
    }

}

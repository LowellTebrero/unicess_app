<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CesoRole;
use App\Models\Proposal;
use App\Models\AdminYear;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPointController extends Controller
{
    public function index(){

        $currentYear = date('Y');
        $latestData = Evaluation::whereYear('created_at', $currentYear)->orderBy("total_points", "DESC")->get();
        $users = User::with('evaluation')->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');


        return view('admin.points.index', compact('latestData','currentYear',  'years', 'users' ));
    }

    public function show($id, $year){

        $filteredUsers = User::with(['proposal' => function ($query) use ($year) {
            $query->whereYear('created_at', $year); }
        ])->where('id', $id)->with(['evaluation' => function ($query) use ($year) {
            $query->whereYear('created_at', $year); }
        ])->first();

        $proposals = Proposal::with(['proposal_members' => function ($query) use ($id) {
            $query->where('user_id', $id);
        }])->whereYear('created_at', date('Y'))->orderBy('created_at', 'DESC')->get();

        $evaluations = Evaluation::where('user_id', $id)->whereYear('created_at', $year)->get();



        return view('admin.points.show-points', compact('filteredUsers', 'proposals', 'evaluations' ));
    }

}

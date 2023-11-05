<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CesoRole;
use App\Models\Proposal;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPointController extends Controller
{
    public function index(){

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        $name = request('year');

        // $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->pluck('year')->first();

        $latestData = Evaluation::whereYear('created_at', '>=', $currentYear)
        ->whereYear('created_at', '<=', $previousYear)->orderBy("total_points", "DESC")->get();

        // dd($latestData);

        return view('admin.points.index', compact('latestData','currentYear', 'previousYear' ));
    }

    public function show($id, $year){

        $filteredUsers = User::with(['proposal' => function ($query) use ($year) {
            $query->whereYear('created_at', $year); }
        ])->where('id', $id)->with(['evaluation' => function ($query) use ($year) {
            $query->whereYear('created_at', $year); }
        ])->first();

        $proposals = Proposal::all();
        $ceso_roles = CesoRole::all();

        return view('admin.points.show-points', compact('filteredUsers', 'proposals', 'ceso_roles' ));
    }

    // public function AdminPointsfilter(Request $request){

    //     $selectedYear = $request->input('year');

    //     $currentYear = date('Y');
    //     $previousYear = $currentYear + 1;

    //     [$startYear, $endYear] = explode('-', $selectedYear);

    //     $currentYear = $startYear;
    //     $previousYear = $endYear;

    //     $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();
    //     $latestData = Evaluation::whereYear('created_at', $startYear)->with('users')->get();

    //     return view('admin.points.index', compact('currentYear', 'previousYear', 'latestData'));
    // }
}

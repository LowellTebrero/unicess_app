<?php

namespace App\Http\Controllers\Admin;

use App\Models\Point;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminFilterController extends Controller
{
    public function filter_points(Request $request){

        $selectedYear = $request->input('selected_value');

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        [$startYear, $endYear] = explode('-', $selectedYear);

        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();
        $latestData = Evaluation::with('users')->whereYear('created_at', $startYear)->get();

        $currentYear = $startYear;
        $previousYear = $endYear;

        $data = [
            'latestYear'  => $latestYear,
            'latestData'  => $latestData,
            'currentYear'   => $startYear,
            'previousYear' => $endYear
        ];


        return view('admin.points._filter_points')->with($data);
    }

    public function filter_evaluation(Request $request){

        $selectedYear = $request->input('selected_value');

        $currentYear = date('Y');
        $previousYear = $currentYear + 1;

        [$startYear, $endYear] = explode('-', $selectedYear);

        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();
        $latestData = Evaluation::whereYear('created_at', $startYear)->get();
        $evaluations = Evaluation::whereYear('created_at', '>=', $startYear)->whereYear('created_at', '<=', $endYear)->with('users')->get();

        $currentYear = $startYear;
        $previousYear = $endYear;

        $data = [
            'latestYear'  => $latestYear,
            'latestData'  => $latestData,
            'evaluations'  => $evaluations,
            'currentYear'   => $startYear,
            'previousYear' => $endYear
        ];


        return view('admin.evaluation._filter_evaluation')->with( $data  );
    }
}

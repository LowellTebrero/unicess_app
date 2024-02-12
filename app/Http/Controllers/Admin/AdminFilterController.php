<?php

namespace App\Http\Controllers\Admin;

use App\Models\Point;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminFilterController extends Controller
{
    public function filter_points(){

        $query = request('query');
        $year = request('selected_value');
        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();

        $latestData = Evaluation::with('users')
        ->where(function ($query) {
        if($year = request('selected_value')){
        $query->whereYear('created_at', $year);
        }})->get();

        $users = User::with('evaluation')
        ->when($query, function ($querys) use ($query) {
        return
        $querys->where('name', 'like', "%$query%")
             ->orWhere('email', 'like',   "%$query%");
        })->get();

        $data = [
            'latestYear'  => $latestYear,
            'latestData'  => $latestData,
            'currentYear' => $year,
            'users' => $users,
        ];

        return view('admin.points._filter_points')->with($data);
    }

    public function filter_searchPoints(){

        $year = request('selected_value');
        $query = request('query');

        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();

        $latestData = Evaluation::with('users')->where(function ($query) {
        if($year = request('selected_value')){
        $query->whereYear('created_at', $year);
        }})->get();

        $users = User::with('evaluation')
        ->when($query, function ($querys) use ($query) {
        return
        $querys->where('name', 'like', "%$query%")
             ->orWhere('email', 'like',   "%$query%");
        })->get();

        $data = [
            'latestYear'  => $latestYear,
            'latestData'  => $latestData,
            'currentYear' => $year,
            'users' => $users,
        ];

        return view('admin.points._filter_points')->with($data);
    }

    public function filter_evaluation(){



        $year = request('selected_value');
        $query = request('query');
        $currentYear = $year;

        $searchTerm = $query ? $query : '';

        $firstSemesterStart = "{$currentYear}-01-01";
        $firstSemesterEnd = "{$currentYear}-06-30";

        // Second Semester: July to December
        $secondSemesterStart = "{$currentYear}-07-01";
        $secondSemesterEnd = "{$currentYear}-12-31";


        $firstSemesterEvaluations = Evaluation::with('users')
        ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->whereHas('users', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%");
            });
        })->whereBetween('created_at', [$firstSemesterStart, $firstSemesterEnd])
        ->get();



        $secondSemesterEvaluations = Evaluation::with('users')
        ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->whereHas('users', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%");
            });
        })->whereBetween('created_at', [$secondSemesterStart, $secondSemesterEnd])
        ->get();




        $data = [
            // 'latestData'  => $latestData,
            'currentYear'   => $currentYear,
            'firstSemesterEvaluations'   => $firstSemesterEvaluations,
            'secondSemesterEvaluations'   => $secondSemesterEvaluations,
        ];


        return view('admin.evaluation._filter_evaluation')->with( $data );
    }

    public function filter_searchEvaluation(){

        $year = request('selected_value');
        $query = request('query');
        $currentYear = $year;

        $searchTerm = request('query');

        $currentYear = $year;
        $firstSemesterStart = "{$currentYear}-01-01";
        $firstSemesterEnd = "{$currentYear}-06-30";

        // Second Semester: July to December
        $secondSemesterStart = "{$currentYear}-07-01";
        $secondSemesterEnd = "{$currentYear}-12-31";

        $firstSemesterEvaluations = Evaluation::with('users')
        ->whereBetween('created_at', [$firstSemesterStart, $firstSemesterEnd])
        ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->whereHas('users', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%");
            });
        })
        ->get();

        dd($firstSemesterEvaluations);

        $secondSemesterEvaluations = Evaluation::with('users')
        ->whereBetween('created_at', [$secondSemesterStart, $secondSemesterEnd])
        ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->whereHas('users', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%");

            });
        })
        ->get();


        $data = [

            'currentYear'   => $currentYear,
            'firstSemesterEvaluations'   => $firstSemesterEvaluations,
            'secondSemesterEvaluations'   => $secondSemesterEvaluations,
        ];

        return view('admin.evaluation._filter_evaluation')->with( $data );
    }
}

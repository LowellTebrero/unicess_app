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

        $currentYear = date('Y');
        $query = request('query');
        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();

        $latestData = Evaluation::where(function ($query) {
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
            'currentYear'   => $currentYear,
            'users'   => $users,
        ];


        return view('admin.evaluation._filter_evaluation')->with( $data );
    }

    public function filter_searchEvaluation(){

        $year = request('selected_value');
        $query = request('query');

        $latestYear = Evaluation::selectRaw('YEAR(created_at) as year')->orderByDesc('created_at')->groupBy('year')->pluck('year')->first();

        $latestData = Evaluation::where(function ($query) {
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

        return view('admin.evaluation._filter_evaluation')->with( $data );
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Charts\ProposalChart;
use App\Models\ProposalMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ChartController extends Controller
{
    public function index(Request $request){


        $users = Proposal::select(DB::raw("COUNT(*) as count"),
        DB::raw("MONTHNAME(created_at) as month_name"))
        ->groupBy(DB::raw("month_name"))
        ->orderBy('created_at','ASC')
        ->pluck('count','month_name');

        $labels = $users->keys();
        $data = $users->values();


        $proposals = Proposal::leftJoin('programs', 'proposals.program_id', '=', 'programs.id')
        ->select(DB::raw("COUNT(*) as count"), 'programs.program_name as name')
        ->groupBy(DB::raw("name"))
        ->pluck('count','name');

        $proposals->keys();
        $proposals->values();


        $chart = new ProposalChart;
        $chart->labels($proposals->keys());
        $chart->dataset('Proposals Program name', 'pie', $proposals->values())->backgroundColor([
            'rgba(234,27,27,10)', 'rgba(27,135,234,10)', 'rgba(255,199,0,10)', 'green', 'violet', 'brown', 'orange', 'pink'
        ]);










        return view('admin.chart.index',compact( 'labels','data','chart'));
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proposal;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTrashController extends Controller
{
    public function index(){

        $proposals = Proposal::onlyTrashed()->whereYear('created_at',  date('Y'))
        ->orderBy('created_at', 'DESC')->with('programs')->distinct()->get();

        $evaluations = Evaluation::onlyTrashed()->get();



        $trash = Proposal::withTrashed()->
        with(['medias' => function ($query) {
        $query->where('collection_name', 'trash')
        ->where(function ($query) {
            $query->whereIn('model_id', function ($subQuery) {
                $subQuery->select('id')
                ->from('proposals')
                ->where('name', 'like', '%proposal%')
                ->orWhere('name', 'like', '%moa%')
                ->orWhere('name', 'like', '%other%');
            });
        });
        }])
        ->with(['proposalfiles' => function ($query) {
            $query->with(['medias' => function ($mediaQuery) {
                $mediaQuery->where('collection_name', 'trash');
            }])
            ->withTrashed();
        }])

        ->orderBy('created_at', 'DESC')
        ->distinct()->get();


        // dd($trash);
        return view('admin.trash.index', compact('trash', 'proposals', 'evaluations'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index(){


        $proposals = Proposal::onlyTrashed()->whereYear('created_at',  date('Y'))->with(['proposal_members' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])->orderBy('created_at', 'DESC')->with('programs')->distinct()->get();



        $trash = Proposal::withTrashed()->
        with(['proposal_members' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        },'medias' => function ($query) {
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
            }])->where('user_id', auth()->user()->id)
            ->withTrashed();
        }])

        ->orderBy('created_at', 'DESC')
        ->distinct()->get();


        // dd($trash);
        return view('user.trash.index', compact('trash', 'proposals'));
    }
}


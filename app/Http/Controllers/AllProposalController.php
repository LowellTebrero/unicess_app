<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\AdminYear;
use App\Models\CustomizeUserAllProposal;
use Illuminate\Http\Request;
use App\Models\ProposalMember;

class AllProposalController extends Controller
{
    public function index(){

        $proposalmember = ProposalMember::with('proposal')->get();
        $allproposal = CustomizeUserAllProposal::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposals = Proposal::orderBy('created_at', 'asc')->get();
        $myproposal = Proposal::with(['proposal_members' => function ($query) {
        $query->where('user_id', auth()->user()->id); }])->get();

        return view('user.allProposal.index', compact('proposals','myproposal', 'allproposal',  'years', 'proposalmember'));
    }


    public function filterAllProposal(Request $request){

        $query = $request->input('selectedValue2');

        $proposals = Proposal::orderBy('created_at', 'desc')
        ->when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%");
        })
        ->where(function ($query) {
            if($Year = request('selectedValue')){
                $query->whereYear('created_at', $Year);
            }})->get();

        $data = [
            'proposals'  => $proposals,
        ];

        return view('user.allProposal._filtered_data')->with($data);

    }

    public function filterUserProposal(Request $request, $id){

        $query = $request->input('selectedValue2');

        $myproposal = Proposal::with(['proposal_members' => function ($querys) use ($id) {
                $querys->where('user_id', $id);
            }])
            ->when($query, function ($querys) use ($query) {
                return $querys->where('project_title', 'like', "%$query%");
            })
            ->where(function ($query) {
            if($Year = request('mydropdown')){
                $query->whereYear('created_at', $Year);
            }})->get();

        $data = [
            'myproposal'  => $myproposal,
        ];

        return view('user.allProposal._filtered-my-proposal')->with($data);

    }

    public function searchAllProposal(Request $request)
    {

        $query = $request->input('query');

        $proposals = Proposal::where(function ($query) {
            if($Year = request('selectedValue')){
                $query->whereYear('created_at', $Year);
            }})
        ->when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%");
        })->get();

        $data = [
            'proposals'  => $proposals,
        ];

        return view('user.allProposal._filtered_data')->with($data);
    }


    public function searchMyProposal(Request $request, $id)
    {

        $query = $request->input('query');

        $myproposal = Proposal::with(['proposal_members' => function ($querys) use ($id) {
            $querys->where('user_id', $id);
        }])
        ->where(function ($query) {
            if($Year = request('selectedValue')){
                $query->whereYear('created_at', $Year);
            }})
        ->when($query, function ($querys) use ($query) {
            return $querys->where('project_title', 'like', "%$query%");
        })->get();

        $data = [
            'myproposal'  => $myproposal,
        ];

        return view('user.allProposal._filtered-my-proposal')->with($data);
    }



    public function MyProposal(Request $request){

        $myproposal = $request('myproposal');

        $proposals = Proposal::with(['proposal_members' => function ($querys) use ($myproposal) {
        return $querys->where('user_id', $myproposal);
        }])->get();

        $data = ['proposals'  => $proposals];

        return view('user.allProposal.index')->with($data);

    }

}

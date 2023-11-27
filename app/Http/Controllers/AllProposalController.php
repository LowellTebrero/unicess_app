<?php

namespace App\Http\Controllers;

use App\Models\CesoRole;
use App\Models\Location;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\ProposalRequest;
use App\Models\ParticipationName;
use App\Models\CustomizeUserAllProposal;

class AllProposalController extends Controller
{
    public function index(){

        $proposalmember = ProposalMember::with('proposal')->get();
        $allproposal = CustomizeUserAllProposal::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposals = Proposal::with('proposal_members')->orderBy('created_at', 'asc')->get();
        $myproposal = Proposal::with(['proposal_members' => function ($query) {
        $query->where('user_id', auth()->user()->id); }])->get();
        $leader_member = CesoRole::orderBy('role_name')->pluck('role_name', 'id');
        $participation_member = ParticipationName::orderBy('participation_name')->pluck('participation_name');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $proposalRequest = ProposalRequest::all();
        $proposalMembers = ProposalMember::all();

        return view('user.allProposal.index', compact('proposals','myproposal', 'allproposal',
         'years', 'proposalmember', 'leader_member', 'participation_member',
         'locations', 'proposalRequest', 'proposalMembers'));
    }




    public function filterAllProposal(Request $request){

        $query = $request->input('selectedValue2');

        $proposals = Proposal::with('proposal_members')->orderBy('created_at', 'desc')
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

        $proposals = Proposal::with('proposal_members')->where(function ($query) {
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


    public function RequestIndex(){

        $proposalRequest = ProposalRequest::with('proposal')->where('user_id', Auth()->user()->id)->get();
        return view('user.allProposal.send-request.index', compact('proposalRequest'));
    }

    public function RequestCreate(){

        $leader_member = CesoRole::orderBy('role_name')->pluck('role_name', 'id');
        $participation_member = ParticipationName::orderBy('participation_name')->pluck('participation_name');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $proposals = Proposal::orderBy('project_title', 'DESC')->get();
        return view('user.allProposal.send-request.create', compact('proposals','leader_member', 'participation_member','locations'));
    }


    public function SendRequest(Request $request){


        $request->validate([

            'files.*' => 'required','mimes:jpg,png,jpeg,pdf', 'max:5048',
            'proposal_id' => 'required|unique:proposal_requests,proposal_id',

        ],[
            'proposal_id' => ' Project Title Already added'
        ]);

        $proposalRequest = new ProposalRequest();
        $proposalRequest->user_id = Auth()->user()->id;
        $proposalRequest->proposal_id = $request->proposal_id;
        $proposalRequest->leader_member_type = $request->leader_member_type;
        $proposalRequest->leader_location = $request->location_id;
        $proposalRequest->member_type = $request->member_type;

        if ($files = $request->file('files')) {


            foreach ($files as $file) {
                $proposalRequest->addMedia($file)->usingName('Proposal_Request')->toMediaCollection('ProposalRequest');
            }
         }

        $proposalRequest->save();

        flash()->addSuccess('Request Sent Successfully.');

        return redirect(route('allProposal.request-proposal-index'));

    }

}

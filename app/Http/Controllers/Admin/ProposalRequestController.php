<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CesoRole;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\ProposalRequest;
use App\Models\ParticipationName;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProposalRequestController extends Controller
{
    public function index(){


        $proposalMembers = ProposalMember::all();
        $ProposalRequest = ProposalRequest::all();

        return view('admin.dashboard.request.index', compact('ProposalRequest', 'proposalMembers'));
    }

    public function show($id, $notiification){

        $ProposalRequest = ProposalRequest::find($id);
        $members = User::orderBy('name')->whereNot('name', 'Administrator')->pluck('name', 'id')->prepend('Select Username', '');
        $ceso_roles = CesoRole::orderBy('role_name')->pluck('role_name', 'id')->prepend('Select Role', '');
        $locations = Location::orderBy('location_name')->pluck('location_name', 'id')->prepend('Select Location', '');
        $parts_names = ParticipationName::orderBy('participation_name')->pluck('participation_name', 'id');

        $leaderMember = ProposalMember::where('proposal_id', $ProposalRequest->proposal_id)
        ->where('user_id', $ProposalRequest->user_id)
        ->where('leader_member_type', $ProposalRequest->leader_member_type)
        ->where('location_id', $ProposalRequest->leader_location)
        ->get();

        $Member = ProposalMember::where('proposal_id', $ProposalRequest->proposal_id)
        ->where('user_id', $ProposalRequest->user_id)
        ->where('member_type', $ProposalRequest->member_type)
        ->where('location_id', NULL)
        ->get();

        // dd($Member);

        return view('admin.dashboard.request.show', compact('ProposalRequest',  'members', 'ceso_roles',
        'locations', 'parts_names', 'leaderMember', 'Member'));
    }

    public function storeRequest(Request $request){

        $request->validate([

            'leader_member_type' => [
                'unique:proposal_members,leader_member_type,NULL,id,proposal_id,' . $request->input('proposal_id') . ',user_id,' . $request->input('leader_id') ,
            ],
            'member_type' => [
                'unique:proposal_members,member_type,NULL,id,proposal_id,' . $request->input('proposal_id') . ',user_id,' . $request->input('member_id') ,
            ],
        ]);


        if($request->leader_member_type !== NULL){


         ProposalRequest::where('proposal_id', $request->input('proposal_id'))
        ->where('user_id', $request->input('leader_id'))
        ->where('leader_member_type', $request->input('leader_member_type'))
        ->where(  'leader_location', $request->input('location_id'))
        ->update([
            'status' => 'Added'
        ]);


            $leadersave = [
                'proposal_id' => $request->input('proposal_id'),
                'user_id'=> $request->input('leader_id'),
                'leader_member_type' => $request->input('leader_member_type'),
                'location_id' => $request->input('location_id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            DB::table('proposal_members')->insert($leadersave);


        };

        if($request->member_id !== NULL){

            ProposalRequest::where('proposal_id', $request->input('proposal_id'))
            ->where('user_id', $request->input('member_id'))
            ->where('member_type', $request->input('member_type'))
            ->update([
                'status' => 'Added'
            ]);

            $membersave = [
                'proposal_id' => $request->input('proposal_id'),
                'user_id'=> $request->input('member_id'),
                'member_type' => $request->input('member_type'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            DB::table('proposal_members')->insert($membersave);
        };


        flash()->addSuccess('Member Added Successfully.');

        return back();

    }
}

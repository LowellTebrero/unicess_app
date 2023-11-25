<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProposalRequest;
use App\Http\Controllers\Controller;
use App\Models\ProposalMember;

class ProposalRequestController extends Controller
{
    public function index(){

        $proposalMembers = ProposalMember::all();
        $ProposalRequest = ProposalRequest::all();

        return view('admin.dashboard.request.index', compact('ProposalRequest', 'proposalMembers'));
    }

    public function show($id, $notiification){

        $proposalMembers = ProposalMember::all();

        $ProposalRequest = ProposalRequest::find($id);

        return view('admin.dashboard.request.show', compact('ProposalRequest', 'proposalMembers'));
    }
}

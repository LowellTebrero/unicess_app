<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\ProposalFiles;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\UserAttendance;
use App\Models\NarrativeReport;
use App\Models\UserOfficeOrder;
use App\Models\UserTravelOrder;
use App\Models\UserSpecialOrder;
use App\Models\UserAttendanceMonitoring;
use App\Notifications\NarrativeNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ReportController extends Controller
{
    public function index(){

        $proposalMembers = ProposalMember::with('proposal')->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();

        $proposals = Proposal::with(['proposal_members' => function ($query) {
            $query->select('proposal_id')->where('user_id', auth()->user()->id)->distinct();
        }])
        ->with(['medias' => function ($mediaQuery) {
            $mediaQuery->whereNot('collection_name', 'trash')->distinct();
        }])
        ->orderBy('created_at', 'DESC')->whereYear('created_at', date('Y'))->distinct('proposal_id')->get();

        // dd($proposals);
        return view('user.report.index', compact('proposalMembers', 'proposals'));
    }


    public function RestoreProjectFolder($id){
        $proposal = Proposal::withTrashed()->where('id', $id)->first();

        if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
            $proposal->restore(); // Restore the soft-deleted model
        }

    
        flash()->addSuccess('Project restored successfully.');
        return back();
    }

    public function DeleteProjectFolder($id){
        $proposal = Proposal::where('id', $id)->withTrashed()->first();


        if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
            $proposal->forceDelete(); // Restore the soft-deleted model
        }

        flash()->addSuccess('Project deleted permanently.');
        return back();
    }

    

}

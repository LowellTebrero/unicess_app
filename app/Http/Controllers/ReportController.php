<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\NarrativeReport;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ReportController extends Controller
{
    public function index(){

        $proposalMembers = ProposalMember::with('proposal')->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $proposals = Proposal::with(['proposal_members' => function ($query) {
            $query->select('proposal_id')->where('user_id', auth()->user()->id)->distinct();
        }])->with(['narrativereport' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])->orderBy('created_at', 'DESC')->whereYear('created_at', date('Y'))->get();


        return view('user.report.index', compact('proposalMembers', 'proposals'));
    }

    public function NarrativeStore(Request $request){

        $request->validate([
            'narrative_file' => "required|max:10048",
        ]);

        $post = new NarrativeReport();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

        if ($narratives = $request->file('narrative_file')) {
            foreach ($narratives as $narrative) {
                $post->addMedia($narrative)->usingName('narrative')->toMediaCollection('NarrativeFile');
            }
        }

        $post->save();

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }

     // Delete
     public function deleteNarrativeMedias($id, $narrativeId)
     {
        $media = Media::findOrFail($id);
        $narrativeReport = NarrativeReport::findOrFail($narrativeId);
        $media->delete();

        // Check if the related NarrativeReport should be deleted
        if ($narrativeReport->medias()->count() === 0) {
            $narrativeReport->delete();
            flash()->addSuccess('File and related NarrativeReport deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();

     }


     public function NarrativeUpdate(Request $request, $id){

        $request->validate([
            'narrative_file' => "required|max:10048",
           ]);

        $post = NarrativeReport::where('id', $id)->first();

        if ($narratives = $request->file('narrative_file')) {
            foreach ($narratives as $narrative) {
                $post->addMedia($narrative)->usingName('narrative')->toMediaCollection('NarrativeFile');
            }
        }

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }

    public function TerminalStore(Request $request){

        $request->validate([
            'terminal_file' => "required|max:10048",
           ]);

        $post = new TerminalReport();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

        if ($terminals = $request->file('terminal_file')) {
            foreach ($terminals as $terminal) {
                $post->addMedia($terminal)->usingName('terminal')->toMediaCollection('TerminalFile');
            }
        }

        $post->save();

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }

    public function TerminalUpdate(Request $request, $id){

        $request->validate([
            'terminal_file' => "required|max:10048",
           ]);

        $post = TerminalReport::where('id', $id)->first();

        if ($terminals = $request->file('terminal_file')) {
            foreach ($terminals as $terminal) {
                $post->addMedia($terminal)->usingName('terminal')->toMediaCollection('TerminalFile');
            }
        }

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }

    // Delete
    public function deleteTerminalMedias($id, $terminalId)
    {
       $media = Media::findOrFail($id);
       $terminalReport = TerminalReport::findOrFail($terminalId);
       $media->delete();

       // Check if the related terminalReport should be deleted
       if ($terminalReport->medias()->count() === 0) {
           $terminalReport->delete();
           flash()->addSuccess('File and related TerminalReport deleted successfully.');
       } else {
           flash()->addSuccess('File deleted successfully.');
       }

       return back();

    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\User;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;

class ExtensionMonitoringController extends Controller
{
    public function index(){

        return view('admin.extension_monitoring.index');
    }

    public function show(Request $request, $id )
    {
        $users = User::all();
        $proposal = Proposal::where('id', $id)->first();

        $proposals = Proposal::where('id', $id)->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')->orderBy('file_name', 'asc');
        }, 'programs'])
        ->first();

        $formedia = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
        $query->whereNot('collection_name', 'trash')->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
        ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
        },])->first();

        $uniqueProposalFiles = null;
        $existingTagIds = null;
        $existingTags = null;

        if ($proposals) {
            $uniqueProposalFiles = $proposals->medias ? $proposals->medias->unique('collection_name') : collect();
            $existingTagIds = $proposals->proposal_members()->pluck('user_id')->toArray();
            $existingTags = User::whereIn('id', $existingTagIds)->pluck('name', 'id')->toArray();
        }

        $uniqueformedias = null;
        if ($formedia) {
            $uniqueformedias = $formedia->medias ? $formedia->medias->unique('collection_name'): collect();
        }

        $latest = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
            $query->latest()->first();
        }])->first();

        $program = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');
        $members = User::orderBy('name')
        ->doesntHave('roles', 'and', function ($query) {
            $query->where('id', 1);
        })
        ->get(['id', 'name'])
        ->mapWithKeys(function ($user) {
            return [$user->id => $user->name];
        });


        $allMonths = [];
        $currentMonth = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        while ($currentMonth <= $endOfYear) {
            $allMonths[] = $currentMonth->format('F');
            $currentMonth->addMonth();
        }

        // Count the occurrences of each month
        $mediaData = Proposal::where('id', $id)
            ->with('medias')
            ->get()
            ->flatMap(function ($proposal) {
                return $proposal->medias->map(function ($media) {
                    return $media->created_at->format('F'); // Format month
                });
            });

        $monthCounts = $mediaData->countBy()->toArray();

        // Fill in counts for each month, including zero counts
        $data = [];
        foreach ($allMonths as $month) {
            $data[] = isset($monthCounts[$month]) ? $monthCounts[$month] : 0;
        }

        $chartData = [
            'labels' => $allMonths,
            'data' => $data,
        ];


        $otherFilePdfCount = Media::where('collection_name', 'otherFile')->count();
        $travelCount = Media::where('collection_name', 'travelOrderPdf')->count();
        $officeCount = Media::where('collection_name', 'officeOrderPdf')->count();
        $specialPdfCount = Media::where('collection_name', 'specialOrderPdf')->count();
        $attendancePdfCount = Media::where('collection_name', 'Attendance')->count();
        $attendancemPdfCount = Media::where('collection_name', 'AttendanceMonitoring')->count();
        $narrativePdfCount = Media::where('collection_name', 'NarrativeFile')->count();
        $terminalPdfCount = Media::where('collection_name', 'TerminalFile')->count();
        $mediaCount = Media::whereNot('collection_name','trash')->count();



        return view('admin.extension_monitoring.show', compact('proposal','proposals', 'program', 'members', 'formedia', 'latest',
        'uniqueProposalFiles', 'uniqueformedias','users','otherFilePdfCount','travelCount','officeCount','specialPdfCount','attendancePdfCount',
        'attendancemPdfCount','narrativePdfCount','terminalPdfCount','mediaCount','existingTags', 'chartData'));
    }
}
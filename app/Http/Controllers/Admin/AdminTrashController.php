<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Proposal;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\TrashedRecord;
use App\Models\CollectionMedia;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class AdminTrashController extends Controller
{
    public function index(){

        $proposals = Proposal::onlyTrashed()->whereYear('created_at',  date('Y'))
        ->orderBy('created_at', 'DESC')->with('programs')->distinct()->get();

        $evaluations = Evaluation::onlyTrashed()->get();

        $trash = Proposal::withTrashed()->
        with(['medias' => function ($query) {
        $query->where('collection_name', 'trash');
        }])
        ->orderBy('created_at', 'DESC')
        ->distinct()->get();

        $users = User::get();
        $trashedRecord = TrashedRecord::all();
        $mediaCollection = CollectionMedia::all();
        return view('admin.trash.index', compact('trash', 'proposals', 'evaluations','users','mediaCollection','trashedRecord'));
    }

    public function RestoreFile(Request $request){

        $ids = $request->ids;

        // Update each media item
        foreach ($ids as $id) {

            $media = Media::where('uuid', $id)->first();
            $proposal = Proposal::where('uuid', $id)->withTrashed()->first();
            $evaluation = Evaluation::where('uuid', $id)->withTrashed()->first();
            $removeTrashed = TrashedRecord::where('uuid', $id)->first();

            if ($media) {
                $collect = CollectionMedia::where('media_id', $media->id)->first();
                $media->collection_name = $collect->collection_name;
                $media->save();
                $removeTrashed->delete();

            } elseif ($proposal) {
                // If the file exists in Proposal, restore it
                $proposal->restore();
                $removeTrashed->delete();

            } elseif ($evaluation) {
                // If the file exists in Proposal, restore it
                $evaluation->restore();
                $removeTrashed->delete();
            }
        }

        // Flash a success message
        return response()->json(['success' => 'Trashed Successfully']);

    }

    public function DeleteFile(Request $request){

        $ids = $request->ids;

        // Update each media item
        foreach ($ids as $id) {

            $media = Media::where('uuid', $id)->first();
            $proposal = Proposal::where('uuid', $id)->withTrashed()->first();
            $evaluation = Evaluation::where('uuid', $id)->withTrashed()->first();

            if ($media) {
                $collect = CollectionMedia::where('media_id', $media->id)->first();
                $collect->delete();
                $media->delete();

            } elseif ($proposal) {
                // If the file exists in Proposal, restore it
                $proposal->forceDelete();
            }
            elseif ($evaluation) {
                // If the file exists in Proposal, restore it
                $evaluation->forceDelete();
            }
        }

        // Flash a success message
        return response()->json(['success' => 'Deleted Successfully']);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\TrashedRecord;
use App\Models\CollectionMedia;
use App\Models\PermanenltyDelete;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $query->where('collection_name', 'trash');
       }])->orderBy('created_at', 'DESC')->distinct()->get();
       $trashedRecord = TrashedRecord::all();


        $mediaCollection = CollectionMedia::all();
        return view('user.trash.index', compact('trash', 'proposals','trashedRecord','mediaCollection'));
    }


    public function RestoreFileOrFolder(Request $request){

        $ids = $request->ids;

        // Update each media item
        foreach ($ids as $id) {

            $media = Media::where('uuid', $id)->first();
            $proposal = Proposal::where('uuid', $id)->withTrashed()->first();
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
            }
        }

        // Flash a success message
        return response()->json(['success' => 'Trashed Successfully']);

    }
    public function DeleteFileOrFolder(Request $request){

        $ids = $request->ids;

        // Update each media item
        foreach ($ids as $id) {

            $media = Media::where('uuid', $id)->first();
            $proposal = Proposal::where('uuid', $id)->withTrashed()->first();
            $removeTrashed = TrashedRecord::where('uuid', $id)->first();

            if($removeTrashed){
                $deleteRecord = new PermanenltyDelete();
                $deleteRecord->uuid = $removeTrashed->uuid;
                $deleteRecord->user_id = Auth()->user()->id;
                $deleteRecord->name = $removeTrashed->name;
                $deleteRecord->type = $removeTrashed->type;
                $deleteRecord->save();

                $removeTrashed->delete();
            }

            if ($media) {
                $collect = CollectionMedia::where('media_id', $media->id)->first();
                $collect->delete();
                $media->delete();


            } elseif ($proposal) {
                $proposal->forceDelete();
            }
        }

        // Flash a success message
        return response()->json(['success' => 'Deleted Successfully']);

    }
}


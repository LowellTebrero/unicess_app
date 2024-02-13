<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Proposal;
use App\Models\AdminYear;
use Illuminate\Http\Request;
use App\Models\ProposalFiles;
use App\Models\TrashedRecord;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\UserAttendance;
use App\Models\CollectionMedia;
use App\Models\NarrativeReport;
use App\Models\UserOfficeOrder;
use App\Models\UserTravelOrder;
use App\Models\UserSpecialOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomizeUserInventory;
use App\Models\UserAttendanceMonitoring;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Notifications\UserDeletedTheirProposaleNotification;
use App\Notifications\AdminDeletedProposaleFromUserNotification;

class InventoryController extends Controller
{
    public function index()
    {
        $myId = Auth::user()->id;
        $inventory = CustomizeUserInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $proposalyear = Proposal::select('created_at')->pluck('created_at');

        $proposals = Proposal::whereYear('created_at',  date('Y'))->with(['proposal_members' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])->orderBy('created_at', 'DESC')->with('programs')->distinct()->get();
        $proposalmember = ProposalMember::where('user_id', auth()->user()->id)->distinct('user_id')->get();


        return view('user.inventory.index', compact('inventory', 'years', 'myId', 'proposals', 'proposalmember'));
    }

    public function show($id, $notification){

        $proposals = Proposal::where('id', $id)->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')->orderBy('file_name', 'asc');
        }, 'programs'])
        ->first();

        $myfiles = Proposal::where('id', $id)->with(['medias' => function ($query) {
            $query->whereNot('collection_name', 'trash')
                  ->where('name', Auth()->user()->id)
                  ->orderBy('file_name', 'asc');
        }])->first();

        $uniqueProposalFiles = $proposals->medias->unique('collection_name');
        $myuniqueProposalFiles = $myfiles->medias->unique('collection_name');


        $formedia = Proposal::where('id', $id)
        ->with(['medias' => function ($query) {
        $query->whereNot('collection_name', 'trash')->select('collection_name', 'model_id', \DB::raw('MAX(created_at) as latest_created_at'))
        ->groupBy('model_id','collection_name')->orderBy('latest_created_at', 'desc')->pluck('collection_name', 'model_id');
        },])->first();

        $uniqueformedias = $formedia->medias->unique('collection_name');

        $members = User::orderBy('name')->whereNot('name', 'Administrator')->pluck('name', 'id')->prepend('Select Username', '');
        $inventory = CustomizeUserInventory::where('id', 2)->get();
        $proposal = Proposal::where('id', $id)->with('programs')->where('authorize', 'finished')->first();
        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->first();
        $program = Program::orderBy('program_name')->pluck('program_name', 'id')->prepend('Select Program', '');

        if($notification){
            auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        }

        $users = User::all();
        $otherFilePdfCount = Media::where('collection_name', 'otherFile')->count();
        $travelCount = Media::where('collection_name', 'travelOrderPdf')->count();
        $officeCount = Media::where('collection_name', 'officeOrderPdf')->count();
        $specialPdfCount = Media::where('collection_name', 'specialOrderPdf')->count();
        $attendancePdfCount = Media::where('collection_name', 'Attendance')->count();
        $attendancemPdfCount = Media::where('collection_name', 'AttendanceMonitoring')->count();
        $narrativePdfCount = Media::where('collection_name', 'NarrativeFile')->count();
        $terminalPdfCount = Media::where('collection_name', 'TerminalFile')->count();
        $mediaCount = Media::whereNot('collection_name','trash')->count();

        $existingTagIds  = $proposals->proposal_members()->pluck('user_id')->toArray();
        $existingTags = User::whereIn('id', $existingTagIds)->pluck('name', 'id')->toArray();

        return view('user.inventory.show', compact('proposals', 'proposal', 'proposal_member', 'inventory', 'program', 'members'
        ,'formedia','uniqueProposalFiles','uniqueformedias', 'myuniqueProposalFiles','myfiles','users','mediaCount'
        ,'otherFilePdfCount','travelCount','officeCount','specialPdfCount','attendancePdfCount','attendancemPdfCount',
        'narrativePdfCount','terminalPdfCount','existingTags'));

    }

    public function UpdateShowInventory(Request $request, $id)
    {
        $proposals = Proposal::where('id', $id)->first();

        $request->validate([
            'program_id' => 'required',
            'project_title' => 'required',
        ]);

        Proposal::where('id', $proposals->id)->update([

        'program_id' => $request->program_id,
        'project_title' => $request->project_title,
        'started_date' =>  $request->started_date,
        'finished_date' =>  $request->finished_date,
        ]);

        $existingTags  = $proposals->proposal_members()->pluck('user_id')->toArray();
        $newTags = $request->input('tags');

        // Find tags to add (new tags not in existing tags)
        $tagsToAdd = array_diff($newTags, $existingTags);
        // Find tags to remove (existing tags not in new tags)
        $tagsToRemove = array_diff($existingTags, $newTags);

        foreach ($tagsToAdd as $tag) {
            // Check if the tag already exists
            if (!ProposalMember::where('proposal_id', $proposals->id)->where('user_id', $tag)->exists()) {
                ProposalMember::create([
                    'proposal_id' => $proposals->id,
                    'user_id' => $tag,
                ]);
            }
        }

        // Remove tags
        ProposalMember::where('proposal_id', $proposals->id)
        ->whereIn('user_id', $tagsToRemove)
        ->delete();

        app('flasher')->addSuccess('Update successfully');
        return back();
    }

    // Universal User
    public function downloadProposalPdf($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('proposalPdf');
        return $pdf;
    }

    public function downloadsSpecialOrder($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('specialOrderPdf');
        return $pdf;
    }

    public function downloadsOffice($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('officeOrderPdf');
        return $pdf;
    }

    public function downloadsTravel($id)
    {
        $proposal = Proposal::findorFail($id);
        $pdf = $proposal->getFirstMedia('travelOrderPdf');
        return $pdf;
    }

    public function downloadsMoa($id)
    {
        $proposals = Proposal::findorFail($id);
        $moapdf = $proposals->getFirstMedia('MoaPDF');
        return $moapdf;
    }

    public function downloadsOther($id)
    {
        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('otherFile');
        return MediaStream::create($proposals->project_title.'-'.'otherFile.zip')->addMedia($downloads);
    }


    // Download by Zip
    public function downloadNarrative($id){

        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('NarrativeFile');
        return MediaStream::create($proposals->project_title.'-'.'NarrativeFile.zip')->addMedia($downloads);
    }

    public function downloadTerminal($id){

        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('TerminalFile');
        return MediaStream::create($proposals->project_title.'-'.'TerminalFile.zip')->addMedia($downloads);

    }

    public function downloadTravelorder($id){

        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('travelOrderPdf');
        return MediaStream::create($proposals->project_title.'-'.'travelOrderPdf.zip')->addMedia($downloads);
    }

    public function downloadSpecialorder($id){

        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('specialOrderPdf');
        return MediaStream::create($proposals->project_title.'-'.'specialOrderPdf.zip')->addMedia($downloads);
    }

    public function downloadOfficeorder($id){


        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('officeOrderPdf');
        return MediaStream::create($proposals->project_title.'-'.'officeOrderPdf.zip')->addMedia($downloads);
    }

    public function downloadAttendance($id){

        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('Attendance');
        return MediaStream::create($proposals->project_title.'-'.'Attendance.zip')->addMedia($downloads);
    }

    public function downloadAttendancem($id){

        $proposals = Proposal::findorFail($id);
        $downloads = $proposals->getMedia('AttendanceMonitoring');
        return MediaStream::create($proposals->project_title.'-'.'AttendanceMonitoring.zip')->addMedia($downloads);
    }

    // Download All
    public function download($id)
    {
        $proposals = Proposal::where('id', $id)->first();
        $download1 = Media::where('model_id',$proposals->id)->whereNot('collection_name', 'trash')->get();

        return MediaStream::create($proposals->project_title.'.zip')->addMedia($download1);
    }

    // Restore
    public function RestoreFile($id)
    {
        $media = Media::where('uuid', $id)->first();

        $proposal = Proposal::where('uuid', $id)->first();
        $removeTrashed = TrashedRecord::where('uuid', $id)->first();

        if ($media) {
            // If the file exists in Media, restore it and save
            $collect = CollectionMedia::where('media_id', $id)->first();
            $media->collection_name = $collect->collection_name;
            $media->save();
            $removeTrashed->delete();
        } elseif ($proposal) {
            // If the file exists in Proposal, restore it
            $proposal->restore();
            $removeTrashed->delete();
        } else {
            // Handle the case where the file does not exist in either model
            return back()->with('error', 'File not found');
        }

        return back()->with('message', 'Restored successfully');
    }

    // Trash
    public function MoveToTrash($id)
    {
        $media = Media::findOrFail($id);

        // Set the collection name to 'trash'
        $media->collection_name = 'trash';
        $media->save();

        $trashRecord = new TrashedRecord();
        $trashRecord->uuid = $media->uuid;
        $trashRecord->user_id = Auth()->user()->id;
        $trashRecord->save();


        flash()->addSuccess('Trashed Successfully');
        return back();
    }


    // Delete Media
    public function MoveToTrashMediaJson(Request $request)
    {
        $ids = $request->ids;

        // Update each media item
        foreach ($ids as $id) {
            $media = Media::findOrFail($id);
            $media->collection_name = 'trash';
            $media->save();

            $trashRecord = new TrashedRecord();
            $trashRecord->uuid = $media->uuid;
            $trashRecord->user_id = Auth()->user()->id;
            $trashRecord->save();

        }
        if ($media) {
            // Flash a success message
            return response()->json(['success' => 'Trashed Successfully']);
        } else {
            // Flash an error message
            return response()->json(['error' => 'Error Moving file'], 500);
        }

    }

     // Delete Media
    public function deleteMedias($id)
    {
        $media = Media::findOrFail($id);
        $collection = CollectionMedia::where('media_id', $id)->first();
        $media->delete();
        $collection->delete();

        return back()->with('message', 'Deleted successfully');

    }

    public function deleteMediasPermanently($id, $proposalId)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        $proposal = Proposal::withTrashed()->where('id', $proposalId)->first();

        // Check if the related NarrativeReport should be deleted
        if ($proposal->medias()->count() === 0) {

            $proposal->forceDelete();
            flash()->addSuccess('File and related data deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back()->with('message', 'Deleted successfully');

    }

    // Download
    public function DownloadMedias($id){
        $downloads = Media::where('id',$id)->first();
        return $downloads;
    }

    // Rename
    public function RenameFiles(Request $request, $id){
        Media::findorFail($id)->update(['file_name' => $request->file_name, ]);
        return back()->with('message', 'Status updated successfully');
    }


    public function userUpdateFiles(Request $request, $id){
        $request->validate([
            'proposal_pdf' => 'mimes:pdf',
            'moa_pdf' => 'mimes:pdf',
            'special_order_pdf' => "max:10048",
            'travel_order' => "max:10048",
            'office_order' => "max:10048",
            'attendance' => "max:10048",
            'attendancem' => "max:10048",
        ]);

       $proposals = Proposal::where('id', $id)->first();
       $project_title = $proposals->project_title;
       $proposals->update();

        if ($request->hasFile('proposal_pdf')) {

            $medias = $proposals->getMedia('trash')->where('name', 'proposal')->first();
            if ($medias) {
                $medias->delete();
            }
            $proposals->clearMediaCollection('proposalPdf');
            $media = $proposals->addMediaFromRequest('proposal_pdf')->usingName(auth()->id())->usingFileName($project_title.'_proposal.pdf')->toMediaCollection('proposalPdf');

            $collect = new CollectionMedia();
            $collect->media_id = $media->id ;
            $collect->proposal_id =  $proposals->id;
            $collect->user_id = auth()->id();
            $collect->collection_name = 'proposalPdf';
            $collect->save();

        }

        if ($request->hasFile('moa_pdf')) {

            $medias = $proposals->getMedia('trash')->where('name', 'moa')->first();
            if ($medias) {
                $medias->delete();
            }
            $proposals->clearMediaCollection('moaPdf');
            $media = $proposals->addMediaFromRequest('moa_pdf')->usingName(auth()->id())->usingFileName($project_title.'_moa.pdf')->toMediaCollection('moaPdf');

            $collect = new CollectionMedia();
            $collect->media_id = $media->id ;
            $collect->proposal_id =  $proposals->id;
            $collect->user_id = auth()->id();
            $collect->collection_name = 'moaPdf';
            $collect->save();
        }

        if ($specialorder = $request->file('special_order_pdf')) {

            foreach ($specialorder as $specials) {
               $media = $proposals->addMedia($specials)->usingName(auth()->id())->toMediaCollection('specialOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'specialOrderPdf';
                $collect->save();
            }
        }

        if ($travelorder = $request->file('travel_order_pdf')) {

            foreach ($travelorder as $travels) {
               $media = $proposals->addMedia($travels)->usingName(auth()->id())->toMediaCollection('travelOrderPdf');

               $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'travelOrderPdf';
                $collect->save();
            }
        }

        if ($officeorder = $request->file('office_order_pdf')) {

            foreach ($officeorder as $offices) {
               $media = $proposals->addMedia($offices)->usingName(auth()->id())->toMediaCollection('officeOrderPdf');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'officeOrderPdf';
                $collect->save();
            }
        }

        if ($attendance = $request->file('attendance')) {

            foreach ($attendance as $attends) {
               $media = $proposals->addMedia($attends)->usingName(auth()->id())->toMediaCollection('Attendance');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'Attendance';
                $collect->save();
            }
        }

        if ($attendancem = $request->file('attendancem')) {

            foreach ($attendancem as $attendm) {
               $media = $proposals->addMedia($attendm)->usingName(auth()->id())->toMediaCollection('AttendanceMonitoring');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'AttendanceMonitoring';
                $collect->save();
            }
        }

        if ($narrativereport = $request->file('narrative_report')) {

            foreach ($narrativereport as $narr) {
               $media = $proposals->addMedia($narr)->usingName(auth()->id())->toMediaCollection('NarrativeFile');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'NarrativeFile';
                $collect->save();
            }
        }

        if ($terminalreport = $request->file('terminal_report')) {

            foreach ($terminalreport as $term) {
               $media = $proposals->addMedia($term)->usingName(auth()->id())->toMediaCollection('TerminalFile');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'TerminalFile';
                $collect->save();
            }
        }

        if ($files = $request->file('other_files')) {
            foreach ($files as $file) {
               $media = $proposals->addMedia($file)->usingName(auth()->id())->toMediaCollection('otherFile');

                $collect = new CollectionMedia();
                $collect->media_id = $media->id ;
                $collect->proposal_id =  $proposals->id;
                $collect->user_id = auth()->id();
                $collect->collection_name = 'otherFile';
                $collect->save();
            }
        }

        $proposals->update();
        app('flasher')->addSuccess('Files successfully updated.');
        return back();

    }

    // Admin Inventory
    public function ShowFiles($id){
        $proposals = Proposal::where('id', $id)->with('medias')->with('programs')->first();
        $proposal = Proposal::where('id', $id)->with('programs')->where('authorize', 'finished')->first();
        $proposal_member = ProposalMember::where('user_id', auth()->user()->id)->first();
        return view('admin.inventory.show-inventory', compact('proposals', 'proposal', 'proposal_member'));
    }


    public function updateData(Request $request, $id){
        // Find the model instance you want to update
        $model = CustomizeUserInventory::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Update the model attributes based on the dropdown value
        $model->number = $request->input('selected_value');
        $model->save();

        return response()->json(['message' => 'Data updated successfully']);
    }

    public function filterInventoryYear(Request $request, $id){

        $inventory = CustomizeUserInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $myId = $id;
        $query = $request->input('query');

        $proposals = Proposal::with(['proposal_members' => function ($query) use ($myId) {
            $query->where('user_id', $myId);
            }])
            ->with('programs')
            ->when($query, function ($querys) use ($query) {
                return $querys->where('project_title', 'like', "%$query%");})
            ->where(function ($query) {
            if($Year = request('mydropdown')){
            $query->whereYear('created_at', $Year);
            }})
            ->orderBy('created_at', 'DESC')->distinct()->get();

        $data = [
            'proposals'  => $proposals,
            'inventory'  => $inventory,
            'years'  => $years,
            'myId'  => $myId,
        ];

        return view('user.inventory.index._filter_index' )->with($data);

    }

    public function search(Request $request, $id){
        $search = $request->input('query');
        $inventory = CustomizeUserInventory::where('id', 1)->get();
        $years = AdminYear::orderBy('year', 'DESC')->pluck('year');
        $myId = $id;



        $proposals = Proposal::with(['proposal_members' => function ($query) use ($myId) { $query->where('user_id', $myId);}])
        ->where(function ($query) {
            if($Year = request('selected_value')){
            $query->whereYear('created_at', $Year);
            }})->when($search, function ($querys) use ($search) {
                    return $querys->where('project_title', 'like', "%$search%");
            })->with('programs')->orderBy('created_at', 'DESC')->distinct()->get();

        $data = [
            'proposals'  => $proposals,
            'inventory'  => $inventory,
            'years'  => $years,
            'myId'  => $myId,
        ];

        return view('user.inventory.index._filter_index' )->with($data);
    }

    public function downloadsMedia(Media $id){
        return response()->download($id->getPath(), $id->file_name);
    }

    public function updateShowData(Request $request, $id){
        // Find the model instance you want to update
        $model = CustomizeUserInventory::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Update the model attributes based on the dropdown value
        $model->number = $request->input('selected_value');
        $model->save();

        return response()->json(['message' => 'Data updated successfully']);
    }

    public function UserDeleteInventoryProposal($id){

        // $proposal = Proposal::findorFail($id);
        $proposal = Proposal::with(['medias' => function ($mediaQuery) {
            $mediaQuery->whereNot('collection_name', 'trash');
        }])
        ->orderBy('created_at', 'DESC')
        ->distinct()
        ->first();

        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        foreach ($admin as $adminUser) {
            $adminUser->notify(new AdminDeletedProposaleFromUserNotification($proposal));
        }

        // Notify Users
        foreach($proposal->proposal_members as $member){

            $users = User::where('id', $member->user_id )->get();
            foreach($users as $user){
                $user->notify(new UserDeletedTheirProposaleNotification($proposal));
            }

        }

       $notifications = DB::table('notifications')->get();

       foreach ($notifications as $notification) {
            // Decode the JSON string into an array
            $data = json_decode($notification->data, true);

            // Check if the data array has an 'id' matching the one you want to delete
            if (is_array($data) && array_key_exists('id', $data) && $data['id'] == $id) {
            // Delete the notification

                DB::table('notifications')->where('id', $notification->id)->delete();
            }
            // Check if the data array has an 'id' matching the one you want to delete
            if (is_array($data) && array_key_exists('proposal_id', $data) && $data['proposal_id'] == $id) {
            // Delete the notification

                DB::table('notifications')->where('id', $notification->id)->delete();
            }
        }

        $trashRecord = new TrashedRecord();
        $trashRecord->uuid = $proposal->uuid;
        $trashRecord->user_id = Auth()->user()->id;
        $trashRecord->save();

        $proposal->delete();



        app('flasher')->addSuccess('Proposal Delete successfully');

        return redirect(route('inventory.index'));
    }


    public function TrashFolderMediaJS(Request $request){


        $ids = $request->ids;

        foreach ($ids as $id) {

            $find = Media::where('uuid', $id)->first();
            $trashCollection = Media::where('collection_name', $find->collection_name)->get();

            foreach($trashCollection as $trashCollect){

                $trashCollect->collection_name = 'trash';
                $trashCollect->save();

                $trashRecord = new TrashedRecord();
                $trashRecord->uuid = $trashCollect->uuid;
                $trashRecord->user_id = Auth()->user()->id;
                $trashRecord->save();
            }

        }

        if ($find) {
            // Flash a success message
            return response()->json(['success' => 'Trashed Successfully']);
        } else {
            // Flash an error message
            return response()->json(['error' => 'Error Moving file'], 500);
        }








    }

}

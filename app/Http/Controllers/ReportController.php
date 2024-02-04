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
        ->with(['proposalfiles' => function ($query) {
        $query->with(['medias' => function ($mediaQuery) {
            $mediaQuery->whereNot('collection_name', 'trash');
        }])->where('user_id', auth()->user()->id)->whereNull('deleted_at'); }])

        ->orderBy('created_at', 'DESC')->whereYear('created_at', date('Y'))->distinct('proposal_id')->get();

        // dd($proposals);
        return view('user.report.index', compact('proposalMembers', 'proposals'));
    }


    public function RestoreProjectFolder($id){
        $proposal = Proposal::withTrashed()->where('id', $id)->first();

        if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
            $proposal->restore(); // Restore the soft-deleted model
        }

        $NarrativeReports = NarrativeReport::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($NarrativeReports && $NarrativeReports->trashed()){
            $NarrativeReports->restore();
        }


        $TerminalReport = TerminalReport::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($TerminalReport && $TerminalReport->trashed()){
            $TerminalReport->restore();
        }

        $UserTravelOrder = UserTravelOrder::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($UserTravelOrder && $UserTravelOrder->trashed()){
            $UserTravelOrder->restore();
        }


        $UserOfficeOrder = UserOfficeOrder::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($UserOfficeOrder && $UserOfficeOrder->trashed()){
            $UserOfficeOrder->restore();
        }

        $UserSpecialOrder = UserSpecialOrder::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($UserSpecialOrder && $UserSpecialOrder->trashed()){
            $UserSpecialOrder->restore();
        }

        $UserAttendance = UserAttendance::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($UserAttendance && $UserAttendance->trashed()){
            $UserAttendance->restore();
        }

        $UserAttendanceMonitoring = UserAttendanceMonitoring::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($UserAttendanceMonitoring && $UserAttendanceMonitoring->trashed()){
            $UserAttendanceMonitoring->restore();
        }

        flash()->addSuccess('Project restored successfully.');
        return back();
    }

    public function DeleteProjectFolder($id){
        $proposal = Proposal::where('id', $id)->withTrashed()->first();


        $proposalfiles = ProposalFiles::withTrashed()->where('proposal_id', $proposal->id)->first();
        if($proposalfiles && $proposalfiles->trashed()){
            $proposalfiles->forceDelete();
        }

        if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
            $proposal->forceDelete(); // Restore the soft-deleted model
        }

        flash()->addSuccess('Project deleted permanently.');
        return back();
    }

    // NarrativeStore
    public function NarrativeStore(Request $request){

        $request->validate([
            'narrative_file' => "required|max:10048",
        ]);

        $post = new ProposalFiles();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;
        $post->document_type =  'narrativereport';

        // Check if there's an existing UserTravelOrder with trashed records
        $existingNarrative = ProposalFiles::withTrashed()
        ->where('user_id', auth()->id())
        ->where('proposal_id', $request->proposal_id)->where('document_type', 'narrativereport')
        ->first();

        if ($existingNarrative) {
            // If existing record is soft-deleted, restore it
            if ($existingNarrative->trashed()) {
                $existingNarrative->restore();
            }
            // Use existing UserTravelOrder
            $post = $existingNarrative;
        }


        if ($narratives = $request->file('narrative_file')) {
            foreach ($narratives as $narrative) {
                $post->addMedia($narrative)->usingName('narrative')->toMediaCollection('NarrativeFile');
            }
        }

        $post->save();

        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        Notification::send($admin, new NarrativeNotification($post));

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }
    // TrashNarrative
    public function TrashNarrativeMedias($id, $narrativeId){

        $narrativeReport = ProposalFiles::findOrFail($narrativeId);
        $media = Media::findOrFail($id);
        $media->collection_name = 'trash';
        $media->save();

        if ($narrativeReport->medias()->where('collection_name', '!=', 'trash')->count() === 0) {
            $narrativeReport->delete();
            flash()->addSuccess('File and related Narrative Report deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // RestoreNarrativeMedias
    public function RestoreNarrativeMedias($id){
        $media = Media::findOrFail($id);
        $narrative = ProposalFiles::withTrashed()->where('id', $media->model_id)->first();
        // $proposal = Proposal::withTrashed()->where('id', $narrative->proposal_id)->first();
        $media->collection_name = 'NarrativeFile';


        if($narrative && $narrative->trashed()){ // Check if the model is soft-deleted
            $narrative->restore(); // Restore the soft-deleted model
        }
        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }
        $media->save();



        flash()->addSuccess('File Restored successfully.');
        return back();
    }
    // deleteNarrativeMedias
    public function deleteNarrativeMedias($id, $narrativeId){

        $media = Media::findOrFail($id);
        $media->delete();
        // $travelOrder = UserTravelOrder::findOrFail($travelOrderId);
        $narrative = ProposalFiles::withTrashed()->where('id', $narrativeId)->first();

        // Check if the related NarrativeReport should be deleted
        if ($narrative->medias()->count() === 0) {

            $narrative->forceDelete();
            flash()->addSuccess('File and related Travel Order deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // NarrativeUpdate
    public function NarrativeUpdate(Request $request, $id){

        $request->validate([
            'narrative_file' => "required|max:10048",
           ]);

        $post = ProposalFiles::where('id', $id)->first();

        if ($narratives = $request->file('narrative_file')) {
            foreach ($narratives as $narrative) {
                $post->addMedia($narrative)->usingName('narrative')->toMediaCollection('NarrativeFile');
            }
        }

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }



    // TerminalStore
    public function TerminalStore(Request $request){

        $request->validate([
            'terminal_file' => "required|max:10048",
           ]);

        $post = new ProposalFiles();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;
        $post->document_type =  'terminalreport';

         // Check if there's an existing UserTravelOrder with trashed records
         $existingTerminal = ProposalFiles::withTrashed()
         ->where('user_id', auth()->id())
         ->where('proposal_id', $request->proposal_id)->with('document_type', 'terminalreport')
         ->first();

         if ($existingTerminal) {
             // If existing record is soft-deleted, restore it
             if ($existingTerminal->trashed()) {
                 $existingTerminal->restore();
             }
             // Use existing UserTravelOrder
             $post = $existingTerminal;
         }

        if ($terminals = $request->file('terminal_file')) {
            foreach ($terminals as $terminal) {
                $post->addMedia($terminal)->usingName('terminal')->toMediaCollection('TerminalFile');
            }
        }

        $post->save();

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }
    // TrashTerminaMedias
    public function TrashTerminaMedias($id, $terminalId){

        $terminalreport = ProposalFiles::findOrFail($terminalId);
        $media = Media::findOrFail($id);
        $media->collection_name = 'trash';
        $media->save();

        if ($terminalreport->medias()->where('collection_name', '!=', 'trash')->count() === 0) {
            $terminalreport->delete();
            flash()->addSuccess('File and related Terminal Report deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // RestoreTerminalMedias
    public function RestoreTerminalMedias($id, $terminalId){

        $media = Media::findOrFail($id);
        $terminal = ProposalFiles::withTrashed()->where('id',$terminalId)->first();
        // $proposal = Proposal::withTrashed()->where('id', $terminal->proposal_id)->first();
        $media->collection_name = 'TerminalFile';


        if($terminal && $terminal->trashed()){ // Check if the model is soft-deleted
            $terminal->restore(); // Restore the soft-deleted model
        }
        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }
        $media->save();

        flash()->addSuccess('File Restored successfully.');
        return back();
    }
    // deleteTerminalMedias
    public function deleteTerminalMedias($id, $terminalId){

        $media = Media::findOrFail($id);
        $media->delete();
        // $travelOrder = UserTravelOrder::findOrFail($travelOrderId);
        $terminal = ProposalFiles::withTrashed()->where('id', $terminalId)->first();

        // Check if the related TerminalReport should be deleted
        if ($terminal->medias()->count() === 0) {

            $terminal->forceDelete();
            flash()->addSuccess('File and related Terminal Report deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // TerminalUpdate
    public function TerminalUpdate(Request $request, $id){

        $request->validate([
            'terminal_file' => "required|max:10048",
           ]);

        $post = ProposalFiles::where('id', $id)->first();

        if ($terminals = $request->file('terminal_file')) {
            foreach ($terminals as $terminal) {
                $post->addMedia($terminal)->usingName('terminal')->toMediaCollection('TerminalFile');
            }
        }

        flash()->addSuccess('Project Uploaded Successfully.');
        return back();
    }


    // travelOrderStore
    public function travelOrderStore(Request $request){

        $request->validate([
            'travelorder_file' => "required|max:10048",
        ]);

        $post = new ProposalFiles();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;
        $post->document_type =  'travelorder';

        // Check if there's an existing UserTravelOrder with trashed records
        $existingTravelOrder = ProposalFiles::withTrashed()
        ->where('user_id', auth()->id())
        ->where('proposal_id', $request->proposal_id)
        ->where('document_type', 'travelorder')
        ->first();

        if ($existingTravelOrder) {
            // If existing record is soft-deleted, restore it
            if ($existingTravelOrder->trashed()) {
                $existingTravelOrder->restore();
            }
            // Use existing UserTravelOrder
            $post = $existingTravelOrder;
        }

        if ($travelorder = $request->file('travelorder_file')) {
            foreach ($travelorder as $travel) {
                $post->addMedia($travel)->usingName('travel_order')->toMediaCollection('travelOrderPdf');
            }
        }

        $post->save();

        // $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        // Notification::send($admin, new NarrativeNotification($post));

        flash()->addSuccess('Travel Order Uploaded Successfully.');
        return back();
    }
    // TrashTravelOrderMedias
    public function TrashTravelOrderMedias($id, $travelOrderId){

        $travelOrder = ProposalFiles::findOrFail($travelOrderId);
        $media = Media::findOrFail($id);
        $media->collection_name = 'trash';
        $media->save();

        if ($travelOrder->medias()->where('collection_name', '!=', 'trash')->count() === 0) {
            $travelOrder->delete();
            flash()->addSuccess('File and related Travel Order deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // RestoreTravelOrderMedias
    public function RestoreTravelOrderMedias($id){
        $media = Media::findOrFail($id);
        $travelorder = ProposalFiles::withTrashed()->where('id', $media->model_id)->first();
        // $proposal = Proposal::withTrashed()->where('id', $travelorder->proposal_id)->first();
        $media->collection_name = 'travelOrderPdf';


        if($travelorder && $travelorder->trashed()){ // Check if the model is soft-deleted
            $travelorder->restore(); // Restore the soft-deleted model
        }
        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }
        $media->save();

        flash()->addSuccess('File deleted successfully.');
        return back();
    }
    // deleteTravelOrderMedias
    public function deleteTravelOrderMedias($id, $travelOrderId){

        $media = Media::findOrFail($id);
        $media->delete();
        // $travelOrder = UserTravelOrder::findOrFail($travelOrderId);
        $travelOrder = ProposalFiles::withTrashed()->where('id', $travelOrderId)->first();

        // Check if the related NarrativeReport should be deleted
        if ($travelOrder->medias()->count() === 0) {

            $travelOrder->forceDelete();
            flash()->addSuccess('File and related Travel Order deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // TravelOrderUpdate
    public function TravelOrderUpdate(Request $request, $id){

        $request->validate([
            'travelorder_file' => "required|max:10048",
        ]);

        $post = ProposalFiles::where('id', $id)->first();

        if ($travelorder = $request->file('travelorder_file')) {
            foreach ($travelorder as $travel) {
                $post->addMedia($travel)->usingName('travel_order')->toMediaCollection('travelOrderPdf');
            }
        }

        flash()->addSuccess('Travel Order Uploaded Successfully.');
        return back();
    }




    // specialOrderStore
    public function specialOrderStore(Request $request){

        $request->validate([
            'specialorder_file' => "required|max:10048",
        ]);

        $post = new ProposalFiles();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;
        $post->document_type  = 'travelorder';

         // Check if there's an existing UserTravelOrder with trashed records
         $existingSpecialOrder = ProposalFiles::withTrashed()
         ->where('user_id', auth()->id())
         ->where('proposal_id', $request->proposal_id)
         ->where('document_type', 'specialorder')
         ->first();

         if ($existingSpecialOrder) {
             // If existing record is soft-deleted, restore it
             if ($existingSpecialOrder->trashed()) {
                 $existingSpecialOrder->restore();
             }
             // Use existing UserTravelOrder
             $post = $existingSpecialOrder;
         }

        if ($specialorder = $request->file('specialorder_file')) {
            foreach ($specialorder as $special) {
                $post->addMedia($special)->usingName('special_order')->toMediaCollection('specialOrderPdf');
            }
        }

        $post->save();

        // $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        // Notification::send($admin, new NarrativeNotification($post));

        flash()->addSuccess('Special Order Uploaded Successfully.');
        return back();
    }
     // TrashSpecialOrderMedias
     public function TrashSpecialOrderMedias($id, $specialOrderId){

        $specialOrder = ProposalFiles::findOrFail($specialOrderId);
        $media = Media::findOrFail($id);
        $media->collection_name = 'trash';
        $media->save();

        if ($specialOrder->medias()->where('collection_name', '!=', 'trash')->count() === 0) {
            $specialOrder->delete();
            flash()->addSuccess('File and related Special Order deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // RestoreSpecialOrderMedias
    public function RestoreSpecialOrderMedias($id){
        $media = Media::findOrFail($id);
        $specialorder = ProposalFiles::withTrashed()->where('id', $media->model_id)->first();
        // $proposal = Proposal::withTrashed()->where('id', $specialorder->proposal_id)->first();
        $media->collection_name = 'specialOrderPdf';

        if($specialorder && $specialorder->trashed()){ // Check if the model is soft-deleted
            $specialorder->restore(); // Restore the soft-deleted model
        }
        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }
        $media->save();

        flash()->addSuccess('File deleted successfully.');
        return back();
    }
    // deleteSpecialOrderMedias
    public function deleteSpecialOrderMedias($id, $specialOrderId){

        $media = Media::findOrFail($id);
        $media->delete();
        // $specialOrder = UserspecialOrder::findOrFail($specialOrderId);
        $specialOrder = ProposalFiles::withTrashed()->where('id', $specialOrderId)->first();

        // Check if the related NarrativeReport should be deleted
        if ($specialOrder->medias()->count() === 0) {

            $specialOrder->forceDelete();
            flash()->addSuccess('File and related Special Order deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // specialOrderUpdate
    public function specialOrderUpdate(Request $request, $id){

        $request->validate([
            'specialorder_file' => "required|max:10048",
           ]);

        $post = ProposalFiles::where('id', $id)->first();

        if ($specialorder = $request->file('specialorder_file')) {
            foreach ($specialorder as $special) {
                $post->addMedia($special)->usingName('special_order')->toMediaCollection('specialOrderPdf');
            }
        }

        flash()->addSuccess('Special Order Uploaded Successfully.');
        return back();
    }



    // officeOrderStore
    public function officeOrderStore(Request $request){

        $request->validate([
            'officeorder_file' => "required|max:10048",
        ]);

        $post = new ProposalFiles();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;
        $post->document_type = 'travelorder';

          // Check if there's an existing UserTravelOrder with trashed records
          $existingOfficeOrder = ProposalFiles::withTrashed()
          ->where('user_id', auth()->id())
          ->where('proposal_id', $request->proposal_id)
          ->where('document_type', 'officeorder')
          ->first();

          if ($existingOfficeOrder) {
              // If existing record is soft-deleted, restore it
              if ($existingOfficeOrder->trashed()) {
                  $existingOfficeOrder->restore();
              }
              // Use existing UserTravelOrder
              $post = $existingOfficeOrder;
          }


        if ($officeorder = $request->file('officeorder_file')) {
            foreach ($officeorder as $office) {
                $post->addMedia($office)->usingName('office_order_pdf')->toMediaCollection('officeOrderPdf');
            }
        }

        $post->save();

        // $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        // Notification::send($admin, new NarrativeNotification($post));

        flash()->addSuccess('Office Order Uploaded Successfully.');
        return back();
    }

    // TrashOfficeOrderMedias
    public function TrashOfficeOrderMedias($id, $officeOrderId){

        $officeorder = ProposalFiles::findOrFail($officeOrderId);
        $media = Media::findOrFail($id);
        $media->collection_name = 'trash';
        $media->save();

        if ($officeorder->medias()->where('collection_name', '!=', 'trash')->count() === 0) {
            $officeorder->delete();
            flash()->addSuccess('File and related Office Order deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }

    // RestoreOfficeOrderMedias
    public function RestoreOfficeOrderMedias($id){
        $media = Media::findOrFail($id);
        $officeorder = ProposalFiles::withTrashed()->where('id', $media->model_id)->first();
        // $proposal = Proposal::withTrashed()->where('id', $officeorder->proposal_id)->first();
        $media->collection_name = 'officeOrderPdf';

        if($officeorder && $officeorder->trashed()){ // Check if the model is soft-deleted
            $officeorder->restore(); // Restore the soft-deleted model
        }
        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }
        $media->save();

        flash()->addSuccess('File deleted successfully.');
        return back();
    }
    // deleteOfficeOrderMedias
    public function deleteOfficeOrderMedias($id, $officeOrderId){

        $media = Media::findOrFail($id);
        $media->delete();
        // $officeorder = UserOfficeOrder::findOrFail($officeorderId);
        $officeorder = ProposalFiles::withTrashed()->where('id', $officeOrderId)->first();

        // Check if the related NarrativeReport should be deleted
        if ($officeorder->medias()->count() === 0) {

            $officeorder->forceDelete();
            flash()->addSuccess('File and related Special Order deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // officeOrderUpdate
    public function officeOrderUpdate(Request $request, $id){

        $request->validate([
            'officeorder_file' => "required|max:10048",
           ]);

        $post = ProposalFiles::where('id', $id)->where('user_id', Auth()->user()->id)->where('document_type', 'officeorder')->first();

        if ($officeorder = $request->file('officeorder_file')) {
            foreach ($officeorder as $office) {
                $post->addMedia($office)->usingName('office_order_pdf')->toMediaCollection('officeOrderPdf');
            }
        }

        flash()->addSuccess('Office Order Uploaded Successfully.');
        return back();
    }




    // attendanceStore
    public function attendanceStore(Request $request){

        $request->validate([
            'attendance_file' => "required|max:10048",
        ]);

        $post = new ProposalFiles();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

        $existingAttendance = ProposalFiles::withTrashed()
        ->where('user_id', auth()->id())
        ->where('proposal_id', $request->proposal_id)
        ->where('document_type', 'attendance')
        ->first();

        if ($existingAttendance) {
            // If existing record is soft-deleted, restore it
            if ($existingAttendance->trashed()) {
                $existingAttendance->restore();
            }
            // Use existing UserTravelOrder
            $post = $existingAttendance;
        }

        if ($attendance = $request->file('attendance_file')) {
            foreach ($attendance as $office) {
                $post->addMedia($office)->usingName('attendance')->toMediaCollection('Attendance');
            }
        }

        $post->save();

        // $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();
        // Notification::send($admin, new NarrativeNotification($post));
        flash()->addSuccess('Attendance Uploaded Successfully.');
        return back();
    }
    // TrashAttendanceMedias
    public function TrashAttendanceMedias($id, $attendanceId){

        $attendance = ProposalFiles::findOrFail($attendanceId);
        $media = Media::findOrFail($id);
        $media->collection_name = 'trash';
        $media->save();

        if ($attendance->medias()->where('collection_name', '!=', 'trash')->count() === 0) {
            $attendance->delete();
            flash()->addSuccess('File and related Attendance deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // RestoreAttendanceMedias
    public function RestoreAttendanceMedias($id){
        $media = Media::findOrFail($id);
        $attendance = ProposalFiles::withTrashed()->where('id', $media->model_id)->first();
        // $proposal = Proposal::withTrashed()->where('id', $attendance->proposal_id)->first();
        $media->collection_name = 'Attendance';

        if($attendance && $attendance->trashed()){ // Check if the model is soft-deleted
            $attendance->restore(); // Restore the soft-deleted model
        }
        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }
        $media->save();

        flash()->addSuccess('File deleted successfully.');
        return back();
    }
    // deleteAttendanceMedias
    public function deleteAttendanceMedias($id, $attendanceId){

        $media = Media::findOrFail($id);
        $media->delete();
        // $attendance = UserAttendance::findOrFail($attendanceId);
        $attendance = ProposalFiles::withTrashed()->where('id', $attendanceId)->first();

        // Check if the related NarrativeReport should be deleted
        if ($attendance->medias()->count() === 0) {

            $attendance->forceDelete();
            flash()->addSuccess('File and related Attendance deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // attendanceUpdate
    public function attendanceUpdate(Request $request, $id){

        $request->validate([
            'attendance_file' => "required|max:10048",
           ]);

        $post = ProposalFiles::where('id', $id)->first();

        if ($attendance = $request->file('attendance_file')) {
            foreach ($attendance as $att) {
                $post->addMedia($att)->usingName('attendance')->toMediaCollection('Attendance');
            }
        }

        flash()->addSuccess('Attendance Uploaded Successfully.');
        return back();
    }




    // attendancemStore
    public function attendancemStore(Request $request){

        $request->validate([
            'attendancem_file' => "required|max:10048",
        ]);

        $post = new ProposalFiles();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;
        $post->document_type =  'attendancem';


        $existingAttendancem = ProposalFiles::withTrashed()
        ->where('user_id', auth()->id())
        ->where('proposal_id', $request->proposal_id)
        ->where('document_type', 'attendancem')
        ->first();

        if ($existingAttendancem) {
            // If existing record is soft-deleted, restore it
            if ($existingAttendancem->trashed()) {
                $existingAttendancem->restore();
            }
            // Use existing UserTravelOrder
            $post = $existingAttendancem;
        }

        if ($attendancem = $request->file('attendancem_file')) {
            foreach ($attendancem as $attendm) {
                $post->addMedia($attendm)->usingName('attendancemonitoring')->toMediaCollection('AttendanceMonitoring');
            }
        }

        $post->save();

        // $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();
        // Notification::send($admin, new NarrativeNotification($post));
        flash()->addSuccess('Attendance Monitoring Uploaded Successfully.');
        return back();
    }
    // TrashAttendanceMonitoringMedias
    public function TrashAttendancemMedias($id, $attendancemId){

        $attendancem = ProposalFiles::findOrFail($attendancemId);
        $media = Media::findOrFail($id);
        $media->collection_name = 'trash';
        $media->save();

        if ($attendancem->medias()->where('collection_name', '!=', 'trash')->count() === 0) {
            $attendancem->delete();
            flash()->addSuccess('File and related Attendance Monitoring deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // RestoreAttendanceMonitoringMedias
    public function RestoreAttendancemMedias($id){
        $media = Media::findOrFail($id);
        $attendancem = ProposalFiles::withTrashed()->where('id', $media->model_id)->first();
        // $proposal = Proposal::withTrashed()->where('id', $attendancem->proposal_id)->first();
        $media->collection_name = 'AttendanceMonitoring';

        if($attendancem && $attendancem->trashed()){ // Check if the model is soft-deleted
            $attendancem->restore(); // Restore the soft-deleted model
        }
        // if($proposal && $proposal->trashed()){ // Check if the model is soft-deleted
        //     $proposal->restore(); // Restore the soft-deleted model
        // }
        $media->save();

        flash()->addSuccess('File deleted successfully.');
        return back();
    }
    // deleteAttendanceMonitoringMedias
    public function deleteAttendancemMedias($id, $attendancemId){

        $media = Media::findOrFail($id);
        $media->delete();
        // $attendance = UserAttendanceMonitoring::findOrFail($attendanceId);
        $attendancem = ProposalFiles::withTrashed()->where('id', $attendancemId)->first();


        // Check if the related NarrativeReport should be deleted
        if ($attendancem->medias()->count() === 0) {

            $attendancem->forceDelete();
            flash()->addSuccess('File and related Attendance Monitoring deleted successfully.');
        } else {

            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // attendancemUpdate
    public function attendancemUpdate(Request $request, $id){

        $request->validate([
            'attendancem_file' => "required|max:10048",
           ]);

        $post = ProposalFiles::where('id', $id)->first();

        if ($attendancem = $request->file('attendancem_file')) {
            foreach ($attendancem as $attm) {
                $post->addMedia($attm)->usingName('attendancemonitoring')->toMediaCollection('AttendanceMonitoring');
            }
        }

        flash()->addSuccess('Attendance Monitoring Uploaded Successfully.');
        return back();
    }

}

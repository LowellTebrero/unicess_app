<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Http\Request;
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
        ->with(['narrativereport' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])
        ->with(['terminalreport' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])
        ->with(['attendance' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])
        ->with(['attendancemonitoring' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])
        ->with(['travelorder' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])
        ->with(['specialorder' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])
        ->with(['officeorder' => function ($query) {
            $query->where('user_id', auth()->user()->id)->distinct();
        }])
        ->orderBy('created_at', 'DESC')->whereYear('created_at', date('Y'))->get();


        return view('user.report.index', compact('proposalMembers', 'proposals'));
    }

    // Store
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

        $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        Notification::send($admin, new NarrativeNotification($post));

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
    // Update
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

    // TerminalStore
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
    // TerminalUpdate
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
    // deleteTerminalMedias
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

    // travelOrderStore
    public function travelOrderStore(Request $request){

        $request->validate([
            'travelorder_file' => "required|max:10048",
        ]);

        $post = new UserTravelOrder();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

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
    // deleteTravelOrderMedias
    public function deleteTravelOrderMedias($id, $travelOrderId){
        $media = Media::findOrFail($id);
        $travelOrder = UserTravelOrder::findOrFail($travelOrderId);
        $media->delete();

        // Check if the related NarrativeReport should be deleted
        if ($travelOrder->medias()->count() === 0) {
            $travelOrder->delete();
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

        $post = UserTravelOrder::where('id', $id)->first();

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

        $post = new UserSpecialOrder();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

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
    // deleteSpecialOrderMedias
    public function deleteSpecialOrderMedias($id, $specialOrderId)
    {
        $media = Media::findOrFail($id);
        $specialOrder = UserSpecialOrder::findOrFail($specialOrderId);
        $media->delete();

        // Check if the related NarrativeReport should be deleted
        if ($specialOrder->medias()->count() === 0) {
            $specialOrder->delete();
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

        $post = UserSpecialOrder::where('id', $id)->first();

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

        $post = new UserOfficeOrder();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

        if ($officeorder = $request->file('officeorder_file')) {
            foreach ($officeorder as $office) {
                $post->addMedia($office)->usingName('office_order')->toMediaCollection('officeOrderPdf');
            }
        }

        $post->save();

        // $admin = User::whereHas('roles', function ($query) { $query->where('id', 1);})->get();

        // Notification::send($admin, new NarrativeNotification($post));

        flash()->addSuccess('Office Order Uploaded Successfully.');
        return back();
    }
    // deleteofficeOrderMedias
    public function deleteOfficeOrderMedias($id, $officeOrderId)
    {
        $media = Media::findOrFail($id);
        $officeOrder = UserOfficeOrder::findOrFail($officeOrderId);
        $media->delete();

        // Check if the related NarrativeReport should be deleted
        if ($officeOrder->medias()->count() === 0) {
            $officeOrder->delete();
            flash()->addSuccess('File and related office Order deleted successfully.');
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

        $post = UserOfficeOrder::where('id', $id)->first();

        if ($officeorder = $request->file('officeorder_file')) {
            foreach ($officeorder as $office) {
                $post->addMedia($office)->usingName('office_order')->toMediaCollection('officeOrderPdf');
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

        $post = new UserAttendance();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

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
    // deleteattendanceMedias
    public function deleteAttendanceMedias($id, $attendanceId)
    {
        $media = Media::findOrFail($id);
        $attendance = UserAttendance::findOrFail($attendanceId);
        $media->delete();

        // Check if the related NarrativeReport should be deleted
        if ($attendance->medias()->count() === 0) {
            $attendance->delete();
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

        $post = UserAttendance::where('id', $id)->first();

        if ($attendance = $request->file('attendance_file')) {
            foreach ($attendance as $att) {
                $post->addMedia($att)->usingName('attendance')->toMediaCollection('Attendance');
            }
        }

        flash()->addSuccess('Attendance Uploaded Successfully.');
        return back();
    }

    // attendanceStore
    public function attendancemStore(Request $request){

        $request->validate([
            'attendancem_file' => "required|max:10048",
        ]);

        $post = new UserAttendanceMonitoring();
        $post->user_id  = auth()->id();
        $post->proposal_id =  $request->proposal_id;

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
    // deleteattendanceMedias
    public function deleteAttendancemMedias($id, $attendancemId)
    {
        $media = Media::findOrFail($id);
        $attendancem = UserAttendanceMonitoring::findOrFail($attendancemId);
        $media->delete();

        // Check if the related NarrativeReport should be deleted
        if ($attendancem->medias()->count() === 0) {
            $attendancem->delete();
            flash()->addSuccess('File and related Attendance Monitoring deleted successfully.');
        } else {
            flash()->addSuccess('File deleted successfully.');
        }

        return back();
    }
    // attendanceUpdate
    public function attendancemUpdate(Request $request, $id){

        $request->validate([
            'attendancem_file' => "required|max:10048",
           ]);

        $post = UserAttendanceMonitoring::where('id', $id)->first();

        if ($attendancem = $request->file('attendancem_file')) {
            foreach ($attendancem as $attm) {
                $post->addMedia($attm)->usingName('attendancemonitoring')->toMediaCollection('AttendanceMonitoring');
            }
        }

        flash()->addSuccess('Attendance Monitoring Uploaded Successfully.');
        return back();
    }

}

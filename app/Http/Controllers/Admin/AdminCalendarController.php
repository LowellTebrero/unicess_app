<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminCalendar;
use App\Http\Controllers\Controller;

class AdminCalendarController extends Controller
{
    public function index()
    {
        $events = [];
        $appointments  = AdminCalendar::all();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->title,
                'description' => $appointment->description,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }
        return view('admin.calendar.index', compact('events', 'appointments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        AdminCalendar::create($data);

        flash()->addSuccess('Data Uploded Successfully.');
        return redirect()->route('admin.calendar.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => 'required',
            'description' => 'required',
        ]);

        AdminCalendar::where('id', $id)->update([

            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        flash()->addSuccess('Data Updated Successfully.');
        return back();
    }

    public function delete($id){

        $data = AdminCalendar::find($id);
        $data->delete();

        flash()->addSuccess('Delete Successfully.');
        return back();
    }
}

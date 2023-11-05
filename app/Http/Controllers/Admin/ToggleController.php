<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluationStatus;
use Illuminate\Http\Request;

class ToggleController extends Controller
{
    public function edit($id){

        $record = EvaluationStatus::findorFail($id);

        return view('admin.toggle.edit', compact('record'));

        // dd($record);
    }

    public function update(Request $request, $id)
    {
        // Find the record in the database
        $record = EvaluationStatus::findOrFail($id);

        // Toggle the data in the table based on the current state
        $record->update([
            'status' => $request->input('state') ? 'checked' : 'close',
        ]);

        return response()->json(['success' => true]);


    }


}

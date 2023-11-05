<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class UpdatePendingProposalController extends Controller
{
    public function updateData(Request $request, $id){
    // Find the model instance you want to update


    $model = Proposal::find($id);



    if (!$model) {
        return response()->json(['message' => 'Model not found'], 404);
    }

    // Update the model attributes based on the dropdown value
    $model->authorize = $request->input('selected_value');
    $model->save();

    return response()->json(['message' => 'Data updated successfully']);
    }
}

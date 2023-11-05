<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomizeUserAllProposal;

class CustomizeUsersAllProposalController extends Controller
{
    public function updateData(Request $request, $id){
        // Find the model instance you want to update
        $model = CustomizeUserAllProposal::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Update the model attributes based on the dropdown value
        $model->number = $request->input('selected_value');
        $model->save();

        return response()->json(['message' => 'Data updated successfully']);
        }
}

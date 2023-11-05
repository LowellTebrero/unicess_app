<?php

namespace App\Http\Controllers;

use App\Models\CustomizeAdminInventory;
use Illuminate\Http\Request;

class CustomizeAdminInventoryController extends Controller
{
    public function updateData(Request $request, $id){
        // Find the model instance you want to update
        $model = CustomizeAdminInventory::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        // Update the model attributes based on the dropdown value
        $model->number = $request->input('selected_value');
        $model->save();

        return response()->json(['message' => 'Data updated successfully']);
        }
}

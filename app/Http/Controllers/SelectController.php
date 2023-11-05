<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectController extends Controller
{
    public function update(Request $request,  $proposal)
    {

        $selectedOption = $request->input('select-dropdown');

        $proposal =  Proposal::where('id', $proposal)->update([

            'authorize' => $selectedOption,
        ]);

        return response()->json(['message' => 'Product updated successfully']);


    }
}

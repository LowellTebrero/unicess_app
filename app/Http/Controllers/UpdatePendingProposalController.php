<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\ProposalMember;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserProposalAuthorizeNotification;

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

    $proposalmember = ProposalMember::where('proposal_id', $id)->get();

    foreach($proposalmember as $member){

        $users = User::where('id',  $member->user_id)->get();
        Notification::send($users, new UserProposalAuthorizeNotification($model));

    }



    return response()->json(['message' => 'Data updated successfully']);
    }
}

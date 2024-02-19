<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProjectLike;
use Illuminate\Http\Request;

class ProjectLikeController extends Controller
{
    public function likeProposal($proposalId)
    {
        $proposal = Proposal::findOrFail($proposalId);
        $userId = auth()->id();
        $existingLike = ProjectLike::where('user_id', $userId)->where('proposal_id', $proposalId)->first();

        if (!$existingLike) {
            ProjectLike::create([
                'user_id' => $userId,
                'proposal_id' => $proposalId
            ]);

            return response()->json(['message' => 'Proposal liked successfully']);
        } else {
            $existingLike->delete();
            return response()->json(['message' => 'Proposal unliked successfully']);
        }
    }

    public function likeCount($proposal)
    {
        $likeCount = ProjectLike::where('proposal_id', $proposal)->count();

        return response()->json(['count' => $likeCount]);
    }

}

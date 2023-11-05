<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Modal;
use App\Models\Proposal;

class PendingProposal extends Modal
{

    public function user($id)
    {

        Proposal::where('id', $id)->first();
    }

    public function render()
    {

        return view('livewire.pending-proposal',
            [
                'projectProposals' => Proposal::where('authorize', 'pending')->get(),
                'Proposal' => Proposal::where('id', $this->id)->get(),
                'Count' => Proposal::where('authorize', 'pending')->count(),
            ]);
    }
}

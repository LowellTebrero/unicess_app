<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Modal;
use App\Models\Proposal;

class FinishedProposal extends Modal
{

    public function render()
    {

        return view('livewire.finished-proposal',
            ['projectProposals' => Proposal::where('authorize', 'finished')->get(),
                'Count' => Proposal::where('authorize', 'finished')->count(),
            ]);

    }
}

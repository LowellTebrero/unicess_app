<?php

namespace App\Http\Livewire;

use App\Models\Proposal;
use App\Http\Livewire\Modal;


class OngoingProposal extends Modal
{
    public function render()
    {
        return view('livewire.ongoing-proposal',

        ['projectProposals' => Proposal::where('authorize', 'ongoing')->get(),
        'Count' => Proposal::where('authorize', 'ongoing')->count(),
        ]);
    }
}

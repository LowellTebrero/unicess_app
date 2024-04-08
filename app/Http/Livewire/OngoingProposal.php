<?php

namespace App\Http\Livewire;

use App\Models\Proposal;
use App\Http\Livewire\Modal;
use Livewire\WithPagination;


class OngoingProposal extends Modal
{
    use WithPagination;


    public function render()
    {
        return view('livewire.ongoing-proposal',

        ['projectProposals' => Proposal::where('authorize', 'ongoing')->orderBy('created_at', 'desc')->paginate(10),
        'Count' => Proposal::where('authorize', 'ongoing')->count(),
        ]);
    }
}

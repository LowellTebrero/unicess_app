<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Modal;
use App\Models\Proposal;
use Livewire\WithPagination;

class FinishedProposal extends Modal
{
    use WithPagination;
    public function render()
    {

        return view('livewire.finished-proposal',
            ['projectProposals' => Proposal::where('authorize', 'finished')->orderBy('created_at', 'desc')->paginate(10),
                'Count' => Proposal::where('authorize', 'finished')->count(),
            ]);

    }
}
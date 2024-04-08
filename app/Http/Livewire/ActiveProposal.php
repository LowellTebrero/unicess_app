<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\Proposal;

class ActiveProposal extends Modal
{
    public function render()
    {
        return view('livewire.active-proposal',
        ['projectProposals' => Proposal::where('status', 'active')->orderBy('created_at', 'desc')->paginate(10),
        'Count' => Proposal::where('status', 'active')->count(),
        ]);
    }
}
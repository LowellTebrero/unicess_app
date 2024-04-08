<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Modal;
use App\Models\Proposal;
use Livewire\WithPagination;

class PendingProposal extends Modal
{
    use WithPagination;

    public function user($id)
    {

        Proposal::where('id', $id)->first();
    }

    public function render()
    {

        return view('livewire.pending-proposal',
            [
                'projectProposals' => Proposal::where('authorize', 'pending')->orderBy('created_at', 'desc')->paginate(10),
                'Proposal' => Proposal::where('id', $this->id)->get(),
                'Count' => Proposal::where('authorize', 'pending')->count(),
            ]);
    }
}
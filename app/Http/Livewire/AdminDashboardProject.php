<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposal;

use Livewire\WithPagination;

class AdminDashboardProject extends Component
{

    use WithPagination;

    public $search = "";

    public $status = null;
    public $activationStatus = null;

    public $paginate = 9;




    public function render()
    {
        return view('livewire.admin-dashboard-project', [
            'allProposal' => Proposal::orderBy('proposals.created_at', 'desc')
                ->select('proposals.*', 'users.name as user_name') // Include authorize and other columns as needed
                ->with('programs')->with('proposal_members')
                ->join('users', 'proposals.user_id', '=', 'users.id')
                ->search(trim($this->search))
                ->when($this->status, function ($query) {
                    $query->where('proposals.authorize', $this->status);
                })
                ->when($this->activationStatus, function ($query) {
                    $query->where('proposals.status', $this->activationStatus);
                })
                ->paginate($this->paginate)

        ]);
    }
}

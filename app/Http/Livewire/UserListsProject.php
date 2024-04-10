<?php

namespace App\Http\Livewire;

use App\Models\AdminYear;
use App\Models\CustomizeUserAllProposal;
use App\Models\Proposal;
use App\Models\ProposalMember;
use Livewire\Component;
use Livewire\WithPagination;

class UserListsProject extends Component
{
    use WithPagination;

    public $search = "";
    public $status = null;
    public $yearStatus;
    public $activationStatus = null;
    public $paginateAllProposal = 9; // Pagination for all proposals
    public $Proposalsemester = null;
    public $collegesStatus = null;




    public function mount()
    {
        $this->yearStatus = date('Y'); // Set current year as default
        // Automatically determine the current Proposalsemester
        $currentMonth = date('n');
        $this->Proposalsemester = $currentMonth <= 6 ? 1 : 2; // First Proposalsemester: January to June, Second Proposalsemester: July to December
    }

    public function render()
    {
        // Determine start and end dates based on selected Proposalsemester
        $startDate = null;
        $endDate = null;

        if ($this->Proposalsemester == 1) { // First Proposalsemester: January to June
            $startDate = $this->yearStatus . "-01-01";
            $endDate = $this->yearStatus . "-06-30";
        } elseif ($this->Proposalsemester == 2) { // Second Proposalsemester: July to December
            $startDate = $this->yearStatus . "-07-01";
            $endDate = $this->yearStatus . "-12-31";
        }

        if (!$startDate || !$endDate) {
            $startDate = now()->startOfYear()->toDateString();
            $endDate = now()->endOfYear()->toDateString();
        }

        return view('livewire.user-lists-project', [
            'proposalmember' => ProposalMember::with('proposal')->get(),
            'allproposal' => CustomizeUserAllProposal::where('id', 1)->get(),
            'years' => AdminYear::orderBy('year', 'DESC')->pluck('year'),
            'proposals' => Proposal::with(['proposal_members' => function ($query) { $query->take(5)->latest();},'AdminProgram'])
            ->search(trim($this->search))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($this->status, function ($query) {
                $query->where('proposals.authorize', $this->status);
            })
            ->when($this->activationStatus, function ($query) {
                $query->where('proposals.status', $this->activationStatus);
            })
            ->when($this->yearStatus, function ($query) {
                $query->whereYear('proposals.created_at', $this->yearStatus); // Filter by year
            })
            ->when($this->collegesStatus, function ($query) {
                $query->where('proposals.colleges_name', $this->collegesStatus); // Filter by year
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('proposals.created_at', [$startDate, $endDate]); // Filter by Proposalsemester
            })
            ->orderBy('created_at', 'asc')->paginate($this->paginateAllProposal),
        ]);
    }
}
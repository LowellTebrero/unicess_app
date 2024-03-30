<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposal;
use Livewire\WithPagination;
use App\Models\AdminYear;
use App\Models\ProposalMember;
use Carbon\Carbon;

class ExtensionMonitoring extends Component
{

 use WithPagination;

    public $search = "";
    public $status = null;
    public $yearStatus;
    public $activationStatus = null;
    public $paginateAllProposal = 12; // Pagination for all proposals
    public $Proposalsemester = null;
    public $collegesStatus = null;
    public $date = null;

    public $modalOpen = false;
    public $selectedItem;
    public $modalOpenForDeletion = false;
    public $selectedItemForDeletion;



    // Set a default value for $yearStatus in the constructor
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

        // Determine the date ranges for different time intervals
        $weekStartDate = Carbon::now()->subWeek()->toDateString();
        $monthStartDate = Carbon::now()->subMonth()->toDateString();
        $sixMonthsStartDate = Carbon::now()->subMonths(6)->toDateString();
        $yearStartDate = Carbon::now()->subYear()->toDateString();

        return view('livewire.extension-monitoring', [
            'allProposal' => Proposal::orderBy('proposals.created_at', 'asc')
                ->with('programs')->with('proposal_members')
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
                ->when($this->date == 'week', function ($query) use ($weekStartDate) {
                    $query->where('proposals.created_at', '<', $weekStartDate); // Filter older than a week
                })
                ->when($this->date == 'month', function ($query) use ($monthStartDate) {
                    $query->where('proposals.created_at', '<', $monthStartDate); // Filter older than a month
                })
                ->when($this->date == 'six_months', function ($query) use ($sixMonthsStartDate) {
                    $query->where('proposals.created_at', '<', $sixMonthsStartDate); // Filter older than six months
                })
                ->when($this->date == 'year', function ($query) use ($yearStartDate) {
                    $query->where('proposals.created_at', '<', $yearStartDate); // Filter older than a year
                })
            ->paginate($this->paginateAllProposal),


            'years' => AdminYear::orderBy('year', 'desc')->pluck('year')
        ]);
    }

    public function openModal($itemId)
    {
        $this->selectedItem = Proposal::find($itemId);
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }
    public function openModalForDeletion($itemIdForDeletion)
    {
        $this->selectedItemForDeletion = Proposal::find($itemIdForDeletion);
        $this->modalOpenForDeletion = true;
    }

    public function closeModalForDeletion()
    {
        $this->modalOpenForDeletion = false;
    }
}
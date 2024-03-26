<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposal;
use Livewire\WithPagination;
use App\Models\AdminYear;
use Carbon\Carbon;

class ExtensionMonitoring extends Component
{


    use WithPagination;

    public $search = "";
    public $status = null;
    public $yearStatus;
    public $activationStatus = null;
    public $paginate = 12;
    public $semester = null;
    public $collegesStatus = null;

    public $date = null;


    // Set a default value for $yearStatus in the constructor
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->yearStatus = date('Y'); // Set current year as default
    }



    public function render()
    {

        // Determine start and end dates based on selected semester
        $startDate = null;
        $endDate = null;

        if ($this->semester == 1) { // First Semester: January to June
            $startDate = $this->yearStatus . "-01-01";
            $endDate = $this->yearStatus . "-06-30";
        } elseif ($this->semester == 2) { // Second Semester: July to December
            $startDate = $this->yearStatus . "-07-01";
            $endDate = $this->yearStatus . "-12-31";
        }

       // Determine the date ranges for different time intervals
        $weekStartDate = Carbon::now()->subWeek()->toDateString();
        $monthStartDate = Carbon::now()->subMonth()->toDateString();
        $sixMonthsStartDate = Carbon::now()->subMonths(6)->toDateString();
        $yearStartDate = Carbon::now()->subYear()->toDateString();


        return view('livewire.extension-monitoring', [
            'allProposal' => Proposal::orderBy('proposals.created_at', 'asc')
            // ->select('proposals.*', 'users.name as user_name') // Include authorize and other columns as needed
            ->with('programs')->with('proposal_members')
            // ->join('users', 'proposals.user_id', '=', 'users.id')
            ->search(trim($this->search))
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
                $query->whereBetween('proposals.created_at', [$startDate, $endDate]); // Filter by semester
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



            ->paginate($this->paginate),
            'years' => AdminYear::orderBy('year', 'desc')->pluck('year')

        ]);
    }
}
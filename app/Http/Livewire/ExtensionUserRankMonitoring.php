<?php

namespace App\Http\Livewire;

use App\Models\AdminYear;
use App\Models\Faculty;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProposalMember;
use App\Models\User;

class ExtensionUserRankMonitoring extends Component
{
    use WithPagination;
    public $paginateUsers = 10;

    public $yearStatus;
    public $search = "";
    public $semester = null;

    public $collegesStatus = null;

    public $facultyName = '';


    // public function __construct($id = null)
    // {
    //     parent::__construct($id);
    //     $this->yearStatus = date('Y'); // Set current year as default
    // }

    public function mount()
    {
        $this->yearStatus = date('Y'); // Set current year as default
        // Automatically determine the current semester
        $currentMonth = date('n');
        $this->semester = $currentMonth <= 6 ? 1 : 2; // First Semester: January to June, Second Semester: July to December
    }


    public function render()
    {
        $startDate = null;
        $endDate = null;

        if ($this->semester == 1) { // First Semester: January to June
            $startDate = $this->yearStatus . "-01-01";
            $endDate = $this->yearStatus . "-06-30";
        } elseif ($this->semester == 2) { // Second Semester: July to December
            $startDate = $this->yearStatus . "-07-01";
            $endDate = $this->yearStatus . "-12-31";
        }

        if (!$startDate || !$endDate) {
            $startDate = now()->startOfYear()->toDateString();
            $endDate = now()->endOfYear()->toDateString();
        }

        // $usersProjectCounts = User::with('project_count')->take(10)->get();

        // dd($usersProjectCounts);

        return view('livewire.extension-user-rank-monitoring', [

            'users' => ProposalMember::with('user')
            ->selectRaw('user_id, MAX(created_at) as latest_created_at, COUNT(proposal_id) as proposal_count')
            ->search(trim($this->search))
            ->orderByDesc('proposal_count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]); // Filter by semester
            })
            ->when($this->yearStatus, function ($query) {
                $query->whereYear('created_at', $this->yearStatus); // Filter by year
            })
            ->when($this->collegesStatus, function ($query) {
                $query->whereHas('user', function ($userQuery) {
                    $userQuery->where('colleges', $this->collegesStatus);
                });
            })
            ->when($this->facultyName, function ($query) {
                $query->whereHas('user', function ($userQuery) {
                    $userQuery->where('faculty_id', $this->facultyName);
                });
            })
            ->groupBy('user_id')
            ->paginate($this->paginateUsers),
            'departments' => Faculty::orderBy('name')->pluck('name', 'id')->prepend('Select Department', ''),
            'years' => AdminYear::orderBy('year', 'desc')->pluck('year')
    ]);
    }
}
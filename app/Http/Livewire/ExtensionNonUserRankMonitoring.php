<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AdminYear;
use App\Models\Faculty;

class ExtensionNonUserRankMonitoring extends Component
{

    use WithPagination;
    public $paginateUsers = 10;

    public $yearStatus;
    public $search = "";
    public $semester = null;

    public $facultyName = '';

    public $collegesStatus = null;

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

        return view('livewire.extension-non-user-rank-monitoring', [
            'users' => User::whereDoesntHave('proposals')
            ->search(trim($this->search))
            ->when($this->yearStatus, function ($query) {
                $query->whereYear('created_at', $this->yearStatus); // Filter by year
            })
            ->when($this->collegesStatus, function ($query) {
                    $query->where('colleges', $this->collegesStatus);
            })
            ->when($this->facultyName, function ($query) {
                    $query->where('faculty_id', $this->facultyName);
            })
            ->paginate($this->paginateUsers),
            'departments' => Faculty::orderBy('name')->pluck('name', 'id')->prepend('Select Department', ''),
            'years' => AdminYear::orderBy('year', 'desc')->pluck('year')
        ]);
    }
}
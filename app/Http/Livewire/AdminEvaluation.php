<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\AdminYear;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AdminEvaluation extends Component
{

    use WithPagination;

    public $searchAdminEvaluation = "";
    public $yearStatus;
    public $paginateAdminEvaluation = 10; // Pagination for all proposals
    public $EvaluationSemester = null;

    public $collegesStatus = '';
    public $facultyName = '';
    public $Status = '';
    public $date = null;



    // Set a default value for $yearStatus in the constructor
    public function mount()
    {
        $this->yearStatus = date('Y'); // Set current year as default
        // Automatically determine the current EvaluationSemester
        $currentMonth = date('n');
        $this->EvaluationSemester = $currentMonth <= 6 ? 1 : 2; // First EvaluationSemester: January to June, Second EvaluationSemester: July to December
    }

    public function render()
    {


        $startDate = null;
        $endDate = null;


        if ($this->EvaluationSemester == 1) { // First EvaluationSemester: January to June
            $startDate = $this->yearStatus . "-01-01";
            $endDate = $this->yearStatus . "-06-30";
        } elseif ($this->EvaluationSemester == 2) { // Second EvaluationSemester: July to December
            $startDate = $this->yearStatus . "-07-01";
            $endDate = $this->yearStatus . "-12-31";
        }

        if (!$startDate || !$endDate) {
            $startDate = now()->startOfYear()->toDateString();
            $endDate = now()->endOfYear()->toDateString();
        }

        $weekStartDate = Carbon::now()->subWeek()->toDateString();
        $monthStartDate = Carbon::now()->subMonth()->toDateString();
        $sixMonthsStartDate = Carbon::now()->subMonths(6)->toDateString();
        $yearStartDate = Carbon::now()->subYear()->toDateString();


        return view('livewire.admin-evaluation', [

          'evaluations' => Evaluation::with('users')->with('evaluationfile')

          ->search(trim($this->searchAdminEvaluation))
          ->whereBetween('created_at', [$startDate, $endDate])
          ->when($this->yearStatus, function ($query) {
            $query->whereYear('evaluations.created_at', $this->yearStatus); // Filter by year
        })
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('evaluations.created_at', [$startDate, $endDate]); // Filter by EvaluationSemester
        })
        ->when($this->date == 'week', function ($query) use ($weekStartDate) {
            $query->where('evaluations.created_at', '<', $weekStartDate); // Filter older than a week
        })
        ->when($this->date == 'month', function ($query) use ($monthStartDate) {
            $query->where('evaluations.created_at', '<', $monthStartDate); // Filter older than a month
        })
        ->when($this->date == 'six_months', function ($query) use ($sixMonthsStartDate) {
            $query->where('evaluations.created_at', '<', $sixMonthsStartDate); // Filter older than six months
        })
        ->when($this->date == 'year', function ($query) use ($yearStartDate) {
            $query->where('evaluations.created_at', '<', $yearStartDate); // Filter older than a year
        })
        ->when($this->collegesStatus, function ($query) {
            $query->where('evaluations.colleges_name', $this->collegesStatus); // Filter by year
        })
        ->when($this->facultyName, function ($query) {
            $query->where('evaluations.faculty_id', $this->facultyName); // Filter by year
        })
        ->when($this->Status, function ($query) {
            $query->where('evaluations.status', $this->Status); // Filter by year
        })

        ->orderBy('total_points', 'desc')
        ->paginate($this->paginateAdminEvaluation),
        'years' => AdminYear::orderBy('year', 'desc')->pluck('year'),
        'departments' => Faculty::orderBy('name')->pluck('name', 'id')->prepend('Select Department', ''),
        'currentYear' => date('Y')
        ]);

    }
}
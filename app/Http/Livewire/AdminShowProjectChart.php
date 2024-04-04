<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Proposal;
use App\Models\AdminYear;

class AdminShowProjectChart extends Component
{
    public $proposalId;
    public $yearStatus; // Property to hold the selected year
    public $years; // Assuming you have a property to hold the available years
    public $chartData;

    public function mount($proposalId)
    {
        $this->proposalId = $proposalId;
        $this->years = AdminYear::orderBy('year', 'desc')->pluck('year');
        $this->yearStatus = Carbon::now()->year;
        $this->loadChartData();
    }

    // Load chart data based on the proposal ID
    public function loadChartData()
    {
        $allMonths = [];
        $currentMonth = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        while ($currentMonth <= $endOfYear) {
            $allMonths[] = $currentMonth->format('F');
            $currentMonth->addMonth();
        }

        $mediaData = Proposal::where('id', $this->proposalId)
        ->with('medias' )
            ->get()
            ->flatMap(function ($proposal) {
                return $proposal->medias->map(function ($media) {
                    return $media->created_at->format('F');
                });
            });

        $monthCounts = $mediaData->countBy()->toArray();

        $data = [];
        foreach ($allMonths as $month) {
            $data[] = isset($monthCounts[$month]) ? $monthCounts[$month] : 0;
        }

        $this->chartData = [
            'labels' => $allMonths,
            'data' => $data,
        ];
    }

    public function render()
    {
        return view('livewire.admin-show-project-chart', ['chartData' => $this->chartData]);
    }
}

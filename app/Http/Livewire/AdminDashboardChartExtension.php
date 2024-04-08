<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposal;
use App\Models\AdminYear;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardChartExtension extends Component
{
    public $yearStatus;
    public $status;
    public $data;
    public $MonthData;

    public function mount()
    {
        $this->yearStatus = date('Y');
        $this->status = 'active'; // Default status value
        $this->getData();
    }

    public function getData()
    {
        // Fetch data for the first chart
        $startDate = Carbon::now()->subDays(5)->startOfDay(); // Set start date to 7 days ago
        $endDate = Carbon::now()->endOfDay(); // Set end date to today

        $proposals = Proposal::select(
            DB::raw("COUNT(*) as count"),
            DB::raw("DATE(created_at) as date")
        )
            ->whereYear('created_at', $this->yearStatus)
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('count', 'date');

        // Fetch data for the second chart
        $users = Proposal::select(
            DB::raw("COUNT(*) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("MONTH(created_at) as month_number")
        )
            ->whereYear('created_at', $this->yearStatus)
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number', 'ASC')
            ->pluck('count', 'month_name');

        // Get the latest month number
        $latestMonth = Carbon::now()->month;

        // Prepare data for the second chart
        $labels = [];
        $data = [];

        // Loop through months starting from January up to the latest month of the year
        for ($i = 1; $i <= $latestMonth; $i++) {
            $monthName = Carbon::createFromFormat('m', $i)->format('F'); // Get month name from month number

            $labels[] = $monthName; // Add month name to labels array

            // Check if data exists for the month
            if (isset($users[$monthName])) {
                $data[] = $users[$monthName]; // Add data for the month to data array
            } else {
                $data[] = 0; // If no data exists, add 0 to data array
            }
        }

        // Prepare data for the charts
        $this->data = [
            'chart1' => [
                'labels' => $this->generateLabels($startDate, $endDate),
                'datasets' => [
                    [
                        'label' => ucfirst($this->status) . ' Latest Week Projects',
                        'backgroundColor' => '#f87979',
                        'data' => $this->fillDayGaps($proposals, $startDate, $endDate),
                    ]
                ]
            ],
            'chart2' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Project Extensions Count by Month',
                        'backgroundColor' => '#87CEFA',
                        'data' => $data,
                    ]
                ]
            ]
        ];

        // Emit the updated chart data to Livewire component
        $this->emit('updateChart', $this->data);
    }






    public function render()
    {
        return view('livewire.admin-dashboard-chart-extension', [
            'years' => AdminYear::orderBy('year', 'desc')->pluck('year')
        ]);
    }

    public function updatedYearStatus($value)
    {
        $this->getData();
    }

    public function updatedStatus($value)
    {
        $this->getData();
    }

    private function generateLabels($startDate, $endDate)
    {
        $labels = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $labels[] = $currentDate->format('D, M j');
            $currentDate->addDay(); // Move to the next day
        }

        return $labels;
    }

    private function fillDayGaps($proposals, $startDate, $endDate)
    {
        $filledData = [];
        $currentDate = $endDate->copy(); // Start from the end date (latest day)

        while ($currentDate->gte($startDate)) { // Check if the current date is greater than or equal to the start date
            $formattedDate = $currentDate->format('Y-m-d');
            $filledData[] = isset($proposals[$formattedDate]) ? $proposals[$formattedDate] : 0;
            $currentDate->subDay(); // Move to the previous day
        }

        return array_reverse($filledData); // Reverse the array to get the data from oldest day to latest day
    }

    private function generateMonthLabels()
{
    $labels = [];
    $currentMonth = Carbon::now()->startOfYear();

    while ($currentMonth->lte(Carbon::now())) {
        $labels[] = $currentMonth->format('F');
        $currentMonth->addMonth();
    }

    return $labels;
}
}
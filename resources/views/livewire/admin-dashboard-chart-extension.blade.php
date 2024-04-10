<div>


    <div class="flex gap-2 text-gray-700 justify-between">
        <h1 class="text-sm tracking-wide">Project Extension Statistics</h1>
        <div class="flex gap-2">

        <select wire:model="yearStatus" name="yearStatus" id="yearStatus" class="w-[6rem] text-xs rounded  border-slate-400">
            @foreach ($years as $year )
            <option value="{{ $year }}" @if ($yearStatus == date('Y')) selected="selected" @endif>{{ $year }}</option>
            @endforeach
        </select>
        <select wire:model="status" name="status" id="status" class="w-[6rem] text-xs rounded  border-slate-400">
            <option value="active" @if ($status == 'active') selected="selected" @endif>Active</option>
            <option value="inactive" @if ($status == 'inactive') selected="selected" @endif>Inactive</option>
        </select>
    </div>
    </div>


    <div class="w-[100%] flex justify-between gap-4 pt-6 2xl:flex-col">     
        <div class="2xl:p-12 h-[50vh] 2xl:h-full w-[50%]">
            <canvas wire:ignore id="myChart1"></canvas>
        </div>
 
        <div class="2xl:p-12 h-[50vh] 2xl:h-full w-[50%]">
            <canvas wire:ignore id="myChart2"></canvas>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx1 = document.getElementById('myChart1').getContext('2d');
            var myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: @json($data['chart1']), // Use chart1 data
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });

            var ctx2 = document.getElementById('myChart2').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: @json($data['chart2']), // Use chart2 data
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });

            window.livewire.on('updateChart', function(data) {
                myChart1.data = data.chart1; // Update chart1 data
                myChart1.update();
                myChart2.data = data.chart2; // Update chart2 data
                myChart2.update();
            });
        });
    </script>
    @endpush



    {{-- @push('script')
    <script>
        document.addEventListener('livewire:load', function () {
            var labels = @json($labels);
            var data = @json($data);

            const ctx = document.getElementById('myChartBar');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Count of Uploaded of Projects by Month',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        fill: true,
                        cubicInterpolationMode: 'monotone'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endpush --}}
</div>

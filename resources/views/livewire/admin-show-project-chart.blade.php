<div>
    {{--  <div>
        <select wire:model="yearStatus" name="yearStatus" id="yearStatus" class="w-[6rem] text-xs rounded border-slate-400 text-slate-400">
            @foreach ($years as $year)
                <option value="{{ $year }}" {{ $year == $yearStatus ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
    </div>  --}}

    <div>

        <canvas id="myChart"></canvas>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Uploaded Activity',
                        data: @json($chartData['data']),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true,
                        cubicInterpolationMode: 'monotone',
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                color: '#d9d9d9' // Change the color of dataset label text to white
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#d9d9d9' // Change the color of tick marks and numbers on the y-axis to white
                            }
                        },
                        x: {
                            ticks: {
                                color: '#d9d9d9' // Change the color of labels on the x-axis to white
                            }
                        }

                    },
                    elements: {
                        point: {
                            backgroundColor: 'rgba(75, 192, 192, 1)', // Change the color of the data points
                        },
                        line: {
                            borderColor: 'rgba(75, 192, 192, 1)' // Change the color of the lines connecting data points
                        }
                    }
                }
            });
        </script>
        @endpush
    </div>

</div>

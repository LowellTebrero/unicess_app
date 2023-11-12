<x-admin-layout>

    <section class="mt-8 m-5 rounded-lg bg-white min-h-[87vh]">

    <div class="p-4 flex justify-between">
        <h1 class="text-xl font-medium tracking-wider text-slate-700">Proposal Chart Overview</h1>
        <a href={{ route('admin.dashboard.index') }} class="hover:bg-gray-200 focus:bg-red-200 rounded px-2 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
    </div>
    <hr>

    <div class="flex 2xl:flex-row flex-col p-5 space-x-5 bg-slate-100 m-5 rounded-lg">

        <div class=" 2xl:w-1/2">
            <canvas id="Chart"></canvas>
        </div>

        <div class="2xl:w-1/2">
            {!! $chart->container() !!}
            {!! $chart->script() !!}
        </div>
    </div>




    {{--  {{ $proposalUser }}  --}}

    {{--  @foreach ($proposalUser as $prop )
        {{ $prop->name }}
    @endforeach  --}}
    </section>


    {{--  <canvas id="myChart"></canvas>  --}}


    {{--  <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chartData = {
            labels: {!! json_encode($data['labels']) !!},
            datasets: [{
                label: 'Data',
                data: {!! json_encode($data['data']) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData
        });
    </script>  --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">

        var labels =  {{ Js::from($labels) }};
        var users =  {{ Js::from($data) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'Month of Uploaded of Proposal',
                backgroundColor: [
              "#DEB887","#A9A9A9","#DC143C","#F4A460","#2E8B57","#1D7A46","#CDA776",
            ],
            borderColor: [
                "#CDA776","#989898","#CB252B","#E39371","#1D7A46","#F4A460", "#CDA776",
              ],
            borderWidth: [1, 1, 1, 1, 1, 1, 1],
                data: users,
            }]
        };


        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('Chart'),
            config
        );

    </script>





</x-admin-layout>

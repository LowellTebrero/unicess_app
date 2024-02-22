     <style>[x-cloak] { display: none }</style>

<x-admin-layout>

    <section class=" bg-white rounded-xl h-full">

        <div class="w-full flex justify-between p-4">
            <h1 class="tracking-wider text-xs sm:text-sm">Program Name:{{ Str::limit($programID->program_name, 20) }}</h1>
            <a class="text-red-500 font-bold text-xl focus:bg-gray-300 rounded"   href={{ route('admin.inventory.index') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <hr>
        <div class="flex flex-col px-4">

            <div class="grid 2xl:grid-cols-7 grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 mt-4 text-gray-700 relative">
                @forelse ($proposalID as $proposal )
                    @if ($programID->id === $proposal->program_id)
                        <div class="flex bg-slate-100  shadow-md rounded-lg relative hover:bg-slate-200" data-tooltip-target="tooltip-bottom{{$proposal->id}}" data-tooltip-placement="right"
                            onmouseover="showTooltip()"
                            onmouseout="hideTooltip()">

                            <a class="p-3 pl-2 rounded-lg w-full flex flex-col" href={{ route('admin.inventory.show-inventory', $proposal->id) }}>
                                <svg class="fill-yellow-400 mr-3" xmlns="http://www.w3.org/2000/svg" height="55" viewBox="0 96 960 960" width="55"><path d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z"/></svg>
                                <span class="block text-[.7rem] sm:text-xs text-gray-700 font-medium">{{ Str::limit($proposal->project_title, 40) }}</span>
                            </a>

                            <div x-cloak  x-data="{ 'showModal{{ $proposal->id }}': false }" @keydown.escape="showModal{{ $proposal->id }} = false" class="absolute top-0 right-2">

                                <!-- Modal -->
                                <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal{{ $proposal->id }}">

                                    <!-- Modal inner -->
                                    <div class="w-[40rem] py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal{{ $proposal->id }}"
                                        x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal{{ $proposal->id }} = false">

                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-between px-4 py-1">
                                            <h1 class="text-xs"> {{ Str::limit($proposal->project_title, 70) }}</h1>
                                            <button type="button" class=" z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1  text-xl font-semibold" @click="showModal{{ $proposal->id }} = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <hr>

                                        <!-- content -->
                                        <div class="p-5">
                                            <div class="space-y-2">
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Project ID:</label>
                                                    <h1 class="text-xs">{{ $proposal->id }}</h1>
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Created:</label>
                                                    <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposal->created_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                                                </div>

                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Modified:</label>
                                                    <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposal->updated_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                                                </div>

                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Uploader:</label>
                                                    <h1 class="text-xs">{{ $proposal->user->name }}</h1>
                                                </div>

                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Program name:</label>
                                                    <h1 class="text-xs">{{ $proposal->programs->program_name }}</h1>
                                                </div>

                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Status:</label>
                                                    <h1 class="text-xs">{{ $proposal->authorize }}</h1>
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Started date:</label>
                                                    <h1 class="text-xs tracking-wider">{{ $proposal->started_date == null ? 'No date' :  $proposal->started_date->format('M. d, Y') }}</h1>
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Finished date:</label>
                                                    <h1 class="text-xs tracking-wider">{{ $proposal->finished_date == null ? 'No date' :  $proposal->finished_date->format('M. d, Y') }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute top-0 right-1 z-50">

                                    <x-tooltip-modal>
                                        <a href={{ url('download', $proposal->id) }} class="block text-xs p-2 hover:text-black hover:bg-gray-200" x-data="{dropdownMenu: false}" >Download as zip</a>
                                        <button class="text-xs p-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal{{ $proposal->id }} = true">Properties</button>
                                        <form action="{{ route('admin.inventory.delete-project-proposal', $proposal->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs pl-2 p-1 hover:bg-gray-200 w-full text-left">
                                                Trash this Project
                                            </button>
                                            </form>
                                    </x-tooltip-modal>
                                </div>
                            </div>
                        </div>

                        <div id="tooltip-bottom{{$proposal->id}}" role="tooltip" class=" absolute z-10 invisible px-3 py-2 text-xs text-gray-700 bg-gray-100 rounded-lg shadow-sm opacity-0 tooltip" >
                        {{$proposal->project_title}}<div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    @endif
                    @empty
                        <div class="flex items-center justify-center w-full p-5">
                            <h1 class="text-red-500">No record found</h1>
                        </div>
                @endforelse
            </div>
        </div>

      <x-messages/>

    </section>

    <script>
        document.getElementById('filter_faculty_id').addEventListener('change', function(){

         let facultyId = this.value || this.options[this.selectedIndex].value
                window.location.href = window.location.href.split('?')[0] + '?faculty_id=' + facultyId
        });
    </script>

    <script>
        var tooltipTimeout;
        var proposalId = {{ $proposal->id ?? 'null' }};

        function showTooltip() {
          tooltipTimeout = setTimeout(function () {
            var tooltip = document.getElementById(`tooltip-bottom${proposalId}`);
            tooltip.classList.remove('invisible');
            tooltip.classList.add('visible');
            tooltip.style.opacity = '1';
          }, 2000); // 2000 milliseconds (2 seconds) delay
        }

        function hideTooltip() {
          clearTimeout(tooltipTimeout);
          var tooltip = document.getElementById(`tooltip-bottom${proposalId}`);
          tooltip.classList.add('invisible');
          tooltip.classList.remove('visible');
          tooltip.style.opacity = '0';
        }
      </script>

</x-admin-layout>

     <style>
        [x-cloak] { display: none }
    </style>

<x-admin-layout>

    <section class="mt-5 m-8 bg-white rounded-xl min-h-[87vh]">


        <div class="w-full flex justify-between p-4">
            <h1 class="tracking-wider text-sm">Program Name:{{ $programID->program_name }}</h1>
            <a class="text-red-500 font-bold text-xl focus:bg-gray-300 rounded"  href={{ route('admin.inventory.index') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <hr>

        <div class="flex flex-col relative  px-4">

            <div class="my-5 flex justify-end px-4">
                <select id="filter_faculty_id" type="text"  class="xl:text-xs form-control rounded-md text-slate-700 border-slate-500">
                    @foreach ($allFaculty as $id => $name )
                        <option {{ $id == request('faculty_id') ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-row space-x-5 mt-4 ">
                @forelse ($proposalID as $proposal )
                    @if ($programID->id === $proposal->program_id)
                        <div class="flex xl:w-[20rem] bg-yellow-100 shadow-md rounded-xl relative hover:bg-yellow-200">

                            <a class=" p-3 rounded-lg w-full flex items-center" href={{ route('admin.inventory.show-inventory', $proposal->id) }}>
                                <svg class="fill-yellow-400 mr-3" xmlns="http://www.w3.org/2000/svg" height="55" viewBox="0 96 960 960" width="55"><path d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z"/></svg>
                                <h1 class="xl:text-xs text-gray-500 block"> Project Title: <span class="block xl:text-[.7rem] text-black font-medium">{{ Str::limit($proposal->project_title, 40) }}</span> </h1>
                            </a>

                            <div class="absolute top-0 right-2 z-100">

                                <x-tooltip-modal>
                                    <a href={{ url('download', $proposal->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}" >Download as zip</a>
                                    <button  class="block text-slate-800 text-xs px-2 py-2 hover:text-black">Properties</button>
                                    <form action="{{ route('admin.proposal.delete-project-proposal', $proposal->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs ml-1 p-1">
                                            Delete Proposal
                                        </button>
                                        </form>
                                </x-tooltip-modal>
                            </div>
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

</x-admin-layout>

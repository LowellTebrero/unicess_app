<x-admin-layout>

    <section class="rounded-lg shadow bg-white p-5 mt-5 px-8 mx-8 text-slate-700 min-h-[87vh]">

        <div class="flex justify-between ">
            <h1 class="tracking-wider font-semibold text-2xl"> User Points Overview </h1>
            <a href={{ route('admin.points.index') }} class=" text-red-500 px-2 py-1 rounded-lg font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>


        <div class="flex mt-10 border-t pt-3">

            <div class="w-1/4 border-r">

                <h1 class="tracking-wider text-lg font-medium">Profile Information</h1>

                <div class="w-32 mt-5">
                    <img class="rounded-full border-black border"  id="showImage" src="{{ (!empty($filteredUsers->avatar))? url('upload/image-folder/profile-image/'. $filteredUsers->avatar): url('upload/profile.png') }}">
                </div>

                <div class="space-y-1 mt-4 border-r text-sm">
                    <h1>Name: {{ $filteredUsers->name }}</h1>
                    <h1>Faculty Name:  {{ $filteredUsers->faculty->name }}</h1>
                        @if (!empty($filteredUsers->getRoleNames()))
                            @foreach ($filteredUsers->getRoleNames() as $role )
                                <h1>Role: {{ $role }}</h1>
                            @endforeach
                        @endif

                </div>
            </div>

            <div class="w-full px-5">
                    <h1 class=" tracking-wider text-lg font-medium">Proposal Information</h1>

                <div class="flex justify-between mt-5 space-y-1 flex-col text-sm">
                        @foreach ($filteredUsers->proposal as $props)
                        <h1>Project Title: {{ $props->project_title }}</h1>
                        @endforeach
                </div>
            </div>


            <div class="w-1/4 border-l px-2 flex items-center flex-col space-y-10">

                    <h1 class="tracking-wider text-lg font-medium">Total Points</h1>

                    @foreach ($filteredUsers->evaluation as $eval )
                    <h1 class="text-5xl">{{ $eval->total_points }}</h1>
                    @endforeach
                </div>
            </div>


        </div>
    </section>
</x-admin-layout>

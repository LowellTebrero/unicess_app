<x-admin-layout>

    @section('title', 'Terminal | ' . config('app.name', 'UniCESS'))
    <section class="text-gray-700 h-[82vh] 2xl:h-[87vh] m-8 mt-4 2xl:mt-5  bg-white rounded-xl shadow">

        <header class="flex justify-between p-5 py-4">
            <div>
                <h1 class="tracking-wider 2xl:text-2xl font-semibold text-lg">Terminal Overview </h1>
            </div>
            <a href={{ route('admin.dashboard.index') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <main class="p-10 ">

            <div class="h-[25vh] overflow-x-auto">
                <table class="table-auto relative w-full">
                    <thead class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Uploaded at</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Name</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Faculty Name</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Role Name</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="text-xs divide-y divide-gray-100 ">

                        @foreach ($terminalReports as $terminal)

                        <tr class="hover:bg-gray-100">
                            <td class="p-3 whitespace-nowrap">
                                  <a href={{route('admin.dashboard.terminal-show', ['id' => $terminal->user_id, 'notification' => $terminal->user_id])}}>
                                    <div class="text-left text-gray-700 xl:text-[.7rem]">
                                        {{ \Carbon\Carbon::parse($terminal->created_at)->format('M d, Y,  g:i:s A')}}
                                    </div>
                                </a>
                            </td>

                            <td class="p-3 whitespace-nowrap">
                                  <a href={{route('admin.dashboard.terminal-show', ['id' => $terminal->user_id, 'notification' => $terminal->user_id])}}>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                            class="rounded-full"
                                            src="{{ !empty($terminal->users->avatar) ? url('upload/image-folder/profile-image/' . $terminal->users->avatar) : url('upload/profile.png') }}"
                                            width="30" height="30">
                                    </div>
                                    <div class="font-medium text-gray-600 text-[.7rem]">
                                        {{ $terminal->users->name }}
                                    </div>
                                </div>
                                </a>
                            </td>

                            <td class="p-3 whitespace-nowrap text-left">
                                  <a href={{route('admin.dashboard.terminal-show', ['id' => $terminal->user_id, 'notification' => $terminal->user_id])}}>
                                {{$terminal->users->faculty->name}}
                                </a>
                            </td>

                            <td class="p-3 whitespace-nowrap text-left">
                                  <a href={{route('admin.dashboard.terminal-show', ['id' => $terminal->user_id, 'notification' => $terminal->user_id])}}>
                                @foreach ($terminal->users->roles as $roles )
                                {{$roles->name}}
                                @endforeach
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </main>

    </section>
</x-admin-layout>

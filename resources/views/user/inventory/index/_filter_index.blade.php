
@foreach ($inventory as $invent )
                @if ($invent->number == 1)
                    <div class="flex p-5 flex-wrap">
                        @foreach ($proposals as $proposal )
                        @foreach ($proposal->proposal_members as $prop )
                            @if ($proposal->id == $prop->proposal_id)
                                    <div class="bg-slate-100 shadow rounded-md hover:bg-slate-200 p-2 flex m-3 relative">

                                        <a class=" block  w-[10rem] text-[.7rem] "
                                            href={{ route('inventory.show', $proposal->id) }}>
                                            <svg class="fill-blue-500 hover:fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="55"
                                                viewBox="0 96 960 960" width="55">
                                                <path
                                                    d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z" />
                                            </svg>
                                            {{ Str::ucfirst(Str::lower(Str::limit($proposal->project_title, 50))) }}
                                        </a>

                                        <div x-cloak x-data="{ dropdownMenu: false }">
                                            <!-- Dropdown toggle button -->
                                            <button @click="dropdownMenu = ! dropdownMenu"
                                                class="flex items-center p-2   rounded-md absolute top-0 right-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 96 960 960"
                                                    width="15">
                                                    <path
                                                        d="M480.571 934q-29.571 0-50.57-20.884-21-20.884-21-50.21 0-28.838 20.835-50.372 20.835-21.533 50.093-21.533 30.071 0 50.571 21.503 20.499 21.503 20.499 50.499 0 28.997-20.429 49.997t-49.999 21Zm0-287.001q-29.571 0-50.57-20.835-21-20.835-21-50.093 0-30.071 20.835-50.571 20.835-20.499 50.093-20.499 30.071 0 50.571 20.429 20.499 20.429 20.499 49.999 0 29.571-20.429 50.571-20.429 20.999-49.999 20.999Zm0-286q-29.571 0-50.57-21.212-21-21.213-21-51t20.835-50.62q20.835-20.833 50.093-20.833 30.071 0 50.571 20.927 20.499 20.928 20.499 50.715 0 29.787-20.429 50.905-20.429 21.118-49.999 21.118Z" />
                                                </svg>
                                            </button>
                                            <!-- Dropdown list -->
                                            <div x-show="dropdownMenu"
                                                class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32"
                                                x-on:keydown.escape.window="dropdownMenu = false"
                                                @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                x-transition:enter="motion-safe:ease-out duration-100"
                                                x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                                <a href={{ url('download', $proposal->id) }}
                                                    class="block text-xs px-2 py-2 hover:text-gray-700"
                                                    x-data="{ dropdownMenu: false }">Download as zip</a>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                @elseif ($invent->number == 2)
                <div class="flex flex-wrap relative px-4">

                    <div class="flex flex-col w-full">
                          <div class="p-2">
                              <table class="w-full">
                                <thead>
                                  <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"></th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"></th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach ($proposals as $proposal )
                                    @foreach ($proposal->proposal_members as $prop )

                                    @if ($proposal->id == $prop->proposal_id)

                                            <tr class="hover:bg-gray-200 ">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800  w-[1/4]">
                                                    <a href={{ route('inventory.show', $proposal->id) }}>
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="fill-blue-500 hover:fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="40"
                                                        viewBox="0 96 960 960" width="40">
                                                        <path
                                                        d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z" />
                                                    </svg>
                                                       <h1 class="text-xs">{{ Str::ucfirst(Str::lower(Str::limit($proposal->project_title, 90))) }}</h1>
                                                    </div>
                                                </a>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                    <a href={{ route('inventory.show', $proposal->id) }}>
                                                    <h1 class="text-sm">{{ $proposal->created_at }}</h1>
                                                    </a>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 relative">
                                                    <a href={{ route('inventory.show', $proposal->id) }}>
                                                    <h1 class="text-sm">Folder</h1>
                                                    </a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 relative">
                                                    <div x-cloak x-data="{ dropdownMenu: false }">
                                                        <!-- Dropdown toggle button -->
                                                        <button @click="dropdownMenu = ! dropdownMenu"
                                                            class="flex items-center p-2   rounded-md absolute top-5 right-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 96 960 960"
                                                                width="15">
                                                                <path
                                                                    d="M480.571 934q-29.571 0-50.57-20.884-21-20.884-21-50.21 0-28.838 20.835-50.372 20.835-21.533 50.093-21.533 30.071 0 50.571 21.503 20.499 21.503 20.499 50.499 0 28.997-20.429 49.997t-49.999 21Zm0-287.001q-29.571 0-50.57-20.835-21-20.835-21-50.093 0-30.071 20.835-50.571 20.835-20.499 50.093-20.499 30.071 0 50.571 20.429 20.499 20.429 20.499 49.999 0 29.571-20.429 50.571-20.429 20.999-49.999 20.999Zm0-286q-29.571 0-50.57-21.212-21-21.213-21-51t20.835-50.62q20.835-20.833 50.093-20.833 30.071 0 50.571 20.927 20.499 20.928 20.499 50.715 0 29.787-20.429 50.905-20.429 21.118-49.999 21.118Z" />
                                                            </svg>
                                                        </button>
                                                        <!-- Dropdown list -->
                                                        <div x-show="dropdownMenu"
                                                            class="z-50 absolute left-0 py-2 mt-2 bg-white rounded-md shadow-xl w-32"
                                                            x-on:keydown.escape.window="dropdownMenu = false"
                                                            @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                            x-transition:enter="motion-safe:ease-out duration-100"
                                                            x-transition:enter-start="opacity-0 scale-90"
                                                            x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200"
                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                                            <a href={{ url('download', $proposal->id) }}
                                                                class="block text-xs px-2 py-2 hover:text-gray-700"
                                                                x-data="{ dropdownMenu: false }">Download as zip</a>

                                                    </div>
                                                </div>
                                             </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endforeach

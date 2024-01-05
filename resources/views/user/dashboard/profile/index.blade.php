<x-app-layout>

    <style>
        .footer {
            background-image: linear-gradient(to right, rgba(4, 47, 139, 0.656),rgba(4, 47, 139, 0.704)), url("img/footer-bg.jpg");
            background-position: bottom;
            background
        }
    </style>


    <section class="mt-5 m-8 rounded-lg 2xl:min-h-[87vh] h-[82vh] relative bg-white text-gray-700 overflow-hidden">
        <header class="p-4 flex justify-between">
            <h1 class="text-xl font-medium tracking-wider">User Profile</h1>
            <a href={{ route('User-dashboard.index') }} class="focus:bg-red-100 rounded-md px-2 py-1 hover:bg-gray-200 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <div class="2xl:min-h-[12vh] xl:min-h-[8vh] footer w-full"></div>

        <div class="2xl:w-40 xl:w-32 lg:w-28 w-28 absolute 2xl:top-28 xl:top-[9vh] left-12 z-20">
            <img class="rounded-full border-8 border-white bg-white"
            src="{{ !empty( Auth()->user()->avatar) ? url('upload/image-folder/profile-image/' . Auth()->user()->avatar) : url('upload/profile.png') }}">
        </div>

        <div class=" min-h-[12vh] flex justify-end relative">
            <div class="left-[14rem]  top-4 absolute ">
                <div class="flex space-x-1  items-center">
                    <h1 class="text-lg font-medium tracking-wider">{{ Auth()->user()->name }} </h1>
                    @if (Auth()->user()->email_verified_at == '')
                        <h1 class="text-xs text-red-400">email unverified</h1>
                    @else
                    <svg class="fill-green-500" xmlns="http://www.w3.org/2000/svg" height="22"
                    viewBox="0 96 960 960" width="24">
                    <path
                        d="m344 996-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm94-278 226-226-56-58-170 170-86-84-56 56 142 142Z" />
                    </svg>
                    @endif
                </div>

                 <span class="text-sm">
                   @foreach (Auth()->user()->roles as $role )
                       {{ $role->name }}
                   @endforeach
                    • {{  Auth()->user()->faculty == null ? '' : Auth()->user()->faculty->name }}
                </span>
            </div>
        </div>

        <div class="flex p-5 pt-0 bg-white">
            <div class="shadow-md bg-gray-100 rounded-lg w-full p-5">
                <div class="flex justify-between mb-2">
                    <h1 class="text-xs">With {{ Auth()->user()->faculty->name, }}</h1>
                    <input type="text" placeholder="Search name..." class="text-xs rounded">
                </div>
                <div class="overflow-y-scroll 2xl:h-[46vh] xl:h-[40vh]">
                <table class="min-w-full divide-y divide-gray-200 ">
                    <thead>
                      <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Faculty name</th>
                      </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach ($facultyUsers as $facultyUser )
                            <tr class="hover:bg-gray-200">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="relative h-10 w-10 ">
                                      <img class="rounded-full" src="{{ (!empty($facultyUser->avatar))? url('upload/image-folder/profile-image/'. $facultyUser->avatar): url('upload/profile.png') }}">
                                    </div>
                                    <div >
                                      <div class="font-medium text-gray-700 text-left text-xs">{{ $facultyUser->name }}</div>
                                      <div class="text-gray-400 text-xs">{{ $facultyUser->email }}</div>
                                    </div>
                                </th>

                                <td class="px-4 py-4 whitespace-nowrap text-[.7rem] text-gray-800">
                                    @foreach ($facultyUser->roles as $role )
                                    {{ $role->name }}
                                    @endforeach
                                </td>
                              </tr>
                        @endforeach

                    </tbody>

                  </table>
                </div>
            </div>
        </div>

    </section>
</x-app-layout>

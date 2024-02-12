<div class="h-[100vh] bg-gradient-to-t from-blue-500 to-blue-800 fixed xl:w-[12rem] 2xl:w-[14rem]">

    <div class="flex items-center py-3 justify-between px-4 xl:px-0 xl:justify-center space-x-2">
        <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" width="45" class="logo">
        <a class="text-lg font-bold tracking-wider text-yellow-400" href="{{ route('lnu') }}">UniCESS</a>
        <button class="close-button lg:block xl:hidden">
            <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{--  Nav Section  --}}
    <nav class="flex-grow pr-2 pl-2 pb-4 space-y-2 md:block md:pb-0 navigation text-xs">

        @unlessrole('admin|New User')
            <x-custom-nav-link :href="route('User-dashboard.index')" :active="request()->routeIs('User-dashboard*')" class="dynamic-link">
                <svg class="fill-white mr-2 " xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 96 960 960"
                    width="30">
                    <path
                        d="M120 216h330v330H120V216Zm60 59v188-188Zm330-59h330v330H510V216Zm83 59v188-188ZM120 606h330v330H120V606Zm60 81v189-189Zm465-81h60v135h135v60H705v135h-60V801H510v-60h135V606Zm-75-330v210h210V276H570Zm-390 0v210h210V276H180Zm0 390v210h210V666H180Z" />
                </svg>{{ __('Dashboard') }}</x-custom-nav-link>



            <x-custom-nav-link :href="route('allProposal.index')" :active="request()->routeIs('allProposal*')" class="dynamic-link">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960"
                    width="30">
                    <path
                        d="M180-120q-24 0-42-18t-18-42v-600q0-24 18-42t42-18h462l198 198v462q0 24-18 42t-42 18H180Zm0-60h600v-428.571H609V-780H180v600Zm99-111h402v-60H279v60Zm0-318h201v-60H279v60Zm0 159h402v-60H279v60Zm-99-330v171.429V-780v600-600Z" />
                </svg>
                {{ __('All Projects') }}
            </x-custom-nav-link>



            <x-custom-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory*')" class="dynamic-link">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 96 960 960"
                    width="30">
                    <path
                        d="M140 896q-23 0-41.5-18.5T80 836V316q0-23 18.5-41.5T140 256h281l60 60h339q23 0 41.5 18.5T880 376H455l-60-60H140v520l102-400h698L833 850q-6 24-22 35t-41 11H140Zm63-60h572l84-340H287l-84 340Zm0 0 84-340-84 340Zm-63-460v-60 60Z" />
                </svg>
                {{ __('My Inventory') }}
            </x-custom-nav-link>


            {{--  <x-custom-nav-link :href="route('report.index')" :active="request()->routeIs('report*')" class="dynamic-link">

                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="currentColor" d="m213.66 66.34l-40-40A8 8 0 0 0 168 24H88a16 16 0 0 0-16 16v16H56a16 16 0 0 0-16 16v144a16 16 0 0 0 16 16h112a16 16 0 0 0 16-16v-16h16a16 16 0 0 0 16-16V72a8 8 0 0 0-2.34-5.66M168 216H56V72h76.69L168 107.31v84.85zm32-32h-16v-80a8 8 0 0 0-2.34-5.66l-40-40A8 8 0 0 0 136 56H88V40h76.69L200 75.31Zm-56-32a8 8 0 0 1-8 8H88a8 8 0 0 1 0-16h48a8 8 0 0 1 8 8m0 32a8 8 0 0 1-8 8H88a8 8 0 0 1 0-16h48a8 8 0 0 1 8 8"/></svg>
                {{ __('My Documents') }}
            </x-custom-nav-link>  --}}



            {{--  <x-custom-nav-link :href="route('points-system.index')" :active="request()->routeIs('points-system*')" class="dynamic-link">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960"
                    width="30">
                    <path
                        d="M479.765-340Q538-340 579-380.765q41-40.764 41-99Q620-538 579.235-579q-40.764-41-99-41Q422-620 381-579.235q-41 40.764-41 99Q340-422 380.765-381q40.764 41 99 41Zm.235 60q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM70-450q-12.75 0-21.375-8.675Q40-467.351 40-480.175 40-493 48.625-501.5T70-510h100q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T170-450H70Zm720 0q-12.75 0-21.375-8.675-8.625-8.676-8.625-21.5 0-12.825 8.625-21.325T790-510h100q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T890-450H790ZM479.825-760Q467-760 458.5-768.625T450-790v-100q0-12.75 8.675-21.375 8.676-8.625 21.5-8.625 12.825 0 21.325 8.625T510-890v100q0 12.75-8.675 21.375-8.676 8.625-21.5 8.625Zm0 720Q467-40 458.5-48.625T450-70v-100q0-12.75 8.675-21.375 8.676-8.625 21.5-8.625 12.825 0 21.325 8.625T510-170v100q0 12.75-8.675 21.375Q492.649-40 479.825-40ZM240-678l-57-56q-9-9-8.629-21.603.37-12.604 8.526-21.5 8.896-8.897 21.5-8.897Q217-786 226-777l56 57q8 9 8 21t-8 20.5q-8 8.5-20.5 8.5t-21.5-8Zm494 495-56-57q-8-9-8-21.375T678.5-282q8.5-9 20.5-9t21 9l57 56q9 9 8.629 21.603-.37 12.604-8.526 21.5-8.896 8.897-21.5 8.897Q743-174 734-183Zm-56-495q-9-9-9-21t9-21l56-57q9-9 21.603-8.629 12.604.37 21.5 8.526 8.897 8.896 8.897 21.5Q786-743 777-734l-57 56q-8 8-20.364 8-12.363 0-21.636-8ZM182.897-182.897q-8.897-8.896-8.897-21.5Q174-217 183-226l57-56q8.8-9 20.9-9 12.1 0 20.709 9Q291-273 291-261t-9 21l-56 57q-9 9-21.603 8.629-12.604-.37-21.5-8.526ZM480-480Z" />
                </svg>
                {{ __('My Points') }}
            </x-custom-nav-link>  --}}



            <x-custom-nav-link :href="route('evaluate.index')" :active="request()->routeIs('evaluate*')" class="dynamic-link">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960"
                    width="30">
                    <path
                        d="m434-255 229-229-39-39-190 190-103-103-39 39 142 142ZM220-80q-24 0-42-18t-18-42v-680q0-24 18-42t42-18h361l219 219v521q0 24-18 42t-42 18H220Zm331-554v-186H220v680h520v-494H551ZM220-820v186-186 680-680Z" />
                </svg>
                {{ __('My Evaluations') }}
            </x-custom-nav-link>

            <x-custom-nav-link :href="route('trash.index')" :active="request()->routeIs('trash*')" class="dynamic-link">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="#ffffff" fill-rule="evenodd" d="M10.31 2.25h3.38c.217 0 .406 0 .584.028a2.25 2.25 0 0 1 1.64 1.183c.084.16.143.339.212.544l.111.335a1.25 1.25 0 0 0 1.263.91h3a.75.75 0 0 1 0 1.5h-17a.75.75 0 0 1 0-1.5h3.09a1.25 1.25 0 0 0 1.173-.91l.112-.335c.068-.205.127-.384.21-.544a2.25 2.25 0 0 1 1.641-1.183c.178-.028.367-.028.583-.028m-1.302 3a2.757 2.757 0 0 0 .175-.428l.1-.3c.091-.273.112-.328.133-.368a.75.75 0 0 1 .547-.395a3.2 3.2 0 0 1 .392-.009h3.29c.288 0 .348.002.392.01a.75.75 0 0 1 .547.394c.021.04.042.095.133.369l.1.3l.039.112c.039.11.085.214.136.315z" clip-rule="evenodd"/><path fill="#ffffff" d="M5.915 8.45a.75.75 0 1 0-1.497.1l.464 6.952c.085 1.282.154 2.318.316 3.132c.169.845.455 1.551 1.047 2.104c.591.554 1.315.793 2.17.904c.822.108 1.86.108 3.146.108h.879c1.285 0 2.324 0 3.146-.108c.854-.111 1.578-.35 2.17-.904c.591-.553.877-1.26 1.046-2.104c.162-.813.23-1.85.316-3.132l.464-6.952a.75.75 0 0 0-1.497-.1l-.46 6.9c-.09 1.347-.154 2.285-.294 2.99c-.137.685-.327 1.047-.6 1.303c-.274.256-.648.422-1.34.512c-.713.093-1.653.095-3.004.095h-.774c-1.35 0-2.29-.002-3.004-.095c-.692-.09-1.066-.256-1.34-.512c-.273-.256-.463-.618-.6-1.302c-.14-.706-.204-1.644-.294-2.992z"/><path fill="#ffffff" d="M9.425 10.254a.75.75 0 0 1 .821.671l.5 5a.75.75 0 0 1-1.492.15l-.5-5a.75.75 0 0 1 .671-.821m5.15 0a.75.75 0 0 1 .671.82l-.5 5a.75.75 0 0 1-1.492-.149l.5-5a.75.75 0 0 1 .82-.671"/></svg>
                {{ __('My Trash') }}
            </x-custom-nav-link>
        @endunlessrole
    </nav>
</div>

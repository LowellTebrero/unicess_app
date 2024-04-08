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

        @unlessrole('super-admin|admin|New User')
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

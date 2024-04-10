
<x-app-layout>
    @section('title', 'All Projects | ' . config('app.name', 'UniCESS'))
    @if (Auth::user()->authorize == 'checked')
        @unlessrole('super-admin|admin|New User')

            <section class="h-full rounded-xl relative bg-white text-gray-700">
                <div>
                    <livewire:user-lists-project>
                </div>

            </section>

        @endunlessrole

    @elseif (Auth::user()->authorize == 'close')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                Your account have been declined for some reason, <br> the admin is reviewing your account details
                <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
            </h1>
        </div>

    @elseif (Auth::user()->authorize == 'pending')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                You are not authorize yet, <br> Please fill-out your Profile Information
                <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
            </h1>
        </div>
    @endif




</x-app-layout>


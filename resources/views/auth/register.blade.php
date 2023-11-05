<x-guest-layout>

       <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2 xl:space-y-0 ">
            <div class=" mb-8 xl:mb-4">
            <h1 class="text-4xl py-2 xl:text-lg 2xl:text-4xl">Sign-up </h1>
            <h3 class="text-gray-600 xl:text-xs 2xl:text-base">Please enter your account credentials to proceed</h3>

        </div>
        <div class="">

            <div class="w-full mt-2">
                <x-input-label class="lg:text-xs inline-block" for="name" :value="__('User Name')"/><span class="inline-block text-xs text-red-500">*</span>
                <x-text-input id="name" class="lg:text-xs xl:text-sm block  w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>


            <!-- Email -->
            <div class="mt-4 w-full">
               <x-input-label class="lg:text-xs inline-block" for="email " :value="__('Email')" /><span class="inline-block text-xs text-red-500">*</span>
               <x-text-input id="email" class="lg:text-xs xl:text-sm block  w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
               <x-input-error :messages="$errors->get('email')" class="mt-2" />
           </div>

            <div class="mt-4 w-full">
                <x-input-label class="lg:text-xs" for="password" :value="__('Password')" />

                <x-text-input id="password" class="lg:text-xs xl:text-sm block  w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 w-full">
                <x-input-label class="lg:text-xs" for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class=" lg:text-xs xl:text-sm block  w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>


            <div class="flex items-center justify-center mt-4 ">
                <x-primary-button class="w-full">
                    {{ __('Sign-up') }}
                </x-primary-button>
            </div>
        </div>



        {{--  <div class="flex flex-col items-center py-10  xl:py-2">

          <h1 class="py-2 text-sm">Or Login with</h1>
            @if (Route::has('register'))
            <a href={{ route('google.login') }} class="text-white bg-red-500 hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                <svg class="w-4 h-4 mr-2 ml-1  " aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                 Google
              </a>
            @endif
        </div>  --}}


</form>

</x-guest-layout>

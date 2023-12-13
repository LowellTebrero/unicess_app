<x-guest-layout>

       <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2 xl:space-y-0 ">
            <div class=" mb-8 xl:mb-4">
            <h1 class="text-4xl py-2 xl:text-lg 2xl:text-4xl">Sign-up </h1>
            <h3 class="text-gray-600 xl:text-xs 2xl:text-base">Please enter your account credentials to proceed</h3>
        </div>

        <div>

            <div class="w-full mt-2">
                <x-input-label class="lg:text-xs inline-block" for="name" :value="__('User Name')"/><span class="inline-block text-xs text-red-500">*</span>
                <x-text-input id="name" class="lg:text-xs xl:text-sm block  w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <span id="username-error" class="error-message"></span>
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



</form>

</x-guest-layout>

    <script>
        var usernameInput = document.getElementById('name');
        var errorMessage = document.getElementById('username-error');

        usernameInput.addEventListener('input', function() {
            // Remove spaces from the input value
            var cleanedValue = usernameInput.value.replace(/\s/g, '');
            usernameInput.value = cleanedValue;

            // Check if the cleaned username contains spaces
            if (cleanedValue.indexOf(' ') !== -1) {
                errorMessage.textContent = 'Username cannot contain spaces.';
                usernameInput.setCustomValidity('Username cannot contain spaces.');
            } else {
                errorMessage.textContent = '';
                usernameInput.setCustomValidity('');
            }
        });
    </script>



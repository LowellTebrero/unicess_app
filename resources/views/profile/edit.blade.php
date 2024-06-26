@hasrole('admin|super-admin')
    <x-admin-layout>

        @section('title', 'Profile | ' . config('app.name', 'UniCESS'))

        <div class="w-full sm:px-6 lg:px-8 p-5 rounded-lg">

            <div class="w-full mx-auto sm:px-6 lg:px-8 xl:px-0 2xl:px-5 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-full">
                        @include('profile.partials.update-auth-profile-information')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{--  <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>  --}}
            </div>
        </div>
    </x-admin-layout>
@else
    <x-app-layout>

        @section('title', 'Profile | ' . config('app.name', 'UniCESS'))

        <div class="w-full mx-auto sm:px-6 lg:px-8  xl:px-0 2xl:px-10 p-10 rounded-lg">

            <div class="w-full mx-auto sm:px-6 space-y-6">

                <div class="p-10 bg-white shadow sm:rounded-lg ">
                    @include('profile.partials.update-auth-profile-information')
                </div>

                @if (Auth::user()->password == null)
                @else
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-full">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                @endif


                {{--  @hasrole('admin')
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                @endrole  --}}
            </div>
        </div>
    </x-app-layout>
@endrole

    <style>[x-cloak] {display: none}</style>


    <section class="flex flex-col lg:flex-row space-y-10 lg:space-y-0 ">

        @if ($errors->any())
        @foreach ($errors->all() as $error)
          <?php flash()->addError($error); ?>
        @endforeach
        @endif

        <div class="basis-1/3 flex flex-col sm:flex-row lg:flex-col space-x-5  lg:space-x-0 justify-center items-center h-1/2 ">

            <div class="relative flex justify-center ">

                <div class="w-[7rem] md:w-[8rem] lg:w-[10rem] 2xl:w-[20rem]">
                    <img class="rounded-full border-4 border-blue-500 w-2/3" id="showImage"
                        src="{{!empty($user->avatar) ? url('upload/image-folder/profile-image/' . $user->avatar) : url('upload/profile.png') }}"
                    width="500" height="500">
                </div>

                <div class="absolute bottom-0 z-10 2xl:right-[5rem] right-[2rem] bg-blue-500 rounded-full w-[2rem] h-[4vh] xl:w-[3rem] flex items-center justify-center">
                    <button class="p-1 absolute" type="button">
                        <svg class="fill-white w-[1.3rem] xl:w-[1.5rem]" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path
                                d="M17.5 12a5.5 5.5 0 1 1 0 11a5.5 5.5 0 0 1 0-11Zm0 2l-.09.008a.5.5 0 0 0-.402.402L17 14.5V17h-2.502l-.09.009a.5.5 0 0 0-.402.402l-.008.09l.008.09a.5.5 0 0 0 .402.402l.09.008H17v2.503l.008.09a.5.5 0 0 0 .402.402l.09.008l.09-.008a.5.5 0 0 0 .402-.402l.008-.09V18h2.504l.09-.007a.5.5 0 0 0 .402-.402l.008-.09l-.008-.09a.5.5 0 0 0-.403-.402l-.09-.008H18v-2.5l-.008-.09a.5.5 0 0 0-.402-.403L17.5 14ZM13.925 2.504a2.25 2.25 0 0 1 1.94 1.11l.814 1.387h2.071A3.25 3.25 0 0 1 22 8.25v4.56A6.478 6.478 0 0 0 17.5 11c-.416 0-.823.039-1.218.114a4.501 4.501 0 1 0-5.254 5.78A6.51 6.51 0 0 0 12.022 21H5.25A3.25 3.25 0 0 1 2 17.75v-9.5A3.25 3.25 0 0 1 5.25 5h2.08l.875-1.424a2.25 2.25 0 0 1 1.917-1.073h3.803ZM12 9.5a3 3 0 0 1 2.85 2.063a6.52 6.52 0 0 0-3.512 3.862A3 3 0 0 1 12 9.501Z" />
                        </svg>
                    </button>
                    <input type="file" class=" right-32 w-10 opacity-0" name="avatar" id="avatarInput">
                </div>
            </div>

            <div class="flex flex-col lg:mt-4">

                <div x-cloak x-data="{ 'showModal': false }" @keydown.escape="showModal = false">

                    <div class="w-full lg:mt-8 ">
                        <div class="flex justify-between">
                            <div>
                                <x-input-label class="text-xs inline-block" for="role" :value="__('Your Role')" />
                                <span class="inline-block text-xs text-red-500">*</span>
                            </div>

                            <!-- Trigger for Modal -->
                            @hasrole('admin')
                            @else
                            <button class="text-xs text-red-600" type="button" @click="showModal = true">Edit</button>
                            @endrole
                        </div>

                            {{--  Modal Starts here  --}}
                            <!-- Modal -->
                            <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                x-show="showModal">

                                <!-- Modal inner -->
                                <div class="w-1/4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                    x-transition:enter="motion-safe:ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-90"
                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    @click.away="showModal = false">


                                    <!-- Title / Close-->
                                    <div class="flex items-center justify-between mb-5 px-4 py-1">
                                        <h5 class="mr-3 text-black max-w-none">Update Role</h5>
                                        <button type="button"
                                            class=" z-50 cursor-pointer text-red-500 text-xl font-semibold"
                                            @click="showModal = false">X</button>
                                    </div>
                                    <hr>

                                    <!-- content -->
                                    <div class="w-full px-5 py-1 mt-2">

                                        <form action="{{ route('profile.update-role-faculty', $user->id) }}" method="POST">
                                            @csrf @method('PATCH')

                                            <div class="form-group mb-6 mt-5">
                                                <select onchange="yesnoCheck(this)" id="role" name="role"
                                                    class=" w-full px-3 py-1.5 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                                    transition ease-in-ou m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">

                                                    @foreach ($role as $id => $name)
                                                        <option value="{{ $name }}"
                                                            @if ($user->roles->contains($id)) selected  @class(['bg-blue-500']) @endif>
                                                            {{ $name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('role')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="mt-4 w-full">

                                                <div id="facultyId">
                                                    <x-input-label  class="lg:text-xs " for="faculty_id" :value="__('Faculty Name')" />

                                                    <select id="faculty_id"
                                                        class="greeting lg:text-xs xl:text-sm block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900 "
                                                        type="text" name="faculty_id" autofocus autocomplete="faculty_id">

                                                        @foreach ($faculties as $id => $name)
                                                            <option value="{{ $id }}"
                                                                @if ($id == old('faculty_id', $user->faculty_id)) selected="selected" @endif>
                                                                {{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-6 mt-6" id="submit">
                                                    <button type="submit"
                                                        class=" w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight
                                                    uppercase shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                                    active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out rounded-xl">Submit</button>
                                                </div>
                                        </form>
                                        <x-input-error :messages="$errors->get('faculty_id')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>


                    <div class="lg:mt-2">
                        <div class=" flex flex-wrap">
                            @if ($user->roles)
                                @foreach ($user->roles as $user_role)
                                    <h1 class="text-xs 2xl:text-base"> {{ $user_role->name }} </h1>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 lg:mt-7 space-y-1">
                        @if ($user->faculty == !null)

                        @hasrole('admin')
                        @else
                        <h1 class="text-xs">Faculty Name:</h1>
                        <h1 class="text-xs 2xl:text-base">{{ $user->faculty->name }}</h1>
                        @endrole
                        @elseif ($user->partners == !null)


                            <h1 class="text-xs">Partners Name:</h1>
                            <h1 class="">{{ $user->partners->partners_name }}</h1>
                        @elseif ($user->partners == null && $user->faculty == null)
                            <h1 class="text-sm">&nbsp;</h1>
                        @endif


                    </div>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    <x-input-error :messages="$errors->get('faculty_id')" class="mt-2" />
                </div>
            </div>
        </div>


        <div class="flex-1 space-y-6 px-0 xl:px-10 text-gray-900 ">

            <form method="post" action="{{ route('profile.partials.update-auth-profile', $user->id) }}"
                enctype="multipart/form-data">
                @csrf @method('patch')


                <header class="flex flex-col">
                    <h2 class="2xl:text-3xl xl:text-xl font-semibold text-blue-500 tracking-wider">
                        {{ __('Profile Information') }}
                    </h2>

                    <p class=" 2xl:text-sm text-xs text-red-400">
                        {{ __('*required fields ') }}
                    </p>
                </header>



                <div class="w-full pt-5">
                    <label class="2xl:text-lg text-sm tracking-wider font-medium text-gray-700">Basic
                        Information</label>
                    <hr class="mt-2">
                </div>


                <div class="flex flex-col my-4">
                    <label
                        class="inline-block font-medium text-gray-900  tracking-wide text-xs 2xl:text-sm">Complete
                        Name <span class="text-red-600 inline-block">*</span></label>
                    <div class="flex space-y-2 sm:space-y-0 sm:space-x-4 flex-col sm:flex-row ">

                        <div class="w-full">
                            <x-text-input id="first_name" name="first_name" type="text"
                                class="mt-1 block  w-full text-xs 2xl:text-sm" :value="old('first_name', $user->first_name)"
                                autocomplete="first_name" placeholder="First Name" />

                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>
                        <div class="w-full">

                            <x-text-input id="middle_name" name="middle_name" type="text"
                                class="mt-1 block w-full text-xs 2xl:text-sm" :value="old('middle_name', $user->middle_name)"
                                autocomplete="middle_name" placeholder="Middle Name" />
                            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                        </div>
                        <div class="w-full">

                            <x-text-input id="last_name" name="last_name" type="text"
                                class="mt-1 block w-full text-xs 2xl:text-sm" :value="old('last_name', $user->last_name)"
                                autocomplete="last_name" placeholder="Last Name" />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>
                    </div>
                </div>

                <div class="my-4 flex space-y-2 sm:space-y-0 sm:space-x-4 flex-col sm:flex-row ">
                    <div class="w-full">
                        <label
                            class="inline-block font-medium text-gray-900  tracking-wide text-xs 2xl:text-sm">Suffix</label>
                        <x-text-input id="suffix" name="suffix" type="text"
                            class="mt-1 block w-full text-xs 2xl:text-sm" :value="old('suffix', $user->suffix)"
                            placeholder="e.g. Jr. III" />
                        <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
                    </div>


                    <div class="w-full">
                        <label
                            class="inline-block font-medium text-gray-900 tracking-wide text-xs 2xl:text-sm"
                            for="first_name">User Name <span class="text-red-600 inline-block">*</span></label>
                        <x-text-input id="name" name="name" type="text"
                            class="mt-1 block w-full text-xs 2xl:text-sm" :value="old('name', $user->name)"
                            autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="flex space-y-2 sm:space-y-0 sm:space-x-4 flex-col sm:flex-row  my-4 ">
                    <div class="w-full">
                        <label
                            class="inline-block font-medium text-gray-900 tracking-wide text-xs 2xl:text-sm"
                            for="gender">Gender<span class="text-red-600 inline-block">*</span></label>
                        <select id="gender" name="gender"
                            class="mt-1 border-b-2 border-blue-500 block w-full rounded-md shadow-sm text-xs 2xl:text-sm"
                            autocomplete="gender">
                            <option value="">Choose Gender</option>
                            <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>
                            <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>
                            <option value="Prefer not to say"
                                {{ old('gender', $user->gender) == 'Prefer not to say' ? 'selected' : '' }}>
                                Prefer not to say
                            </option>
                        </select>

                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>

                    <div class="w-full">
                        <label
                            class="inline-block font-medium text-gray-900 tracking-wide text-xs 2xl:text-sm"
                            for="birth_date">Birth Date <span class="text-red-600 inline-block">*</span></label>
                        <x-text-input id="birth_date" name="birth_date" type="date"
                            class="mt-1 block  w-full text-xs 2xl:text-sm" :value="old('birth_date', $user->birth_date)"
                            autocomplete="birth_date" />
                        <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                    </div>
                </div>

                <div class="w-full pt-7">
                    <label class="font-medium text-gray-700 2xl:text-lg text-sm tracking-wider ">Contact Information</label>
                    <hr class="mt-2">
                </div>


                <div class="flex space-y-2 sm:space-y-0 sm:space-x-12 flex-col sm:flex-row my-4">
                    <div class="w-full">
                        <label class="block font-medium text-gray-900 tracking-wide text-xs 2xl:text-sm"
                            for="email">Email Address</label>

                        <h1 class="mt-3  inline-block mr-1 text-xs 2xl:text-sm">{{ $user->email }}</h1>
                        <span class="inline-block">
                            <svg class="fill-green-500" xmlns="http://www.w3.org/2000/svg" height="20"
                                viewBox="0 96 960 960" width="24">
                                <path
                                    d="m344 996-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm94-278 226-226-56-58-170 170-86-84-56 56 142 142Z" />
                            </svg>
                        </span>


                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="w-full xl:text-xs 2xl:text-sm">
                        <label
                            class="inline-block font-medium text-gray-900 tracking-wide text-xs 2xl:text-sm">Contact Number <span class="text-red-600 inline-block">*</span></label>

                        <div class="border rounded-md flex  bg-blue-500">
                            <h1 class="p-2 bg-blue-500 text-white rounded-tl rounded-bl text-xs 2xl:text-sm">+63</h1>

                            <x-text-input id="contact_number" name="contact_number" type="text"
                                class="w-full text-xs 2xl:text-sm text-gray-600 border-b-2 border-blue-500  focus:border-none focus:ring-slate-200"
                                :value="old('contact_number', $user->contact_number)" autocomplete="contact_number" onkeypress="return isNumber(event)"
                                placeholder="e.g. 917xxxxxxx" maxlength="11" />
                        </div>

                        <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                    </div>
                </div>

                <div class="my-4">
                    <label class="inline-block font-medium text-gray-900 tracking-wide text-xs 2xl:text-sm"> Current Home Address
                        <span class="text-red-600 inline-block">*</span>
                    </label>


                    <div class="flex space-y-2 sm:space-y-0 sm:space-x-4 flex-col sm:flex-row ">
                        <div class="w-full">

                            <x-text-input id="province" name="province" type="text"
                                class="mt-1 block w-full  text-xs 2xl:text-sm" :value="old('province', $user->province)"
                                autocomplete="province" placeholder="Province" />
                            <x-input-error class="mt-2" :messages="$errors->get('province')" />
                        </div>

                        <div class="w-full">

                            <x-text-input id="city" name="city" type="text"
                                class="mt-1 block w-full text-xs 2xl:text-sm" :value="old('city', $user->city)"
                                autocomplete="city" placeholder="City" />
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>

                        <div class="w-full">

                            <x-text-input id="barangay" name="barangay" type="text"
                                class="mt-1 block w-full  text-xs 2xl:text-sm" :value="old('barangay', $user->barangay)"
                                autocomplete="barangay" placeholder="Barangay" />
                            <x-input-error class="mt-2" :messages="$errors->get('barangay')" />
                        </div>
                    </div>
                </div>

                <div class="flex space-y-2 sm:space-y-0 sm:space-x-4 flex-col sm:flex-row  my-4">
                    <div class="w-full">

                        <x-text-input id="address" name="address" type="text"
                            class="mt-1 block w-full text-xs 2xl:text-sm" :value="old('address', $user->address)"
                            autocomplete="address" placeholder="Address" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                    <div class="w-full sm:w-1/4">

                        <x-text-input id="zipcode" name="zipcode" type="text"
                            class="mt-1 block w-full text-xs 2xl:text-sm" :value="old('zipcode', $user->zipcode)"
                            autocomplete="zipcode" onkeypress="return isNumber(event)" placeholder="Zip Code" />
                        <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button onclick="yesnoCheck(answer); return false;">
                        {{ __('Update Profile') }}</x-primary-button>
                    {{--  <button type="submit">Save</button>  --}}


                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>




    <x-messages />
</section>

    <script>
        $('#avatarInput').on('change', function() {
            var formData = new FormData();
            formData.append('avatar', this.files[0]);

            $.ajax({
                url: '{{ route('image.store', $user->id) }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    window.location.reload();
                },
                error: function(error) {

                    console.error('Error:', error);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#avatar').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result).css('width', '500px').css('heigth',
                        '500px');
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });



        function yesnoCheck(answer) {

            console.log(answer.value)
            if (answer.value == 'Faculty extensionist' || answer.value == 'Extension coordinator') {
                document.getElementById('facultyId').style.display = 'block';
                document.getElementById('submit').style.display = 'block';
                document.getElementById('faculty_id').innerHTML =
                    '@foreach ($faculties as $id => $name) <option value="{{ $id }}" @if ($id == old('faculty_id')) selected="selected" @endif >{{ $name }}</option> @endforeach';

            } else {
                document.getElementById('facultyId').style.display = 'none';
                document.getElementById('submit').style.display = 'none';
                document.getElementById('faculty_id').innerHTML = '<option></option>';
                document.getElementById('faculty_id').value = "";
            }

        }
    </script>


    {{--  Phone Number Javascript  --}}
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>

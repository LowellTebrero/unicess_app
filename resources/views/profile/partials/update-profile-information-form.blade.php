    @php
    $role = Spatie\Permission\Models\Role::orderBy('name')->whereNotIn('name',['admin'])->whereNotIn('name',['New User'])->get();
    $faculties = App\Models\Faculty::orderBy('name')->pluck('name', 'id')->prepend('Select Faculty', '');
    $users = App\Models\User::with('faculty')->get();
    @endphp

    <style>
        [x-cloak] { display: none }
    </style>

<section>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="flex">


        <div class="basis-1/3 flex flex-col items-center  space-y-10">



                <div class="relative  flex justify-center ">
                    <div class=" w-2/3 ">
                    <img class="rounded-full" id="showImage" src="{{ (!empty($user->avatar))? url('upload/image-folder/'. $user->avatar): url('upload/profile-1.png') }}" alt="">
                    </div>
                    <button class="absolute right-32  bottom-2 bg-white border-4 border-gray-800 rounded-full p-1" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M200 856h56l345-345-56-56-345 345v56Zm572-403L602 285l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829 396l-57 57Zm-58 59L290 936H120V766l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/></svg>
                    </button>
                    <input type="file" class="absolute   bottom-2 right-32 w-10 opacity-0" name="avatar" id="avatar" >
                    <span id="img_error"></span>
                </div>


             <div class="flex flex-col ">
                <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" >

                <div class="w-full">
                    <div class="flex justify-between">
                    <div><x-input-label class="lg:text-xs inline-block" for="role" :value="__('Your Role')" /> <span class="inline-block text-xs text-red-500">*</span></div>

                    <!-- Trigger for Modal -->
                    <button class="text-xs text-red-600" type="button" @click="showModal = true">Edit</button>
                    </div>

                        {{--  Modal Starts here  --}}
                        <!-- Modal -->
                    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                        <!-- Modal inner -->
                        <div class="w-1/4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                    x-transition:enter="motion-safe:ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-90"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    @click.away="showModal = false">


                        <!-- Title / Close-->
                        <div class="flex items-center justify-between mb-5 px-4 py-1">
                            <h5 class="mr-3 text-black max-w-none">Update Role</h5>
                            <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                        </div>
                        <hr>

                        <!-- content -->
                        <div class="w-full px-5 py-1 mt-2">

                            <form action="{{ route('profile.update-role-faculty', $user->id) }}"  method="POST">
                                @csrf  @method('PATCH')

                                <div class="form-group mb-6 mt-5">
                                <select onchange="yesnoCheck(this)" id="role" name="role" class=" w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                                transition ease-in-ou m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">


                                {{--  @foreach ($role as $id => $name )
                                <option value="{{ $name }}" @if($user->roles->contains($id)) selected  @class(['bg-blue-500'])  @endif>{{ $name }}</option>
                                @endforeach  --}}
                                @foreach ($role as $roles )
                                <option value="{{ $roles->name }}" @if($user->roles->contains($roles->id)) selected  @class(['bg-blue-500'])  @endif>{{ $roles->name }}</option>
                                    @endforeach
                                </select>

                                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div class="mt-4 w-full  " id="facultyId" >
                                    <x-input-label onchange="" class="lg:text-xs " for="faculty_id" :value="__('Faculty Name')" />

                                    <select id="faculty_id" class="greeting lg:text-xs xl:text-sm block mt-1 w-full rounded-md shadow-sm border-gray-300 text-gray-900 " type="text" name="faculty_id"   autofocus autocomplete="faculty_id">

                                        @foreach ($faculties as $id => $name )
                                        <option value="{{ $id }}"
                                        @if ($id == old('faculty_id' , $user->faculty_id ))
                                            selected="selected"
                                        @endif
                                        >{{ $user->faculty == null ? '' : $user->faculty->name  }}</option>
                                        @endforeach


                                    </select>
                                    <div class="form-group mb-6 mt-6">
                                        <button type="submit" class=" w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight
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

                    <div class="mt-2">
                        <div class=" flex flex-wrap">
                            @if ($user->roles)
                            @foreach ($user->roles as $user_role )
                            <h1> {{ $user_role->name }} </h1>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="mt-7 space-y-2">
                     <h1 class="text-xs">Faculty Name:</h1>
                    <h1 class="">{{ $user->faculty == null ? 'Benifciary/Partners' : $user->faculty->name  }}</h1>
                    </div>


                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    <x-input-error :messages="$errors->get('faculty_id')" class="mt-2" />
                </div>


                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" >
                    @csrf
                    @method('patch')



            </div>
        </div>


        <div class="flex-1 space-y-6">



    <header>
        <h2 class="text-4xl font-semibold text-gray-700">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-red-600">
            {{ __("*required fields ") }}
        </p>
    </header>



        <div class="w-full pt-5">
            <label class="text-xl font-semibold text-gray-700">Basic Information</label>
            <hr class="mt-2">
        </div>


        <div class="flex flex-col">
            <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="first_name">  Complete Name <span class="text-red-600 inline-block">*</span></label>
        <div class="flex space-x-4">

        <div class="w-full">

            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full text-slate-600" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" placeholder="First Name" />
            <x-input-error class="mt-2 " :messages="$errors->get('first_name')" />
        </div>
        <div class="w-full">

            <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full text-slate-600" :value="old('middle_name', $user->middle_name)" required autofocus autocomplete="middle_name" placeholder="Middle Name" />
            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
        </div>
        <div class="w-full">

            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full text-slate-600" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name"  placeholder="Last Name"/>
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>
     </div>
    </div>

     <div class="flex space-x-4">
        <div class="w-full">
            <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="first_name">Suffix</label>
            <x-text-input id="suffix" name="suffix" type="text" class="mt-1 block w-full text-slate-600" :value="old('suffix', $user->suffix)"  placeholder="e.g. Jr. III" />
            <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
        </div>

         <div class="w-full">
            <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="first_name">Recipeint Name <span class="text-red-600 inline-block">*</span></label>
            <x-text-input id="recipient_name" name="recipient_name" type="text" class="mt-1 block w-full text-slate-600" :value="old('recipient_name', $user->recipient_name)" required autofocus autocomplete="recipient_name" />
            <x-input-error class="mt-2" :messages="$errors->get('recipient_name')" />
        </div>

         <div class="w-full">
            <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="first_name">User Name <span class="text-red-600 inline-block">*</span></label>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-slate-600" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>
    </div>

     <div class="flex space-x-12">
        <div class="w-full">
            <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="gender">Gender<span class="text-red-600 inline-block">*</span></label>
                <select id="gender" name="gender" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 text-slate-600" required autofocus autocomplete="gender">
                       <option>Choose Gender</option>
                        <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>
                            Male
                        </option>
                        <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>
                            Female
                        </option>
                        <option value="Prefer not to say" {{ old('gender', $user->gender) == 'Prefer not to say' ? 'selected' : '' }}>
                            Prefer not to say
                        </option>
                 </select>

            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

         <div class="w-full">
            <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="birth_date">Birth Date <span class="text-red-600 inline-block">*</span></label>
            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block  w-full text-slate-600" :value="old('birth_date', $user->birth_date)" required autofocus autocomplete="birth_date" />
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')"/>
        </div>
    </div>

    <div class="w-full pt-7">
        <label class="text-xl font-semibold text-gray-700">Contact Information</label>
        <hr class="mt-2">
    </div>


    <div class="flex space-x-12">
        <div class="w-full ">
            <label class="block font-medium text-gray-900 text-sm tracking-wide" for="email">Email Address</label>

            <h1 class="mt-3 text-sm inline-block mr-1">{{$user->email}}</h1>
            <span class="inline-block ">
                <svg class="fill-green-500   " xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 96 960 960" width="24"><path d="m344 996-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm94-278 226-226-56-58-170 170-86-84-56 56 142 142Z"/></svg>
            </span>


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

        <div class="w-full">
            <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="first_name">Contact Number <span class="text-red-600 inline-block">*</span></label>

            <div class="border rounded-md flex">
            <div class=""><h1 class="p-2 bg-slate-600 text-white rounded-tl  rounded-bl mr-1">63+</h1></div>
            <x-text-input id="contact_number" name="contact_number" type="text" class="w-full  text-gray-600 border-none  focus:border-none focus:ring-slate-200 " :value="old('contact_number', $user->contact_number)" required autofocus autocomplete="contact_number" onkeypress="return isNumber(event)" placeholder="e.g. 917xxxxxxx" />
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
        </div>
    </div>

    <div>
        <label class="inline-block font-medium text-gray-900 text-sm tracking-wide" for="first_name">  Current Home Address <span class="text-red-600 inline-block">*</span></label>


    <div class="flex space-x-10">
        <div class="w-full">

            <x-text-input id="province" name="province" type="text" class="mt-1 block w-full text-slate-600" :value="old('province', $user->province)" required autofocus autocomplete="province" placeholder="Province" />
            <x-input-error class="mt-2" :messages="$errors->get('province')" />
        </div>

        <div class="w-full">

            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full text-slate-600" :value="old('city', $user->city)" required autofocus autocomplete="city"  placeholder="City" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div class="w-full">

            <x-text-input id="barangay" name="barangay" type="text" class="mt-1 block w-full text-slate-600" :value="old('barangay', $user->barangay)" required autofocus autocomplete="barangay"  placeholder="Barangay" />
            <x-input-error class="mt-2" :messages="$errors->get('barangay')" />
        </div>
    </div>
</div>

<div class="flex space-x-12">
    <div class="w-full">

        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full text-slate-600" :value="old('address', $user->address)" required autofocus autocomplete="address"  placeholder="Address" />
        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    </div>
    <div class="w-full">

        <x-text-input id="zipcode" name="zipcode" type="text" class="mt-1 block w-full text-slate-600" :value="old('zipcode', $user->zipcode)" required autofocus autocomplete="zipcode" onkeypress="return isNumber(event)"  placeholder="Zip Code" />
        <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
    </div>
</div>

<div class="flex items-center gap-4">
    <x-primary-button onclick="yesnoCheck(answer); return false;" > {{ __('Save') }}</x-primary-button>


    @if (session('status') === 'profile-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600"
        >{{ __('Saved.') }}</p>
    @endif
</div>
</div>

</section>



    </form>


   <x-messages/>
</section>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script type="text/javascript">
        $('#avatar').on('change', function(ev){
            console.log('here inside');

            var filedata=this.files[0];
            var imgtype=filedata.type;

            var match=['image/png','image/jpg'];

            if(!(imgtype==match[0]) || (imgtype==match[1])){
                $('#img_error').html('<p style="color:red">Please select valid type of image. only jpeg/jpg allowed</p>')
            }else{
                $('#img_error').empty();
                var reader =new FileReader();
                reader.onload=function(ev){
                    $('#showImage').attr('src', ev.target.result);
                }

                reader.readAsDataURL(this.files[0]);

                var postData=new FormData();
                var url = '{{ route("ajaxuploadimg", ":id") }}';
                postData.append('file', this.files[0]);



                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                    async:true,
                    type:"post",
                    contentType:false,
                    url: url,
                    data:postData,
                    processData:false,
                    success:function(){
                      console.log("success");
                    }
                })
            }

        })
    </script>


        <script type="text/javascript">

            function yesnoCheck(answer){

                console.log(answer.value)
                if(answer.value == 'Faculty extensionist' || answer.value == 'Extension coordinator' ){
                  document.getElementById('faculty_id').innerHTML = '@foreach ($faculties as $id => $name ) <option value="{{ $id }}" @if ($id == old('faculty_id')) selected="selected" @endif >{{ $name }}</option> @endforeach';

                }else {
                   document.getElementById('faculty_id').innerHTML = '<option></option>';
                    document.getElementById('faculty_id').value = "";
                }
            }
        </script>


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



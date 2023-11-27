@php
    $id = Auth::user()->id;
    $user = App\Models\User::find($id);
@endphp

<x-welcome-user-layout>
<section class="flex flex-col items-center space-y-4">
   <h1 class="text-5xl text-yellow-400 font-medium">Hello! Welcome to UniCESS</h1>
   <h4 class="tracking-wider font-medium pb-5">Let's setup your Profile Information before we proceed to homepage</h4>
   <a class="bg-blue-500 px-10 py-5 rounded-lg hover:bg-blue-600 text-white font-medium" href={{ route('profile.partials.edit-auth-profile', $user->id) }}>
    Get started
   </a>
</section>


</x-welcome-user-layout>

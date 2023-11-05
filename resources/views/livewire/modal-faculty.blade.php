<section class="bg-white">

    <div wire:ignore.self class="flex justify-between p-2 ">
    <h1 class="text-slate-600 px-3 text-lg">Add faculty</h1>
    <button class=" text-red-500 font-bold text-lg mr-3" wire:click="$emit('closeModal')">X</button>
    </div>
    <hr>
    <div class="flex w-full p-5">
        <form wire:submit.prevent="saveFaculty" class="w-full">

            <div class="mb-3  w-full">
                <label class="text-gray-500" for="name">Faculty name:</label>
                <input type="text" wire:model="name" name="name" class="w-full rounded-md outline-none outline-0">
                @error('name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="w-full">
                <button class="bg-blue-500 text-white p-2 rounded-md w-full"  type="submit">Submit</button>
            </div>
        </form>
    </div>

    <x-messages/>

</section>


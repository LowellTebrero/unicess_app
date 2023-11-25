<x-alpine-modal>

    <x-slot name="scripts" class="">
        <h1 class="text-sm bg-blue-400 hover:bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-sm xl:text-xs">+ Create Article</h1>
    </x-slot>

    <x-slot name="title">
        <h1>Create Article</h1>
    </x-slot>

    <div class="w-full px-5 py-1 mt-2">

    <div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">


    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>

        <form x-on:company-added.window="showModal = false"  wire:submit.prevent="saveArticle" >
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title"> Title </label>
                <input  wire:model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description"> Description </label>
                <textarea  wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" placeholder=""></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6  flex flex-col">
                @if ($feature_image)
                <img src="{{ $feature_image->temporaryUrl() }}" width="100">
                @endif
                {{--  <img src="" id="showImage" alt="">  --}}
                <label class="block text-gray-700 text-sm font-bold mb-2" for="feature_image"> Image </label>
                <input type="file" id="feature_image" wire:model="feature_image" class="shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="feature_image">
                @error('feature_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between ">
                {{--  <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">Create Article</button>
                  --}}

                  <button wire:click="saveArticle" wire:loading.attr="disabled" wire:target="saveArticle" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    <span wire:loading.remove>Create Article</span>
                    <span wire:loading>Loading...</span>
                </button>
            </div>

            {{--  @push('scripts')
                <script>
                    Livewire.on('articleSaved', () => {
                        // This code will run after the Livewire component emits the 'articleSaved' event
                        window.location.href = '/admin/features'; // Redirect to a new page
                    });
                </script>
            @endpush  --}}

        </form>
    </div>
    </div>
</x-alpine-modal>











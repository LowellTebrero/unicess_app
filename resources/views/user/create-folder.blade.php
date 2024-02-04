<x-app-layout>


    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white m-5">

        <form method="POST" action="{{ route('folder.store') }}">
            @csrf
            <div class="form-group">
                <label for="folderName">Folder Name:</label>
                <input type="text" id="folderName" name="folder_name" class="form-control" required>
            </div>
            <button type="submit" class="btn bg-blue-500 p-2 rounded">Create Folder</button>
        </form>
    </div>


    <div class="bg-white m-5 p-10">
        {{--  @foreach ($folders as $folder)
        <p>{{ basename($folder)  }}</p>
        @endforeach  --}}

        @foreach ($folders as $folder)
        <p><a href="{{ asset('public/storage/' . $folder) }}">{{ basename($folder) }}</a></p>
        @endforeach
    </div>

</x-app-layout>

    <style>
        [x-cloak] { display: none }
        form button:disabled,
        form button[disabled]{
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }
    </style>

<x-admin-layout>

    <section class="bg-white shadow rounded-xl h-full">

            <div class="flex justify-between p-4">
                <h1 class="tracking-wider text-xs sm:text-sm">Project Title: {{ Str::limit($proposals->project_title,20) }} </h1>
                <a class="text-red-500 text-xl font-bold focus:bg-gray-300 rounded" href="{{ URL::previous() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
            <hr>

            <div class="w-full flex flex-col">
                @include('admin.inventory.show-inventory-filter._filter_option-show-inventory')
                <div class="flex px-5 py-3 items-center xl:flex-wrap 2xl:flex-nowrap">
                @include('admin.inventory.show-inventory-filter._table_show_inventory')
                </div>
            </div>
    </section>
    <x-messages/>
</x-admin-layout>


    <script>
        $('input[type=file]').on('input', function() {
            var allFilesEmpty = true;

            // Iterate over all file inputs
            $('input[type=file]').each(function() {
                if ($(this).val() !== '') {
                    allFilesEmpty = false;
                    return false; // exit the loop early if any file input has a value
                }
            });

            // Set the disabled property of the button based on the condition
            $('#upload-file').prop('disabled', allFilesEmpty);
        });

    </script>

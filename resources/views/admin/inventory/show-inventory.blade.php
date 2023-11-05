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

    <section class="bg-white shadow rounded-xl min-h-[87vh] m-8 mt-5">

            <div class="flex justify-between p-4">
                <h1 class="tracking-wider text-sm">Project Title: {{ $proposals->project_title }} </h1>
                <a class="text-red-500 text-xl font-bold focus:bg-gray-300 rounded" href={{ route('admin.inventory.proposal-show', $proposals->programs->id) }}>
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
    $('input[type=file]').change(function(){
        if($('input[type=files]').val()==''){
            $('button').attr('disabled',true)

        }
        else{
        $('button').attr('disabled',false);

        }
    })
    </script>

<div class="pl-5 py-2 space-x-2 flex justify-start">

    {{--  Upload  --}}
    <x-alpine-modal>

        <x-slot name="scripts">
            <div class="bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-xs xl:text-xs flex">Upload</div>
        </x-slot>

        <x-slot name="title">
        upload files
        </x-slot>

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
        <div class=" px-5 py-1 mt-5 flex flex-col">

            <div class="flex flex-col mb-4">
                <label for="" class="text-sm font-light  mb-1">Memorandum of Agreement PDF</label>
                <input type="file" name="moa" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
            </div>


            <div class="flex flex-col  mb-4">
                <label for="" class="text-sm font-light  mb-1">Travel order PDF</label>
                <input type="file" name="travel_order" class="text-xs text-slate-700 border  file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
            </div>

            <div class="flex flex-col  mb-4">
                <label for="" class="text-sm font-light  mb-1">Office order PDF</label>
                <input type="file" name="office_order"  class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
            </div>

            <div class="flex flex-col  mb-4">
                <label for="" class="text-sm font-light  mb-1">Other Files</label>
                <input type="file" multiple name="other_files[]" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
            </div>

            <div class="mb-2">
                <button class="bg-blue-500  text-white rounded-md p-2" type="submit" disabled >Upload File</button>
            </div>

        </div>
        </form>
    </x-alpine-modal>


    {{--  Download  --}}
    <a class="bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-xs xl:text-xs flex" href={{ url('download', $proposals->id) }}>
        <svg class="fill-white mr-1" xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 96 960 960" width="20"><path d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z"/></svg>
        Download
    </a>


    {{--  Proposal Detail  --}}
    <x-alpine-modal>

        <x-slot name="scripts">
            <div class="bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-xs xl:text-xs flex">Proposal Details</div>
        </x-slot>

        <x-slot name="title">
            Proposal Details
        </x-slot>

        <div class="w-2/1 p-4 border-r">
            <div class="flex space-y-3 flex-col mb-2">

                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title"> Program Title</label>
                    <input type="text" disabled class=" xl:text-xs  appearance-none border-b-2 border-indigo-500  rounded bg-white shadow w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                    value = "{{$proposals->programs->program_name}}">
                </div>

                <div class="w-full">

                    <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-xs" for="title"> Project Title</label>
                    <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                    value = "{{$proposals->project_title}}">
                </div>
            </div>

            <div class="flex space-x-4 mb-2">
                <div class="w-full ">

                    <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title"> Started date:</label>
                    <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                    value = "{{ \Carbon\Carbon::parse($proposals->started_date)->format("F-d-Y")}}">
                </div>

                <div class="w-full">

                    <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title">  Finished date:</label>
                    <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                    value = "{{ \Carbon\Carbon::parse($proposals->finished_date)->format("F-d-Y")}}">
                </div>
            </div>

            <div class="flex space-x-3 mb-2">
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title">Project Leader</label>
                    <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                    value = "{{$proposals->project_title}}">
                </div>
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title">Uploaded at:</label>
                    <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                    value = "{{\Carbon\Carbon::parse($proposals->created_at)->format("F-d-Y")}}">
                </div>
            </div>
        </div>
    </x-alpine-modal>
</div>

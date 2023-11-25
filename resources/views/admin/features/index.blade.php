  <x-admin-layout>
    <style>[x-cloak] { display: none }</style>

    <section class="mt-5 m-8 bg-white 2xl:min-h-[87vh] h-[85vh] rounded-lg">

        <div class="py-4 p-5">
            <h1 class="text-2xl text-slate-600 tracking-wider font-semibold">Article Section</h1>
        </div>
        <hr>
        <div class="m-5">
            <div>
                <livewire:article>
            </div>

            @if ($features->isEmpty())
            @else
            <div class="bg-white sm:rounded-lg border mt-5">

                <div class="flex flex-col">
                <div class="overflow-x-auto 2xl:h-[70vh]">
                        <table class="w-full">
                        <thead class=" ">
                          <tr class="text-gray-600 bg-slate-100">
                            <th scope="col" class="text-md  px-6 py-4 text-left font-medium xl:text-sm w-[2rem]">Created</th>
                            <th scope="col" class="text-md  px-2 py-4 text-left font-medium xl:text-sm"> Title </th>
                            <th scope="col" class="text-md  px-2 py-4 text-left font-medium xl:text-sm w-[8rem]"> Image </th>
                            <th scope="col" class="text-md  px-2 py-4 text-right font-medium xl:text-sm w-[3rem]"> Status </th>
                            <th scope="col" class="text-md  pr-4 py-4 text-right font-medium xl:text-sm w-[2rem]"> Action </th>
                          </tr>
                          @endif
                        </thead>
                        <tbody class="divide-y divide-gray-100 ">
                            @foreach ($features as $feature )

                            <tr class="hover:bg-slate-100">

                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 w-[2rem]">
                                    <a href="{{ route('admin.features.edit', $feature->id) }}" class="text-xs">
                                        {{ \Carbon\Carbon::parse($feature->created_at)->format('M d, Y,  g:i:s A')}}
                                    </a>
                                </td>

                                <td class="text-xs text-gray-900 font-light px-2 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.features.edit', $feature->id) }}">
                                    {{ Str::limit($feature->title, 70) }}
                                    </a>
                                </td>

                                {{--  <td class="px-6 py-4 w-[7rem]">
                                    <a href="{{ route('admin.features.edit', $feature->id) }}">
                                    <img class="rounded" src="{{ (!empty($feature->feature_image))? url('upload/image-folder/features-folder/'. $feature->feature_image): url('upload/no-image.png') }}">
                                    </a>
                                </td>  --}}

                                <td class="p-3 whitespace-nowrap">
                                    <a href="{{ route('admin.features.edit', $feature->id) }}">
                                    <div class="text-left text-gray-700">
                                        <img class="rounded-lg" width="100" src="{{ (!empty($feature->feature_image))? url('upload/image-folder/features-folder/'. $feature->feature_image): url('upload/no-image.png') }}">
                                    </div>
                                    </a>
                                </td>

                                <td class="text-sm text-green-600 font-light text-right px-2 py-4 whitespace-nowrap">
                                    <input class="feature-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                    type="checkbox"  data-feature-id="{{ $feature->id }}" data-feature-status="{{ $feature->status }}" {{ $feature->status == 'open' ? 'checked' : '' }} />
                                    {{--  <input type="checkbox" class="feature-checkbox" data-feature-id="{{ $feature->id }}" data-feature-status="{{ $feature->status }}" {{ $feature->status == 'open' ? 'checked' : '' }}>  --}}
                                </td>

                                <td class="text-sm text-blue-500 font-light  text-right pr-4 py-4 my-auto whitespace-nowrap ">
                                  <form action="{{ route('admin.features.delete', $feature->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-right" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                    </button>
                                    </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </section>

</x-admin-layout>

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $('.feature-checkbox').on('change', function() {
            var checkbox = $(this);
            var featureId = checkbox.data('feature-id');
            var status = checkbox.prop('checked') ? 'open' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.features.update-feature-status') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    feature_id: featureId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>

    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>


    <script type="text/javascript">

        $(document).ready(function(){
            $('#feature_image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>





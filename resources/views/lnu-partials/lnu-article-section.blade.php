<section class="flex items-center justify-center  article-bg w-full relative overflow-hidden flex-col">
<h1 class="text-white lg:text-2xl font-semibold tracking-wider text-xl">Featured Articles</h1>

    <div class="flex flex-col  space-y-3  lg:space-y-0 lg:space-x-5 xl:space-x-10 p-5 py-3 sm:p-10 sm:space-x-5 sm:space-y-0  sm:flex-row">
        @foreach ($features as $feature )

        <div class="bg-white flex flex-row sm:flex-col  sm:w-[8.5rem] md:w-[10rem]  lg:w-[12rem] xl:w-[15rem]  relative ">
            <div class="sm:h-[15vh] h-[9vh] lg:h-[18vh] xl:h-[20vh]">
                <img id="feature_image" class="h-[100%]" src="{{ (!empty($feature->feature_image))? url('upload/image-folder/features-folder/'. $feature->feature_image): url('upload/no-image.png') }}" alt="">
            </div>

            <div class="p-2 sm:h-[16vh] md:h-[14vh] lg:h-[15vh] xl:h-[15vh] w-full">
               <h1 class="text-blue-900 font-semibold sm:text-[.6rem] xl:text-sm text-[.6rem]">{{Str::limit($feature->title, 99) }}</h1>
               {{--  <h1 class="text-blue-900 font-bold xl:text-sm">{!! Str::limit($feature->description, 120) !!}</h1>  --}}
            </div>

            <p class="text-[.6rem] text-gray-400 sm:text-[.6rem] lg:text-xs xl:text-sm absolute bottom-1 sm:left-2 right-2"> {{ $feature->created_at->diffForHumans() }}</p>
            <div class="bg-yellow-500 w-full h-1 absolute bottom-0"></div>
        </div>
        @endforeach
    </div>

    <a href={{ route('lnu-additional-partials.features-additionals') }} class="text-white underline underline-offset-8 mt-2 text-sm md:text-base">Read more</a>

</section>

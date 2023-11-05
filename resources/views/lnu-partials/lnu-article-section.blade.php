<section class="flex items-center justify-center  article-bg w-full relative overflow-hidden flex-col p-5  ">
<h1 class="text-white text-2xl mb-10 mt-5 font-semibold">FEATURED ARTICLES</h1>

    <div class=" flex flex-col  space-y-5  lg:space-y-0 lg:flex-row lg:space-x-10 xl:space-x-10 p-10 md:space-x-0  md:flex-col xl:flex-row">
        @foreach ($features as $feature )

        <div class=" bg-white flex flex-col 2xl:w-[15rem]  lg:w-[15rem] relative justify-between">
            <div class="h-[20vh]">
            <img id="feature_image" class="h-[100%]" src="{{ (!empty($feature->feature_image))? url('upload/image-folder/features-folder/'. $feature->feature_image): url('upload/no-image.png') }}" alt="">
            </div>
            <div class="p-3">
               <h1 class="text-blue-900 font-bold xl:text-sm mb-2">{{Str::limit($feature->title, 99) }}</h1>
               <h1 class="text-blue-900 font-bold xl:text-sm">{!! Str::limit($feature->description, 120) !!}</h1>

            </div>
            <div class="p-3"> <p class="text-sm pt-2 text-gray-400"> {{ $feature->created_at->diffForHumans() }}</p></div>
            <div class="bg-yellow-500 w-full h-1 absolute bottom-0"></div>
        </div>
        @endforeach
</div>

<a href={{ route('lnu-additional-partials.features-additionals') }} class="text-white underline underline-offset-8 mt-5">Read more</a>

</section>

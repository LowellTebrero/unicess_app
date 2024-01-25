<section class="flex items-center justify-center  article-bg w-full relative overflow-hidden flex-col">
<h1 class="text-white lg:text-2xl font-semibold tracking-wider text-xl">Featured Articles</h1>

    <div class="grid grid-cols  sm:grid-cols-4 gap-5 py-4 content-center">
        @foreach ($articles as $article )

        <div class="bg-white flex flex-row sm:flex-col  sm:w-[8.5rem] md:w-[10rem]  lg:w-[12rem] xl:w-[15rem]  relative rounded overflow-hidden">
            <div class="">
                <img id="article_image" class="h-[100%]" src="{{ (!empty($article->image))? url('upload/image-folder/features-folder/'. $article->image): url('upload/no-image.png') }}">
            </div>

            <div class="p-2 sm:h-[16vh] md:h-[14vh] lg:h-[15vh] xl:h-[15vh] w-full">
               <h1 class="text-blue-900 font-semibold sm:text-[.6rem] xl:text-sm text-[.6rem]">{{Str::limit($article->title, 50) }}</h1>
               {{--  <h1 class="text-blue-900 font-bold xl:text-sm">{!! Str::limit($feature->description, 120) !!}</h1>  --}}
            </div>

            <p class="text-[.6rem] text-gray-400 sm:text-[.6rem] lg:text-xs xl:text-sm absolute bottom-1 sm:left-2 right-2"> {{ $article->created_at->diffForHumans() }}</p>
            <div class="bg-yellow-500 w-full h-1 absolute bottom-0"></div>
        </div>
        @endforeach
    </div>

    <a href={{ route('lnu-additional-partials.features-additionals') }} class="text-white underline underline-offset-8 mt-2 text-sm md:text-base">Read more</a>

</section>

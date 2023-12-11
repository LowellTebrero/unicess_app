<div class="bg-gradient-to-r from-blue-800 to-blue-700 h-10"></div>
    <section class="min-h-[80vh] bg-slate-200 flex flex-col md:flex-col lg:flex-col xl:flex-row lg:items-center xl:pb-10 2xl:pb-0 ">

        {{--  Latest Events  --}}
        <div class="w-full md:w-full lg:w-full min-h-[70vh] lg:pl-10 md:pl-0 md:justify-center ">
            <div class="lg:w-full px-10 relative">
             <h1 class="text-blue-700 font-semibold text-2xl  pt-5 pb-10 underline underline-offset-8 text-center md:tex-center  lg:text-left xl:text-3xl 2xl:text-4xl">Latest Events</h1>

                    <div id="default-carousel" class="relative w-full h-[30vh] md:h-[40vh] lg:h-[60vh]" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-[30vh] md:h-[40vh] lg:h-[60vh] overflow-hidden rounded-lg   ">

                            @foreach ($slider as $event )
                            <!-- Item 1 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>

                                <img src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                                <div class="bg-gradient-to-t from-blue-800/90 via-blue-800/55  w-full h-full absolute top-0 rounded-lg"></div>
                                <div class="p-5 flex flex-col absolute bottom-8 z-30 rounded-lg">
                                    <h1 class="text-white text-xs xl:text-sm 2xl:text-md font-light tracking-wider flex justify-between">{{ $event->title }}</h1>
                                    <a class="text-white text-xs xl:text-lg outline outline-offset-1 outline-1 w-[8rem] mt-6 rounded text-center" href={{ route('lnu-additional-partials.event-additionals') }}>Learn more</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Slider indicators -->
                        <div class="absolute z-40  flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">


                            @foreach ($slider as $event )
                            <button type="button" class="w-3 h-3 rounded-full bg-gray-500" aria-current="false" aria-label="Slide {{ $event->id }}" data-carousel-slide-to=" {{ $event->id }}"></button>

                            @endforeach
                        </div>
                        <!-- Slider controls -->
                        <button type="button" class="left-0 absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class=" right-0 absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
            </div>
        </div>




        {{--  Latest News  --}}
        <div class=" pl-10 z-10 md:w-full lg:w-full  xl:min-h-screen 2xl:min-h-screen  relative">
        </div>
    </section>


{{--
    <script type="text/javascript">
        var counter = 1;
        setInterval(function(){
          document.getElementById('radio' + counter).checked = true;
          counter++;
          if(counter > 4){
            counter = 1;
          }
        }, 5000);
    </script>  --}}





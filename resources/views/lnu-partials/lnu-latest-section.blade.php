<div class="bg-gradient-to-r from-blue-800 to-blue-700 h-10"></div>
    <section class="min-h-[80vh] bg-slate-200 flex flex-col md:flex-col lg:flex-col xl:flex-row lg:items-center xl:pb-10 2xl:pb-0 ">

        {{--  Latest Events  --}}
        <div class="w-full md:w-full lg:w-full min-h-[70vh] lg:pl-10 md:pl-0 md:justify-center ">
            <div class=" lg:w-full min-h-[70vh] px-10 relative">
             <h1 class="text-blue-700 font-semibold text-5xl  pt-5 pb-10 underline underline-offset-8 text-center md:tex-center lg:text-left xl:text-2xl 2xl:text-5xl">Latest Events</h1>

                <div class="lg:w-full min-h-[50vh] slider overflow-hidden rounded-lg relative drop-shadow-lg md:w-full 2xl:w-4/5">



                    <!--Image slide start -->
                    {{--  w-[171rem] min-h-[50vh]  --}}

                    <div class=" h-full overflow-hidden flex slides rounded-lg">

                        <!--radio buttons start-->
                        <input type="radio" name="radio-btn" id="radio1">
                        <input type="radio" name="radio-btn" id="radio2">
                        <input type="radio" name="radio-btn" id="radio3">
                        <input type="radio" name="radio-btn" id="radio4">
                        <!--radio buttons end-->


                        @php $i = 'open'; @endphp
                        @foreach ($slider as $event )

                        <div class="slide relative {{ $i == 'open' ?  'first': '' }} w-full rounded-lg ">
                            @php $i++; @endphp
                        <img id="showImage" class="rounded-lg"src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}">

                        <div class="bg-gradient-to-t from-blue-800/90 via-blue-800/55  w-full h-full absolute top-0 rounded-lg"></div>

                        <div class=" p-5 flex flex-col absolute bottom-8 z-30 rounded-lg">

                            <h1 class="text-white xl:text-sm 2xl:text-lg font-light flex justify-between">{{ $event->title }}</h1>

                                {{--  <p class="md:text-md lg:text-lg text-white shadow-lg mt-3">{!! Str::limit($event->description, 280) !!}</p>  --}}

                                <a  class="text-white text-lg outline outline-offset-2 outline-2 w-28 mt-6 rounded-lg text-center" href={{ route('lnu-additional-partials.event-additionals') }}>Learn more</a>

                            </div>
                        </div>
                        @endforeach

                        <div class="navigation-auto  w-full flex justify-center">
                            <div class="auto-btn1"></div>
                            <div class="auto-btn2"></div>
                            <div class="auto-btn3"></div>
                            <div class="auto-btn4"></div>
                          </div>
                          <!--automatic navigation end-->
                        </div>
                          <!--Image slide end -->


                    <!--manual navigation start-->
                    <div class="navigation-manual w-full flex justify-center">
                      <label for="radio1" class="manual-btn"></label>
                      <label for="radio2" class="manual-btn"></label>
                      <label for="radio3" class="manual-btn"></label>
                      <label for="radio4" class="manual-btn"></label>

                  </div>
                    <!--manual navigation end-->
                  </div>
                  <!--automatic navigation start-->



                </div>
            </div>


        {{--  Latest News  --}}
        <div class=" pl-10 z-10 md:w-full lg:w-full  xl:min-h-screen 2xl:min-h-screen  relative">

        </div>
    </section>



    <script type="text/javascript">
        var counter = 1;
        setInterval(function(){
          document.getElementById('radio' + counter).checked = true;
          counter++;
          if(counter > 4){
            counter = 1;
          }
        }, 5000);
    </script>





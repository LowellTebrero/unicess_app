@extends('layouts\lnuAdd')


@section('content')

<section  class="min-h-[60vh] w-[90%] mx-auto ">
    <div class="py-5 w-full">
        <h1 class="font-semibold bg-yellow-500 p-2 text-white inline-block">Events Section</h1>
        <hr class="border-yellow-500 border-4">
    </div>
    <div class="row">


        <div class="col-md-6 col-xl-4">
            <div class="card mb-3  ">
            <div class="overflow-hidden">
              <img src="{{ (!empty($events->image))? url('upload/image-folder/event-folder/'. $events->image): url('upload/no-image.png') }}" class="card-img-top"  alt="...">
            </div>
              <div class="card-body">
                <p class="card-text my-2"><small class="text-muted">All Right Reserved 2023 ©</small></p>
                {{--  <span class="flex justify-end "><a href={{ route('lnu-show-details.show-events', $events->id) }} class="text-sm p-2 border rounded-lg" >Read more</a></span>  --}}
              </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-8">
            <div class="card mb-3 ">

              <div class="card-body">
                <h5 class="card-title font-semibold text-4xl mb-3">{{$events->title}}</h5>

                    <p class="card-text text-sm p-tag w-full">{!! $events->description !!}</p>

                <p class="card-text my-2"><small class="text-muted">{{ $events->created_at->diffForHumans() }}</small></p>
                {{--  <span class="flex justify-end "><a href={{ route('lnu-show-details.show-events', $events->id) }} class="text-sm p-2 border rounded-lg" >Read more</a></span>  --}}
              </div>
            </div>
        </div>

    </div>
</section>

@endsection

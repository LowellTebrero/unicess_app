@extends('layouts.lnuAdd')


@section('content')

<section  class="min-h-[60vh] w-[90%] mx-auto">
    <div class="py-5 w-full ">
        <h1 class="font-semibold bg-yellow-500 p-2 text-white inline-block">Events Section</h1>
        <hr class="border-yellow-500 border-4">
    </div>
    <div class="row">
        @foreach ($events as $event )

        <div class="col-md-6 col-xl-3">
            <div class="card flex flex-col justify-between">
            <div class="overflow-hidden">
              <a href={{ route('lnu-show-details.show-event', $event->id) }}><img src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}" class="card-img-top images"  alt="..."></a>
            </div>
              <div class="card-body">
                <h5 class="card-title text-sm font-normal">{{Str::limit($event->title,100)}}</h5>
                {{--  <p class="card-text text-xs">{!! Str::limit($event->description, 230) !!}</p>  --}}
                <p class="card-text my-2"><small class="text-muted">{{ $event->created_at->diffForHumans() }}</small></p>
                <span class="flex justify-end "><a href={{ route('lnu-show-details.show-event', $event->id) }} class="text-sm p-2 border rounded-lg" >Read more</a></span>
              </div>
            </div>
        </div>
          @endforeach
    </div>
</section>

@endsection

@extends('layouts.lnuAdd')


@section('content')

<section  class="min-h-[60vh] w-[90%] mx-auto">
    <div class="py-5 w-full ">
        <h1 class="font-semibold bg-yellow-500 p-2 text-white inline-block">Events Section</h1>
        <hr class="border-yellow-500 border-4">
    </div>
    <div class="grid lg:grid-cols-2 xl:grid-cols-4 gap-4 w-full">
        @foreach ($events as $event )

        <div class="border flex flex-col justify-between ">
            <div class="overflow-hidden">
                <a href={{ route('lnu-show-details.show-event', $event->id) }}>
                    <img src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}" class="images">
                </a>
            </div>
            <div class="flex flex-col p-2  justify-betweens">
              <h5 class="">{{Str::limit($event->title,100)}}</h5>
              <small class="">{{ $event->created_at->diffForHumans() }}</small>
              <a href={{ route('lnu-show-details.show-event', $event->id) }} class="">Read more</a>
            </div>
        </div>



        {{--  <div class="col-md-6 col-xl-3 bg-red-500">
            <div class="card">
                <div class="overflow-hidden">
                    <a href={{ route('lnu-show-details.show-event', $event->id) }}>
                        <img src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}" class="card-img-top images">
                    </a>
                </div>
                <div class="card-body d-flex flex-column  justify-content-between">
                    <h5 class="card-text">{{Str::limit($event->title,100)}}</h5>
                    <p class=""><small class="text-muted">{{ $event->created_at->diffForHumans() }}</small></p>
                    <span class=""><a href={{ route('lnu-show-details.show-event', $event->id) }} class="text-sm  border rounded-lg" >Read more</a></span>
                </div>
            </div>
        </div>  --}}
          @endforeach
    </div>
</section>

@endsection

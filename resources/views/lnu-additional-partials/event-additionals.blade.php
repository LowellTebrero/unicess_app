@extends('layouts.lnuAdd')


@section('content')

<section  class="min-h-[60vh] w-[90%] mx-auto">
    <div class="py-5 w-full ">
        <h1 class="font-semibold bg-yellow-500 p-2 text-white inline-block">Events Section</h1>
        <hr class="border-yellow-500 border-4">
    </div>
    <div class="row bg-red-500">


        @foreach ($events as $event )

        <div class="card  col-md-6 col-lg-6 col-xl">

                <div class="overflow-hidden">
                    <a href={{ route('lnu-show-details.show-event', $event->id) }}>
                        <img src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}" class="card-img-top images">
                    </a>
                </div>
                <div class="card-body d-flex flex-column  justify-content-between">
                  <h5 class="card-title">{{Str::limit($event->title,100)}}</h5>
                  <p class="card-text text-muted"><small class="text-muted">{{ $event->created_at->diffForHumans() }}</small></p>
                  <a href={{ route('lnu-show-details.show-event', $event->id) }} class="btn btn-primary">Read more</a>
                </div>
        </div>

        @endforeach



    </div>
</section>

@endsection


{{--  <div class="overflow-hidden">
    <a href={{ route('lnu-show-details.show-event', $event->id) }}>
        <img src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}" class="images">
    </a>
</div>
<div class="flex flex-col p-2  justify-betweens">
<h5 class="">{{Str::limit($event->title,100)}}</h5>
<small class="">{{ $event->created_at->diffForHumans() }}</small>
<a href={{ route('lnu-show-details.show-event', $event->id) }} class="">Read more</a>
</div>  --}}

@extends('layouts.lnuAdd')


@section('content')

<section  class="min-h-[60vh] w-[90%] mx-auto">
    <div class="py-5 w-full ">
        <h1 class="font-semibold bg-yellow-500 p-2 text-white inline-block">Events Section</h1>
        <hr class="border-yellow-500 border-4">
    </div>
    <div class="row bg-red-500">


            <div class="border bg-blue-500 col">
                lowell
            </div>
            <div class="border bg-blue-500 col">
                lowell
            </div>
            <div class="border bg-blue-500 col">
                lowell
            </div>

    </div>
</section>

@endsection

{{--
@foreach ($events as $event )
@endforeach  --}}
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

@extends('layouts.lnuAdd')

@section('content')

<section  class="min-h-[60vh] w-[90%] mx-auto ">
    <div class="py-5 w-full">
        <h1 class="font-semibold bg-yellow-500 p-2 text-white inline-block">Article Section</h1>
        <hr class="border-yellow-500 border-4">
    </div>
    <div class="row">
        @foreach ($articles as $article )

        <div class="col-md-6 col-xl-3">
            <div class="card mb-3">
                <div class="overflow-hidden">
                <a href={{ route('lnu-show-details.show-article', $article->id) }}><img src="{{ (!empty($article->image))? url('upload/image-folder/features-folder/'. $article->image): url('upload/no-image.png') }}" class="card-img-top images"  alt="..."></a>
                </div>
                <div class="card-body">
                <h5 class="card-title font-semibold">{{Str::limit($article->title, 43)}}</h5>
                <p class="card-text text-xs">{!! Str::limit($article->description, 230) !!}</p>
                <p class="card-text my-2"><small class="text-muted">{{ $article->created_at->diffForHumans() }}</small></p>
                <span class="flex justify-end "><a href={{ route('lnu-show-details.show-article', $article->id) }} class="text-sm p-2 border rounded-lg">Read more</a></span>
              </div>
            </div>
        </div>
          @endforeach
    </div>
</section>

@endsection

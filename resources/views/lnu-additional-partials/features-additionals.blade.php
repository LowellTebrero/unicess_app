@extends('layouts.lnuAdd')

@section('content')

<section  class="min-h-[60vh] w-[90%] mx-auto ">
    <div class="py-5 w-full">
        <h1 class="font-semibold bg-yellow-500 p-2 text-white inline-block">Article Section</h1>
        <hr class="border-yellow-500 border-4">
    </div>
    <div class="grid grid-cols-2 xl:grid-cols-4 2xl:grid-cols-5 gap-3">

        @foreach ($articles as $article )
            <div class="bg-white border shadow-sm m-2 rounded-lg flex justify-between flex-col space-y-4 overflow-hidden">
                <a href={{ route('lnu-show-details.show-article', $article->id) }}>
                    <img src="{{ (!empty($article->image))? url('upload/image-folder/features-folder/'. $article->image): url('upload/no-image.png') }}" class="card-img-top">
                </a>
                <div class="card-body d-flex flex-column  justify-content-between  p-4 pt-0">
                    <h5 class="text-sm tracking-wide">{{Str::limit($article->title,100)}}</h5>
                    <div class="flex flex-col space-y-1 pt-4">
                        <p class="card-text text-muted"><small class="text-muted">{{ $article->created_at->diffForHumans() }}</small></p>
                        <a href={{ route('lnu-show-details.show-article', $article->id) }} class="btn btn-primary">Read more</a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection

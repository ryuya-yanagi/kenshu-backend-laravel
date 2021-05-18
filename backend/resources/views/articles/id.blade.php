@extends('layouts.app')

@section('title'){{ $article->title }}@endsection

@section('content')
<div class="py-5">
    <div id="carouselExampleControls" class="carousel slide w-600px mx-auto" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if (count($article->photos))
            @foreach ($article->photos as $index => $photo)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ $photo->url }}" class="d-block w-100" alt="photo{{ $index + 1 }}" />
            </div>
            @endforeach

            @else
            <div class="carousel-item active">
                <img src="/assets/img/text-only.png" class="d-block w-100" alt="{{ $article->title }}" />
            </div>
            @endif
        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <h2 class="mt-3">
        {{ $article->title }}
    </h2>
    <hr />
    <p>
        {{ $article->body }}
    </p>
    <ul class="d-flex">
        @foreach ($article->tags as $tag)
        <li class="mx-1">
            <a href="/tags/{{ $tag->id }}" class="btn btn-primary">#{{ $tag->name }}</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection

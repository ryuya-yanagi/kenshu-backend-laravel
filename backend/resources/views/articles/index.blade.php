@extends('layouts.app')

@section('title', 'articles')

@section('content')
<div class="py-5">
    <h2>Articles</h2>
    <hr />
    @if (count($articles))
    <ul class="d-flex justify-content-center flex-wrap p-0">
        @foreach ($articles as $article)
        <li class="card w-300px h-400px m-2">
            <a href="/articles/{{ $article->id }}">
                <div class="d-flex align-items-center overflow-hidden w-300px h-200px bg-light border-bottom">
                    @if (isset($article->thumbnail_url))
                    <img src="{{ $article->thumbnail_url }}" class="card-img-top" alt="{{ $article->title }}" />
                    @else
                    <img src="/assets/img/text-only.png" class="card-img-top" alt="{{ $article->title }}" />
                    @endif
                </div>
            </a>
            <div class="card-body">
                <h5 class="card-title"><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h5>
                <p class="card-text h-100px overflow-hidden">{{ $article->body }}</p>
                <hr />
                <a href="/users/{{ $article->user->id }}">{{ $article->user->name }}</a>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'MyPage')

@section('content')
<div class="py-5">
    <h2>{{ $currentUser->name }}</h2>
    <hr />
    @if (count($currentUser->articles))
    <ul class="d-flex justify-content-center flex-wrap p-0">
        @foreach ($currentUser->articles as $article)
        <li class="card w-300px h-400px m-2">
            <div class="d-flex align-items-center overflow-hidden w-300px h-200px bg-light border-bottom">
                <img src="{{ $article->thumbnail->url ?? '/assets/img/text-only.png' }}" class="card-img-top"
                    alt="{{ $article->title }}" />
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <p class="card-text h-100px overflow-hidden">{{ $article->body }}</p>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title'){{ $article->title }}@endsection

@section('content')
<div class="py-5">
    <div class="text-center">
        @if (isset($article->thumbnail_url))
        <img src="{{ $article->thumbnail_url }}" class="h-400px" alt="{{ $article->title }}" />
        @else
        <img src="/assets/img/text-only.png" class="h-400px" alt="{{ $article->title }}" />
        @endif
    </div>
    <h2 class="mt-3">
        {{ $article->title }}
    </h2>
    <hr />
    <p>
        {{ $article->body }}
    </p>
</div>
@endsection

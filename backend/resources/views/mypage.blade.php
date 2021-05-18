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
                <hr class="my-3" />
                <ul class="d-flex">
                    <li class="mx-1">
                        <a href="/articles/{{ $article->id }}" class="btn btn-secondary">詳細</a>
                    </li>
                    <li class="mx-1">
                        <a href="/articles/{{ $article->id }}/edit" class="btn btn-success">編集</a>
                    </li>
                    <li class="mx-1">
                        <form action="/articles/{{ $article->id }}" id="form_{{ $article->id }}" method="post"
                            style="display:inline">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <a href="#" data-id="{{ $article->id }}" onclick="deletePost(this);"
                                class="btn btn-danger">削除</a>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>

<script>
    function deletePost(e) {
        'use strict';

        if (confirm('are you sure?')) {
            document.getElementById('form_' + e.dataset.id).submit();
        }
    }

</script>
@endsection

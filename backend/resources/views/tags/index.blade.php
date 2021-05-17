@extends('layouts.app')

@section('title', 'Tags')

@section('content')
<div class="py-5">
    <ul class="list-group">
        @foreach ($tags as $tag)
        <li>
            <a href="/tags/{{ $tag->id }}" class="list-group-item list-group-item-action">
                <div class="d-flex">
                    <strong>{{ $tag->id }}</strong>
                    &ensp;
                    <span>{{ $tag->name }}</span>
                </div>
                <span>{{ $tag->created_at }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection

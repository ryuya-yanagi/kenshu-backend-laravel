@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="py-5">
    <ul class="list-group">
        @foreach ($users as $user)
        <li>
            <a href="/users/{{ $user->id }}" class="list-group-item list-group-item-action">
                <div class="d-flex">
                    <strong>{{ $user->id }}</strong>
                    &ensp;
                    <span>{{ $user->name }}</span>
                </div>
                <span>{{ $user->created_at }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection

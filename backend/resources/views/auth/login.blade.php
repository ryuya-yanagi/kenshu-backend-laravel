@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="py-5">
    <div class="card w-600px m-auto">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            @if (isset($unauthorized))
            <div class="alert alert-danger" role="alert">{{ $unauthorized }}</div>
            @endif
            <form action="/auth/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

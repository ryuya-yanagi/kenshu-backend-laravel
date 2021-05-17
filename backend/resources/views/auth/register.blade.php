@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="py-5">
    <div class="card w-600px m-auto">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">
            <form action="/auth/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" id="inputName" class="form-control"
                        aria-describedby="nameHelp">
                    @error('name')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="nameHelp" class="form-text">between 4 and 50 characters</span>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control"
                        aria-describedby="passwordHelp">
                    @error('password')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="passwordHelp" class="form-text">6 or more characters</span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

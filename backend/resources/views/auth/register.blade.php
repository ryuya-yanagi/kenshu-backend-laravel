@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="pt-5">
    <div class="card w-600px m-auto">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">
            <form action="/auth/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName" aria-describedby="nameHelp">
                    <div id="nameHelp" class="form-text">between 4 and 50 characters</div>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword"
                        aria-describedby="passwordHelp">
                    <div id="passwordHelp" class="form-text">6 or more characters</div>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection

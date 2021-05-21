@extends('layouts.app')

@section('title', 'New Tag')

@section('content')
<div class="py-5">
    <div class="card w-700px m-auto">
        <div class="card-header">
            New Tag
        </div>
        <div class="card-body">
            <form action="/tags" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" id="inputName" class="form-control"
                        aria-describedby="nameHelp">
                    @error('name')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="titleHelp" class="form-text">between 4 and 50 characters</span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

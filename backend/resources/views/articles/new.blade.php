@extends('layouts.app')

@section('title', 'New Article')

@section('content')
<div class="py-5">
    <div class="card w-700px m-auto">
        <div class="card-header">
            Post Article
        </div>
        <div class="card-body">
            <form action="/articles" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" id="inputTitle" class="form-control"
                        aria-describedby="titleHelp">
                    @error('title')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="titleHelp" class="form-text">between 4 and 50 characters</span>
                </div>
                <div class="mb-3">
                    <label for="inputPhotos" class="form-label">Photos</label>
                    <input type="file" name="files[][photo]" id="inputPhotos" class="form-control" accept="image/*"
                        aria-describedby="photosHelp" multiple>
                    @error('photos')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="photosHelp" class="form-text">optional(multiple)</span>
                </div>
                <div class="mb-3">
                    <label for="inputBody" class="form-label">Body</label>
                    <textarea name="body" id="inputBody" class="form-control" rows="7" cols="33"
                        aria-describedby="bodyHelp">{{ old('body') }}</textarea>
                    @error('body')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="bodyHelp" class="form-text">between 1 and 200 characters</span>
                </div>
                <div class="mb-3">
                    <label for="selectTag" class="form-label">Tag</label>
                    <select class="form-select" id="selectTag" name="tags[]" multiple aria-label="multiple select">
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <span class="form-text">optional(multiple)</span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

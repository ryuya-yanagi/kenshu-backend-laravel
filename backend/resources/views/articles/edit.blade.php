@extends('layouts.app')

@section('title', 'New Article')

@section('content')
<div class="py-5">
    <div class="card w-700px m-auto">
        <div class="card-header">
            Post Article
        </div>
        <div class="card-body">
            <form action="/articles/{{ $article->id }}" method="POST">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <div id="carouselExampleControls" class="carousel slide w-600px mx-auto" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if (count($article->photos))
                            @foreach ($article->photos as $index => $photo)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ $photo->url }}" class="d-block w-100" alt="photo{{ $index + 1 }}" />
                            </div>
                            @endforeach

                            @else
                            <div class="carousel-item active">
                                <img src="/assets/img/text-only.png" class="d-block w-100"
                                    alt="{{ $article->title }}" />
                            </div>
                            @endif
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title') ?? $article->title }}" id="inputTitle"
                        class="form-control" aria-describedby="titleHelp">
                    @error('title')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="titleHelp" class="form-text">between 4 and 50 characters</span>
                </div>
                <div class="mb-3">
                    <label for="inputBody" class="form-label">Body</label>
                    <textarea name="body" id="inputBody" class="form-control" rows="7" cols="33"
                        aria-describedby="bodyHelp">{{ old('body') ?? $article->body }}</textarea>
                    @error('body')
                    <span class="form-text text-danger">{{ $message }}</span><br />
                    @enderror
                    <span id="bodyHelp" class="form-text">between 1 and 200 characters</span>
                </div>
                <div class="mb-3">
                    <ul class="d-flex flex-wrap">
                        @foreach ($article->tags as $tag)
                        <li class="m-1">
                            <span class="btn btn-secondary disabled">#{{ $tag->name }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

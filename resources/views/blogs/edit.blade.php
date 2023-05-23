@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($blog, [
            'method' => 'PATCH',
            'route' => ['blogs.update', $blog->id],
            'class' => 'form',
            'enctype' => 'multipart/form-data',
        ]) !!}
        @csrf
        <h2 class="text-light mb-4">Edit Blog</h2>
        <div class="row mb-3">
            <label for="name">{{ __('Title:') }}</label>

            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                required placeholder="Blog Title" value="{{ $blog->title }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="description">{{ __('Description:') }}</label>

            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                rows="4" cols="50">{{ $blog->description }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="image">{{ __('Image:') }}</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="row mb-0">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

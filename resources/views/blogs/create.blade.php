@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('blogs.store') }}" class="form" enctype="multipart/form-data"
            id="my-dropzone-form">
            @csrf
            <h2 class="text-light mb-4">Create Blog</h2>
            <div class="row mb-3">
                <label for="name">{{ __('Title:') }}</label>

                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    required placeholder="Blog Title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-3 ">
                <label for="description">{{ __('Description:') }}</label>

                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                    rows="4" cols="50"></textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- File input element -->
            <div class="row mb-3">
                <label for="image">{{ __('Upload Image:') }}</label>
                <div class="dropzone-wrapper">
                    <div class="box-body"></div>
                    <div class="dropzone-desc">
                        <i class="fa-solid fa-circle-arrow-down fa-xl"></i>
                        <p>Choose an image file or drag it here.</p>
                    </div>
                    <input type="file" name="image" class="dropzone">
                </div>
            </div>
            <div class="row mb-0">
                <button id="submit-button" type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
@endsection

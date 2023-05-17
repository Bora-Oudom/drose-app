@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('blogs.store') }}" class="form">
            @csrf
            <h2 class="text-light mb-4">Create Blog</h2>
            <div class="row mb-3">
                <label for="name">{{ __('Title:') }}</label>

                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    required>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="description">{{ __('Description:') }}</label>

                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                    rows="4" cols="50"> </textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-0">

                <button type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
@endsection

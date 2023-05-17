@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9 col-lg-9 col-sm-9 d-flex justify-content-center align-items-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- <h2 class="status">{{ __('Welcome Back') }}</h2> --}}
    @foreach ($blogs as $blog)
        <div class="container">
            <div class="blog">
                <div class="blog-title">
                    <h2>
                        {{ $blog->title }}
                    </h2>
                </div>
                <div class="blog-body">
                    <p>
                        {{ $blog->description }}
                    </p>
                </div>
                <a class="" href="{{ route('blogs.show', $blog->id) }}">read more</a>
            </div>
        </div>
    @endforeach
@endsection

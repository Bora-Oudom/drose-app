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
        <div class="blog-container d-flex justify-content-between align-items-end">
            <div class="blog-container-bg">
                <img src="{{ url('image/' . $blog->image) }}">
            </div>
            <div class="blog-body">
                <div class="blog-title">
                    <h1>{{ $blog->title }}</h1>
                </div>
                <div class="blog-summary">
                    <p
                        style="
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;">
                        {{ $blog->description }}</p>
                </div>
            </div>
            <a class="pe-4 pb-2" href="{{ route('blogs.show', $blog->id) }}" style="color: #79E0EE">read more</a>
        </div>
    @endforeach
    <main>

        {!! $blogs->render() !!}

    </main>
@endsection

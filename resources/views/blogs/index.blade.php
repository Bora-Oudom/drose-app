@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="blog-container">
        <div class="blog-header">
            <div class="blog-cover">
                <img src="{{ url('image/' . $blog->image) }}">
                <div class="blog-author">
                    <img src="{{ url('profile/' . $blog->user->profile) }}">
                    <div class="blog-author-name">
                        <p>{{ $blog->user->name }}</p>
                        <small>{{ $blog->created_at->format('M d \a\t g:i A') }}</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="blog-body">
            <div class="blog-title">
                <h1>{{ $blog->title }}</h1>
            </div>
            <div class="blog-summary">
                <p>{{ $blog->description }}</p>
            </div>
        </div>
    </div>
@endsection

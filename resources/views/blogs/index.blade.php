@extends('layouts.app')

@section('content')
    <div class="blog-container">
        <div class="blog-header">
            <div class="blog-cover">
                <img src="{{ url('image/' . $blog->image) }}">
                <div class="blog-author">
                    <img src="{{ url('profile/' . $blog->user->profile) }}">
                    <h3>{{ $blog->user->name }}</h3>
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

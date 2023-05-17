@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card mt-5 w-50 ">
            <div class="card-header text-uppercase">
                <h1>{{ $blog->title }}</h1>
                <div class="auther">
                    <small>{{ $blog->user->name }}</small>
                </div>
            </div>
            <div class="card-body">
                <p>{{ $blog->description }}</p>
            </div>
        </div>
    </div>
@endsection

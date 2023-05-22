@extends('layouts.app')
@section('content')
    <div class="profile-card position-relative">
        <a class="btn btn-primary position-absolute bottom-0 end-0" href="{{ route('users.edit', $user->id) }}">Edit</a>
        <div class="top-section">
            <div class="pic">
                <img src="{{ url('profile/' . $user->profile) }}" alt="profile picture">
            </div>
            <div class="name">
                {{ $user->name }}
            </div>
            <div class="email">{{ $user->email }}</div>
            <div class="role">
                @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $v)
                        <label class="badge bg-success">{{ $v }}</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @foreach ($user->blogs as $blog)
        <div class="blog-container">
            <div class="blog-header">
                <div class="blog-cover">
                    <img src="{{ url('image/' . $blog->image) }}">
                    <div class="blog-author">
                        <img src="{{ url('profile/' . $user->profile) }}">
                        <h3>{{ $user->name }}</h3>
                    </div>
                </div>
            </div>

            <div class="blog-body">
                <div class="blog-title d-flex justify-content-between align-items-center">
                    <h1>{{ $blog->title }}</h1>
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['blogs.destroy', $blog->id],
                        'style' => 'display:inline',
                        'id' => 'delete-form',
                    ]) !!}
                    {!! Form::submit('Delete', [
                        'class' => 'btn btn-danger delete',
                        'data-confirm' => 'Are you sure to delete this user',
                    ]) !!}
                    {!! Form::close() !!}
                </div>
                <div class="blog-summary">
                    <p>{{ $blog->description }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection

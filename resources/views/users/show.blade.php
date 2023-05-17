@extends('layouts.app')
@section('content')
    <div class="profile-card">
        <div class="top-section">
            <div class="pic">
                <img src="https://tinypic.host/images/2022/12/19/img_avatar.png" alt="profile picture">
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
        <div class="blog-card mb-5 d-flex justify-content-center align-items-center">
            <div class="card w-50 ">
                <div class="card-header text-uppercase">
                    <div class="d-flex justify-content-between align-items-start">
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
                    <div class="auther">
                        <small>{{ $user->name }}</small>
                    </div>
                </div>
                <div class="card-body">
                    <p>{{ $blog->description }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection

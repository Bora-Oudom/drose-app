@extends('layouts.app')
@section('content')
    <div class="profile-card">
        <div class="top-section position-relative">
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
            <a href="{{ route('users.edit', $user->id) }}">
                <i class="fa-solid fa-pencil fa-lg"
                    style="color: #c3c6d1; position: absolute; top: 5%; right: 5%; #fff;"></i>
            </a>
        </div>
    </div>
    @foreach ($user->blogs as $blog)
        <div class="blog-container">
            <div class="d-block w-100">
                <div class="blog-header">
                    <div class="blog-cover">
                        <img src="{{ url('image/' . $blog->image) }}">
                        <div class="blog-author">
                            <img src="{{ url('profile/' . $user->profile) }}">
                            <div class="blog-author-name">
                                <p>{{ $user->name }}</p>
                                <small>{{ $blog->created_at->format('M d \a\t g:i A') }}</small>
                            </div>
                        </div>
                        <a href="{{ route('blogs.edit', $blog->id) }}"><i class="fa-solid fa-pencil fa-lg"
                                style="color: #c3c6d1; position: absolute; top: 5%; right: 5%;"></i></a>
                    </div>
                </div>

                <div class="blog-body">
                    <div class="blog-title d-flex justify-content-between align-items-end">
                        <h1>{{ $blog->title }}</h1>
                        <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}"
                            id="delete-form-{{ $blog->id }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <button type="submit" data-id="{{ $blog->id }}" class="btn delete">
                                <i class="fa-solid fa-trash fa-lg" style="color: #eb3446"></i>
                            </button>
                        </form>
                    </div>
                    <div class="blog-summary">
                        <p>{{ $blog->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

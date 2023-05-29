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
            <a href="{{ route('users.edit', $user->id) }}"><i class="fa-solid fa-pencil fa-lg"
                    style="color: #c3c6d1; position: absolute; top: 5%; right: 5%; #fff;"></i></a>
        </div>
    </div>
    <div class="blog-container">
        <div class="owl-carousel owl-theme">
            @foreach ($user->blogs as $blog)
                <div class="item">

                </div>
            @endforeach
        </div>

        {{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner"> --}}
        @foreach ($user->blogs as $blog)
            {{-- <div class="carousel-item active"> --}}
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
                        <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">
                                <i class="fa-solid fa-trash fa-lg" style="color: #eb3446"></i>
                            </button>
                        </form>
                    </div>
                    <div class="blog-summary">
                        <p>{{ $blog->description }}</p>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        @endforeach

        {{-- </div> --}}
        {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> --}}
        {{-- </div> --}}
    </div>
@endsection
{{-- @push('footer-scripts')
    <script type="module">
        $( document ).ready(function() {
            $('.carousel-inner:nth-child(1)').addClass("active");
        });
    </script>
@endpush --}}

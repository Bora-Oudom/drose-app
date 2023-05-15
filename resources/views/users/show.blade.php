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
@endsection

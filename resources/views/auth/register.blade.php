@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data">
            @csrf
            <h2 class="text-light">Create User</h2>
            <div class="row mb-3">
                <label for="name">{{ __('Name') }}</label>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Username">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3 position-relative">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <i class="fa-solid fa-eye-slash hide"></i>
                <i class="fa-solid fa-eye unhide"></i>
            </div>

            <div class="row mb-3 position-relative">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Confirm Password">
                <i class="fa-solid fa-eye-slash hide"></i>
                <i class="fa-solid fa-eye unhide"></i>
            </div>
            <div class="row mb-3">
                <label for="role">{{ __('Roles') }}</label>

                <select id="roles" class="form-control @error('roles') is-invalid @enderror" name="roles">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ old('roles') === $role ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="row mb-3">
                <label for="profile">{{ __('Profile:') }}</label>
                <input type="file" class="form-control" name="profile">
            </div> --}}
            <!-- File input element -->
            <div class="row mb-3">
                <label for="profile">{{ __('Profile') }}</label>
                <div class="dropzone-wrapper">
                    <div class="box-body"></div>
                    <div class="dropzone-desc">
                        <i class="fa-solid fa-circle-arrow-down fa-xl"></i>
                        <p>Choose an image file or drag it here.</p>
                    </div>
                    <input type="file" name="profile" class="dropzone">
                </div>
            </div>
            <div class="row mb-0">

                <button type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
@endsection

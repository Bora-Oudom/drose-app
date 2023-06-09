@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <h2 class="text-light mb-4">Login</h2>
        <div class="row mb-3 position-relative">
            {{-- <label for="email">{{ __('Email Address') }}</label> --}}
            <input id="email" type="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}"
                required autocomplete="email" autofocus placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row mb-3 position-relative">
            {{-- <label for="password">{{ __('Password') }}</label> --}}
            <input id="password" type="password" @error('password') is-invalid @enderror name="password" required
                autocomplete="current-password" placeholder="Password">
            <i class="fa-solid fa-eye-slash hide"></i>
            <i class="fa-solid fa-eye unhide"></i>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6 offset-md-4 mb-3">
            <div class="form-check p-0 m-0">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <button type="submit">
            {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
            <a class=" d-flex justify-content-center mt-3" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </form>
@endsection

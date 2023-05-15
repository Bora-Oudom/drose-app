@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9 col-lg-9 col-sm-9 d-flex justify-content-center align-items-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <h2 class="status">{{ __('You are logged in!') }}</h2>
@endsection

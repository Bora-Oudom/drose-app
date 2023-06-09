@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($user, [
        'method' => 'PATCH',
        'route' => ['users.update', $user->id],
        'class' => 'form',
        'enctype' => 'multipart/form-data',
    ]) !!}

    <div class="d-flex justify-content-between align-items-lg-center mb-4">
        <h2 class="text-light">Edit User</h2>

        {{-- <a class="btn btn-secondary text-light" href="{{ route('users.index') }}"> Back</a> --}}
    </div>

    <div class="row mb-3">
        {{-- <label for="name">{{ __('Name:') }}</label> --}}
        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
    </div>

    <div class="row mb-3">
        {{-- <label for="email">{{ __('Email:') }}</label> --}}
        {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
    </div>

    <div class="row mb-3 position-relative">
        {{-- <label for="password">{{ __('Password:') }}</label> --}}
        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'id' => 'password']) !!}
        <i class="fa-solid fa-eye-slash hide"></i>
        <i class="fa-solid fa-eye unhide"></i>
    </div>

    <div class="row mb-3 position-relative">
        {{-- <label for="confirm-password">{{ __('Confirm Password:') }}</label> --}}
        {!! Form::password('confirm-password', [
            'placeholder' => 'Confirm Password',
            'class' => 'form-control',
            'id' => 'password',
        ]) !!}
        <i class="fa-solid fa-eye-slash hide"></i>
        <i class="fa-solid fa-eye unhide"></i>
    </div>

    <div class="row mb-3">
        {{-- <label for="roles">{{ __('Roles:') }}</label> --}}
        {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', '']) !!}
    </div>
    <div class="row mb-3">
        {{-- <label for="profile">{{ __('Profile') }}</label> --}}
        <div class="dropzone-wrapper">
            <div class="box-body">
                @if ($user->profile)
                    <img width="150" src="{{ url('profile/' . $user->profile) }}" />
                @endif
            </div>
            {{-- <div class="dropzone-desc">
                <i class="fa-solid fa-circle-arrow-down fa-xl"></i>
                <p>Choose an image file or drag it here.</p>
            </div> --}}
            <input type="file" name="profile" class="dropzone">
        </div>
    </div>
    {{-- <div class="mb-3">
        <label for="profile">{{ __('Profile:') }}</label>
        <input type="file" class="form-control" name="profile">
    </div> --}}

    <div class="row">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    {!! Form::close() !!}
@endsection

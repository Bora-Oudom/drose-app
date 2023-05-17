@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-light mt-5">Users Management</h2>
                </div>
                {{-- <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                    </div> --}}
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success status">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge bg-success">{{ $v }}</label>
                            @endforeach
                        @endif

                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['users.destroy', $user->id],
                            'style' => 'display:inline',
                            'id' => 'delete-form',
                        ]) !!}
                        {!! Form::submit('Delete', [
                            'class' => 'btn btn-danger delete',
                            'data-confirm' => 'Are you sure to delete this user',
                        ]) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </table>

    </div>

    {{-- This code will render a pagination control for the $data object --}}
    {!! $data->render() !!}
@endsection

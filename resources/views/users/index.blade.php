@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-light mt-5">Users Management</h2>
                </div>
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
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><img class="w-" src="{{ url('profile/' . $user->profile) }}" alt="{{ $user->profile }}"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge bg-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td class="d-flex justify-content-start align-items-center">
                        <a class="btn" href="{{ route('users.edit', $user->id) }}">
                            <i class="fa-solid fa-pencil fa-lg"style="color: #c3c6d1;"></i>
                        </a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                            id="delete-form-{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete" data-id="{{ $user->id }}">
                                <i class="fa-solid fa-trash fa-lg" style="color: #eb3446"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {!! $data->links() !!}
        </div>
    </div>

    {{-- This code will render a pagination control for the $data object --}}
    {{-- {!! $data->render() !!} --}}
@endsection

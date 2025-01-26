@extends('layouts.app')

@section('title', 'Manage Companies')

@section('content')
    <div class="m-2">
        <a href="{{route('admin.dashboard')}}">
            <button type="button" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                </svg>
            </button>
        </a>
    </div>
    <div class="card">
        <div class="card-header">Manage Users</div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_blocked)
                                <form action="{{ route('admin.blockUser', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-success">
                                        Unblock User
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.blockUser', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-danger">
                                        Block User
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('admin.users.showAssignedCompany', $user->id) }}" class="btn btn-warning ">Assign Company</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

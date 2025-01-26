@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
    <h1>Welcome, Admin!</h1>
    <div class="list-group">
        <a href="{{ route('companies.index') }}" class="list-group-item list-group-item-action">Manage Companies</a>
        <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Manage Users</a>
    </div>
@endsection

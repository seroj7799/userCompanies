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
        <div class="card-header">Manage Companies</div>
        <div class="card-body">
            <a href="{{ route('admin.companies.create') }}" class="btn btn-success mb-3">Add Company</a>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Tax Account</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->tax_account }}</td>
                            <td>
                                <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.companies.delete', $company->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

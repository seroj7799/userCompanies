@extends('layouts.app')
@section('title', 'Admin Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($errors->has('message'))
                <p class="alert alert-danger">
                    {{ $errors->first('message') }}
                </p>
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
@endsection

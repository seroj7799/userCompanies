@extends('layouts.app')
@section('title', 'Error Blade')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="display-4 text-danger">Oops!</h1>
            <p class="lead">Something went wrong. Please try again later.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go Back to Home</a>
        </div>
    </div>
</div>
@endsection

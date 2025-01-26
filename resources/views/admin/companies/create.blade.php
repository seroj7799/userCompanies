@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="m-2">
            <a href="{{ route('companies.index') }}">
                <button type="button" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                    </svg>
                </button>
            </a>
        </div>
        <h1>Add Company</h1>
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <p class="alert alert-danger mt-1">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>
            <div class="mb-3">
                <label for="tax_account" class="form-label">Tax account</label>
                <input type="text" class="form-control" name="tax_account" value="{{ old('tax_account') }}" required>
                @if ($errors->has('tax_account'))
                    <p class="alert alert-danger mt-1">
                        {{ $errors->first('tax_account') }}
                    </p>
                @endif
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description"> {{ old('description') }} </textarea>
                @if ($errors->has('description'))
                    <p class="alert alert-danger mt-1">
                        {{ $errors->first('description') }}
                    </p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

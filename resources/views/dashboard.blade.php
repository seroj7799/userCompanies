@extends('layouts.app')

@section('title', 'Company Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard - {{ $company->name }}</div>
        <div class="card-body">
            <p>{{ $company->description }}</p>
        </div>
    </div>
@endsection

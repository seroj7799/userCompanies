@extends('layouts.app')
@section('title', 'Select Company')

@section('content')
    <div class="card">
        <div class="card-header">Select a Company</div>
        <div class="card-body">
            <form method="GET">
                @csrf
                <div class="mb-3">
                    <label for="company" class="form-label">Choose a company:</label>
                    <select class="form-select" id="company" name="company_id" onchange="javascript:handleSelect(this)">
                        <option selected disabled>Choose company</option>
                        @foreach($companies as $company)
                                <option value="{{ route('dashboard.switchCompany',$company->tax_account)}}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">View Dashboard</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function handleSelect(elm)
        {
            window.location = elm.value;
        }
    </script>
@endsection

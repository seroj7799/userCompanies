@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="m-2">
            <a href="{{route('admin.users')}}">
                <button type="button" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                    </svg>
                </button>
            </a>
        </div>
        <h1>Assign Companies to User</h1>
        <div class="card">
            <div class="card-body">
                <h5>User: {{ $user->name }}</h5>
                <p>Email: {{ $user->email }}</p>
            </div>
        </div>

        <form id="assign-companies-form">
            @csrf
            <input type="hidden" class="addCompanyOnUser" value="{{route('admin.users.addCompanyOnUser', $user->id)}}">
            <input type="hidden" class="deleteCompanyOnUser" value="{{route('admin.users.deleteCompanyOnUser', $user->id)}}">
            <div class="mb-3">
                <label for="company_ids" class="form-label">Select Companies</label>
                <select name="company_ids[]" id="company_ids" class="form-control js-example-basic-multiple company_ids" multiple="multiple">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}"
                                @if($user->companies->contains($company->id)) selected @endif>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $('#company_ids').select2({
                placeholder: "Select companies",
                allowClear: true,
            });

            $('#company_ids').on('select2:select', function (e) {
                var companyId = e.params.data.id;
                var url = $(".addCompanyOnUser").val();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { companyId },
                    success: function (response) {
                        $('.show-message-div').append(`
                        <div class="alert alert-success alert-message" role="alert">
                            ${response.message}
                        </div>`);
                        $('.show-message-div .alert-message').last().fadeOut(3000);
                    },
                    error: function (xhr) {
                        $('.show-message-div').append(`
                        <div class="alert alert-danger alert-message" role="alert">
                           Something went wrong! Please contact the administrator.
                        </div>`);
                        $('.show-message-div .alert-message').last().fadeOut(3000);
                    },
                });
            });

            $('#company_ids').on("select2:unselect", function (e) {
                var companyId = e.params.data.id;
                var url = $(".deleteCompanyOnUser").val();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { companyId },
                    success: function (response) {
                        $('.show-message-div').append(`
                        <div class="alert alert-success alert-message" role="alert">
                            ${response.message}
                        </div>`);
                        $('.show-message-div .alert-message').last().fadeOut(3000);
                    },
                    error: function (xhr) {
                        $('.show-message-div').append(`
                        <div class="alert alert-danger alert-message" role="alert">
                          Something went wrong! Please contact the administrator.
                        </div>`);
                        $('.show-message-div .alert-message').last().fadeOut(3000);
                    },
                });
            });

        });
    </script>
@endsection

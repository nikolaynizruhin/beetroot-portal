@inject('countries', 'App\Http\Utilities\Country')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Update Team
                </div>

                <div class="card-body">

                    @include('layouts.partials.flash')

                    <!-- Client Logo -->
                    <img src="{{ asset('storage/' . $client->logo) }}"
                         alt="logo"
                         class="rounded-circle img-thumbnail img-fluid mx-auto d-block"
                         height="150"
                         width="150">

                    <br>

                    <form method="POST"
                          action="{{ route('clients.update', $client) }}"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @include('clients.partials.form', ['button' => 'Update'])
                    </form>

                    <!-- Delete Client -->
                    <h4>Delete Client</h4>
                    <hr>

                    <form id="delete-form"
                          method="POST"
                          action="{{ route('clients.destroy', $client) }}">
                        @method('DELETE')
                        @csrf

                        <div class="form-group row mb-0">
                            <!-- Delete Button -->
                            <div class="col-md-3 offset-md-4">
                                <button type="submit"
                                        class="btn btn-light btn-block"
                                        onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete a client? This will remove a client and all associated employees!'))
                                                document.getElementById('delete-form').submit();">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

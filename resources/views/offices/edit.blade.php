@inject('countries', 'App\Http\Utilities\Country')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-building fa-lg fa-fw" aria-hidden="true"></i>
                    &nbsp;
                    Update Location
                </div>

                <div class="card-body">

                    @include('layouts.partials.flash')

                    <form method="POST" action="{{ route('offices.update', $office) }}">
                        @method('PUT')
                        @include('offices.partials.form', ['button' => 'Update'])
                    </form>

                    <!-- Delete Office -->
                    <h4>Delete Location</h4>
                    <hr>

                    <form id="delete-form"
                          method="POST"
                          action="{{ route('offices.destroy', $office) }}">
                        @method('DELETE')
                        @csrf

                        <div class="form-group mb-0">
                            <!-- Delete Button -->
                            <div class="col-md-3 offset-md-4">
                                <button type="submit"
                                        class="btn btn-light btn-block"
                                        onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete an office? This will remove an office and all associated employees!'))
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

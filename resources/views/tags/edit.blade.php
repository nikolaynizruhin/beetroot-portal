@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tag fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Update Skill
                    </div>

                    <div class="card-body">

                        @include('layouts.partials.flash')

                        <form method="POST" action="{{ route('tags.update', $tag) }}">
                            @method('PUT')
                            @include('tags.partials.form', ['button' => 'Update'])
                        </form>

                        <!-- Delete Tag -->
                        <h4>Delete Tag</h4>
                        <hr>

                        <form id="delete-form"
                              method="POST"
                              action="{{ route('tags.destroy', $tag) }}">
                            @method('DELETE')
                            @csrf

                            <div class="form-group mb-0">
                                <!-- Delete Button -->
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit"
                                            class="btn btn-light btn-block"
                                            onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete a tag? This will remove a tag and all associated relations with Beetroots and Teams!'))
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

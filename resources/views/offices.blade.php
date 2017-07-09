@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Offices ({{ $offices->count() }})
                    </div>

                    <div class="panel-body">
                        @foreach ($offices as $office)
                            <div class="row">
                                <div class="col-sm-8">
                                    <iframe
                                            width="100%"
                                            height="350"
                                            frameborder="0" style="border:0; margin-bottom: 20px"
                                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDSASvfMJudvEc-O5ugI0O6PE9NgCE4ACU&q=Beetroot+Academy,Kiev" allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                        &nbsp;
                                        <strong>{{ $office->country }}, {{ $office->city }}</strong>
                                    </p>
                                    <p>
                                        <i class="fa fa-location-arrow fa-fw" aria-hidden="true"></i>
                                        &nbsp;
                                        {{ $office->address }}
                                    </p>
                                    <p>
                                        <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                                        &nbsp;
                                        {{ $office->users->count() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

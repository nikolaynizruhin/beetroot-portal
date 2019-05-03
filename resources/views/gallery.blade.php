@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-images fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Gallery
                    </div>

                    <div class="card-body">

                        <!-- Carousel -->
                        <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselCaptions" data-slide-to="2"></li>
                                <li data-target="#carouselCaptions" data-slide-to="3"></li>
                                <li data-target="#carouselCaptions" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('images/gallery/birthdays/2_years_2014.jpg') }}" class="d-block w-100" alt="Beetroot Birthday Party">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>2 Years, 2014</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/gallery/birthdays/3_years_2015.jpg') }}" class="d-block w-100" alt="Beetroot Birthday Party">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>3 Years, 2015</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/gallery/birthdays/4_years_2016.jpg') }}" class="d-block w-100" alt="Beetroot Birthday Party">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>4 Years, 2016</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/gallery/birthdays/5_years_2017.jpg') }}" class="d-block w-100" alt="Beetroot Birthday Party">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>5 Years, 2017</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/gallery/birthdays/6_years_2018.jpg') }}" class="d-block w-100" alt="Beetroot Birthday Party">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>6 Years, 2018</h5>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

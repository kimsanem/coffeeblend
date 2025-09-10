@extends('layouts.app')

@section('title', 'About')

@section('content')

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{asset('assets/images/bg_3.jpg')}});" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">About Us</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>About</span></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-about d-md-flex">
        <div class="one-half img" style="background-image: url({{asset('/assets/images/about.jpg')}});"></div>
        <div class="one-half ftco-animate">
            <div class="overlap">
                <div class="heading-section ftco-animate ">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4 text-white">Our Story</h2>
                </div>
                <div>
                    <ul>
                        <li class="text-white">☕ Every cup tells a story. Discover ours in every blend.</li>
                        <li class="text-white">🌱 From bean to brew, uncover the journey behind our coffee story.</li>
                        <li class="text-white">✨ Sip, savor, and discover the story in every blend.</li>
                        <li class="text-white">🌍 A world of flavor, a story in every sip.</li>
                        <li class="text-white">📖 Discover our story, crafted in every coffee blend.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section img" id="ftco-testimony" style="background-image: url({{asset('assets/images/bg_1.jpg')}});"  data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Testimony</span>
                    <h2 class="mb-4 text-white">Customers Says</h2>
                    <p class="text-white">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>
        </div>
        <div class="container-wrap">
            <div class="row d-flex no-gutters">
                @foreach($reviews as $review)
                    <div class="col-lg align-self-sm-end">
                        <div class="testimony">
                            <blockquote>
                                <p>{{$review->review}}</p>
                            </blockquote>
                            <div class="author d-flex mt-4">
                                {{--                            <div class="image mr-3 align-self-center">--}}
                                {{--                                <img src="{{asset('assets/images/person_1.jpg')}}" alt="">--}}
                                {{--                            </div>--}}
                                <div class="name align-self-center">{{$review->name}} </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 pr-md-5">
                    <div class="heading-section text-md-right ftco-animate">
                        <span class="subheading">Discover</span>
                        <h2 class="mb-4 text-white">Our Menu</h2>
                        <p class="mb-4 text-white">Discover our menu and indulge in a perfect blend of flavors crafted to delight every moment.</p>
                        <p><a href="{{route('menu')}}" class="btn btn-primary btn-outline-primary px-4 py-3">View Full Menu</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="menu-entry">
                                <a href="#" class="img" style="background-image: url({{asset('assets/images/menu-1.jpg')}});"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url({{asset('assets/images/bg_2.jpg')}});" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="100">0</strong>
                                    <span>Coffee Branches</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="85">0</strong>
                                    <span>Number of Awards</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="10567">0</strong>
                                    <span>Happy Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="900">0</strong>
                                    <span>Staff</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

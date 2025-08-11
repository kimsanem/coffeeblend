@extends('layouts.app')
@section('title', 'Bookings')
@section('content')

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{asset('assets/images/bg_3.jpg')}});" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">My Bookings</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>My Bookings</span></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table" style="width: 1100px;">
                            <thead style="height: 40px;">
                            <tr class="text-center">
                                <th style="background-color: #c49b63 !important;">First Name</th>
                                <th style="background-color: #c49b63 !important;">Last Name</th>
                                <th style="background-color: #c49b63 !important;">Date</th>
                                <th style="background-color: #c49b63 !important;">Time</th>
                                <th style="background-color: #c49b63 !important;">Phone</th>
                                <th style="background-color: #c49b63 !important;">Status</th>
                                <th style="background-color: #c49b63 !important;">Write Review</th>
                            </tr>
                            </thead>
                            <tbody class="table-dark">
                            @if($bookings->count() > 0)
                                @foreach($bookings as $booking)
                                    <tr class="text-center" style="height: 140px">
                                        <td class="product-remove">{{ $booking->first_name }}</td>

                                        <td class="image-prod">{{ $booking->last_name }}</td>

                                        <td class="product-name">
                                            <h3>{{ $booking->date }}</h3>
                                        </td>

                                        <td class="price">{{ $booking->time }}</td>

                                        <td>
                                            {{ $booking->phone }}
                                        </td>

                                        <td class="total">{{ $booking->status }}</td>
                                        <td class="total">
                                            @if($booking->status == "Delivered")
                                                <a class="btn btn-primary" href="{{ route('write.review') }}">Write a review</a>
                                            @else
                                                <p>Not Available</p>
                                            @endif
                                        </td>
                                    </tr><!-- END TR-->
                                @endforeach
                            @else
                                <p class="alert alert-success">you have no bookings just yet</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

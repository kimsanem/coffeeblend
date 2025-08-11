@extends('layouts.app')

@section('title', 'Orders')
@section('content')

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{asset('assets/images/bg_3.jpg')}});" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">My Orders</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>My Orders</span></p>
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
                                <th style="background-color: #c49b63 !important;">Address</th>
                                <th style="background-color: #c49b63 !important;">City</th>
                                <th style="background-color: #c49b63 !important;">Email</th>
                                <th style="background-color: #c49b63 !important;">Price</th>
                                <th style="background-color: #c49b63 !important;">Status</th>
                            </tr>
                            </thead>
                            <tbody class="table-dark">
                            @if($orders->count() > 0)
                                @foreach($orders as $order)
                                    <tr class="text-center">
                                        <td class="product-remove">{{ $order->first_name }}</td>

                                        <td class="image-prod">{{ $order->last_name }}</td>

                                        <td class="product-name">
                                            <h3>{{ $order->address }}</h3>
                                        </td>

                                        <td class="price">{{ $order->city }}</td>

                                        <td>
                                            {{ $order->email }}
                                        </td>

                                        <td class="total">${{ $order->price }}</td>
                                        <td class="total">{{ $order->status }}</td>
                                    </tr><!-- END TR-->
                                @endforeach
                            @else <p class="alert alert-success">you have no orders just yet</p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

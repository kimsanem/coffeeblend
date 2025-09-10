@extends('layouts.app')

@section('title', 'checkout')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{asset('assets/images/bg_3.jpg')}});" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Checkout</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Checkout</span></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">

                    <form method="POST" action="{{ route('process.checkout') }}" class="billing-form ftco-bg-dark p-3 p-md-5" method="POST">
                        @csrf
                        <h3 class="mb-4 billing-heading text-white">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="country" id="country" class="form-control">
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="India">India</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" cols="10" rows="14" class="form-control" placeholder="house address"></textarea>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input name="city" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Postcode / ZIP *</label>
                                    <input name="zip_code" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input name="phone" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input name="email" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="price" type="hidden" value="{{ Session::get('price') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id  }}" class="form-control">
                                </div>
                            </div>

{{--                            <div class="w-100"></div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group mt-4">--}}
{{--                                    <div class="radio">--}}
{{--                                        <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Place an order</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>


                        <div class="row mt-5 pt-3 d-flex">
                            <div class="col-md-6 d-flex">
                                <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Cart Total</h3>
                                    <p class="d-flex">
                                        <span>Subtotal</span>
                                        <span>${{ Session::get('price') }}</span>
                                    </p>
                                    <p class="d-flex">
                                        <span>Delivery</span>
                                        <span>$0.00</span>
                                    </p>
                                    <p class="d-flex">
                                        <span>Discount</span>
                                        <span>$0.00</span>
                                    </p>
                                    <hr>
                                    <p class="d-flex total-price">
                                        <span>Total</span>
                                        <span>${{ Session::get('price') }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Payment Method</h3>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary py-3 px-4">Place an order</button>
                                </div>
                            </div>
                        </div>
                    </form><!-- END -->

                </div> <!-- .col-md-8 -->


            </div>

        </div>
        </div>
    </section> <!-- .section -->

@endsection

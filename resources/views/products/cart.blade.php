@extends('layouts.app')
@section('title', 'Carts')
@section('content')

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Cart</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <div class="container">
		@if( Session::has( 'delete' ))
			<p class="alert {{ Session::get('alert-class', 'alert-info') }}">
				{{ Session::get( 'delete' ) }}
			</p>
		@endif
	</div>

	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table" style="width: 1100px;">
						<thead style="height: 40px;">
							<tr class="text-center">
                                <th style="background-color: #c49b63 !important;">&nbsp;</th>
                                <th style="background-color: #c49b63 !important;">&nbsp;</th>
                                <th style="background-color: #c49b63 !important;">Product</th>
                                <th style="background-color: #c49b63 !important;">Price</th>
                                <th style="background-color: #c49b63 !important;">Quantity</th>
                                <th style="background-color: #c49b63 !important;">Total</th>
							</tr>
						</thead>
						<tbody class="table-dark">
                            @if($cartProducts->isEmpty())
                                <div style="width: 1100px;" class="card p-4 text-center bg-warning">
                                    <h4>Your cart is empty 🛒</h4>
                                    <p>Looks like you haven’t added anything yet.</p>
                                </div>
                            @else
                            @foreach($cartProducts as $cartProduct)
                                <tr class="text-center" style="height: 140px">
                                    <td class="product-remove"><a href="{{ route('cart.product.delete', $cartProduct->pro_id ) }}"><span class="icon-close"></span></a></td>

                                    <td class="image-prod"><img width="60" height="60" src="{{ asset('assets/images/' .$cartProduct->image.'') }}"></img></td>

                                    <td class="product-name">
                                        <h3>{{$cartProduct->name}}</h3>
                                        <p>{{$cartProduct->description}}</p>
                                    </td>

                                    <td class="price">${{$cartProduct->price}}</td>

                                    <td>
                                        <div class="input-group mb-3">
                                            <input disabled type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                            </div>
                                    </td>

                                    <td class="total">${{$cartProduct->price}}</td>
                                </tr><!-- END TR-->
                            @endforeach
                            @endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row justify-content-end">
			<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
				<div class="cart-total mb-3">
					<h3>Cart Totals</h3>
					<p class="d-flex">
						<span>Subtotal</span>
						<span>${{ $totalPrice }}</span>
					</p>
					<p class="d-flex">
						<span>Delivery</span>
						<span>$0.00</span>
					</p>
					{{-- <p class="d-flex">
						<span>Discount</span>
						<span>$3.00</span>
					</p> --}}
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span>${{ $totalPrice }}</span>
					</p>
				</div>
                @if ($cartProducts->count() > 0)
                    <form method="POST" action="{{ route('prepare.checkout') }}">
                        @csrf
                        <input name="price" type="hidden" value="{{$totalPrice}}">
                        <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Proceed to checkout</button>
                    </form>
                @else
                    <a href="{{ route('cart' )}}" class="btn btn-primary py-3 px-4">No items in cart</a>
                @endif
			</div>
		</div>
		</div>
	</section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          		<div class="col-md-7 heading-section ftco-animate text-center">
					<span class="subheading">Discover</span>
					<h2 class="mb-4">Related products</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          		</div>
        	</div>
                <div class="row">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="col-md-3">
                            <div class="menu-entry">
                                    <a href="{{ route('product.single', $relatedProduct->id) }}" class="img" style="background-image: url({{asset('assets/images/'.$relatedProduct->image.'')}});"></a>
                                    <div class="text text-center pt-4">
                                        <h3><a href="#">{{ $relatedProduct->name }}</a></h3>
                                        <p>{{ $relatedProduct->description }}</p>
                                        <p class="price"><span>${{ $relatedProduct->price }}</span></p>
                                        <p><a href="{{ route('add.cart', $relatedProduct->id) }}" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    	</div>
    </section>

@endsection

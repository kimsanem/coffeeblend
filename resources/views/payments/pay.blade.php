@extends('layouts.app')

@section('title', 'Payment')
@section('content')

    <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread">Payment PayPal</h1>
        </div>
    </div>

    <br><br>

    <div class="container">
        @if( Session::has( 'date' ))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                {{ Session::get( 'date' ) }}
            </p>
        @endif
        <!-- Replace "test" with your own sandbox Business account app client ID -->
        <script src="https://www.paypal.com/sdk/js?client-id=AXIGnyeuqGOKdA_NdXhOUOCOAqF3TDvCqbJgR53RPFf1VBJR8oddKcaQlqLUWhK_OLo8-dHx9s4jdalo&currency=USD"></script>
        <!-- Set up a container element for the button -->
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: {{ Session::get('price') }} // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {

                        window.location.href = "{{url('/payments/success') }}";
                    });
                },
                onError: (err) => {
                    console.error("PayPal Error:", err);
                    alert("Payment error: " + JSON.stringify(err));
                }
            }).render('#paypal-button-container');
        </script>

    </div>
@endsection

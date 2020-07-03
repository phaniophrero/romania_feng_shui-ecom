@extends('layouts.frontLayout.front_design')
@section('content')

<div class="container">
    @if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">&#215;</button>
        <strong>{!! session('flash_message_success') !!}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">&#215;</button>
        <strong>{!! session('flash_message_error') !!}</strong>
    </div>
    @endif
    <div>
        <h3>Please enter your Card Details</h3>
        <p>Your order number is <strong>{{ Session::get('order_id') }}</strong> and total payable amount is RON
            <strong>{{ round(Session::get('grand_total'),2) }}</strong></p>
    </div>
    <form action="{{ url('/place-payment') }}" method="post" id="payment-form">
        @csrf
        <div class="col-sm-4">
            <div class="form-row">
                <div class="form-group">
                    <input name="billing_name" id="billing_name" @if(!empty($userDetails->name))
                    value="{{ $userDetails->name }}" @endif
                    class="form-control" type="text" placeholder="Billing Name" />
                </div>
                <div class="form-group">
                    <input name="billing_address" id="billing_address" @if(!empty($userDetails->address))
                    value="{{ $userDetails->address }}" @endif
                    class="form-control" type="text" placeholder="Billing Address" />
                </div>
                <div class="form-group">
                    <input name="billing_city" id="billing_city" @if(!empty($userDetails->city))
                    value="{{ $userDetails->city }}" @endif
                    class="form-control" type="text" placeholder="Billing City" />
                </div>
                <div class="form-group">
                    <input name="billing_state" id="billing_state" @if(!empty($userDetails->state))
                    value="{{ $userDetails->state }}" @endif
                    class="form-control" type="text" placeholder="Billing State" />
                </div>
                <div class="form-group">
                    <input name="billing_zipcode" id="billing_zipcode" @if(!empty($userDetails->zipcode))
                    value="{{ $userDetails->zipcode }}" @endif
                    class="form-control" type="text" placeholder="Billing Zipcode" />
                </div>

                <label for="card-element">
                    Credit or debit card
                </label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <br>
            <button id="complete-order" type="submit" class="button-stripe">Submit Payment</button>
            <br>
            <br>
        </div>
    </form>
</div>

<script>
    // Create a Stripe client.
    var stripe = Stripe('pk_test_qegVFI8E4fynZuP3q9fZlQeg00CGYmCuh8');
    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
    base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
    color: '#aab7c4'
    }
    },
    invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
    }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style,
        hidePostalCode: true
    });

    // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
        displayError.textContent = event.error.message;
        } else {
        displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Disable the submit button to prevent repeated clicks
        document.getElementById('complete-order').disabled = true;

        var options = {
            name: document.getElementById('billing_name').value,
            address_line1: document.getElementById('billing_address').value,
            address_city: document.getElementById('billing_city').value,
            address_state: document.getElementById('billing_state').value,
            address_zip: document.getElementById('billing_zipcode').value
        }

        stripe.createToken(card, options).then(function(result) {
        if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;

        // Enable the submit button
        document.getElementById('complete-order').disabled = false;

        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
</script>

@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
?>
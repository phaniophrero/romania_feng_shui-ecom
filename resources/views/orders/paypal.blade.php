@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Order; ?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Thanks</li>
            </ol>
        </div>
    </div>
</section>

<section id="do_action">
    <div class="container">
        <div class="heading" align="center">
            <h3>YOUR ORDER HAS BEEN PLACED</h3>
            <p>Your order number is <strong>{{ Session::get('order_id') }}</strong> and total payable amount is RON
                <strong>{{ Session::get('grand_total') }}</strong></p>
            <p>Please make payment by clicking on below Payment Button</p>
            <?php $orderDetails = Order::getOrderDetails(Session::get('order_id'));
            $nameArr = explode(' ', $orderDetails->name);
            $getCountryCode = Order::getCountryCode($orderDetails->country); ?>
            <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="fanio23@gmail.com">
                <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
                <input type="hidden" name="currency_code" value="RON">
                <input type="hidden" name="amount" value="{{ round(Session::get('grand_total'),2) }}">
                <input type="hidden" name="first_name" value="{{ $nameArr[0] }}">
                <input type="hidden" name="last_name" value="{{ $nameArr[1] }}">
                <input type="hidden" name="address1" value="{{ $orderDetails->address }}">
                <input type="hidden" name="address2" value="">
                <input type="hidden" name="city" value="{{ $orderDetails->city }}">
                <input type="hidden" name="state" value="{{ $orderDetails->state }}">
                <input type="hidden" name="country" value="{{ $getCountryCode->country_code }}">
                <input type="hidden" name="zip" value="{{ $orderDetails->zipcode }}">
                <input type="hidden" name="email" value="{{ $orderDetails->user_email }}">
                <input type="hidden" name="return" value="{{ url('paypal/thanks') }}">
                <input type="hidden" name="cancel_return" value="{{ url('paypal/cancel') }}">
                <input type="hidden" name="notify_url" value="{{ url('paypal/ipn') }}">
                <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png"
                    alt="Buy Now">
                <img src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
    </div>
</section>

@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
?>
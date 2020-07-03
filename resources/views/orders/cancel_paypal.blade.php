@extends('layouts.frontLayout.front_design')
@section('content')

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
            <h3>YOUR PAYPAL ORDER HAS BEEN CANCELLED</h3>
            <p>Please let us know if there's anything we can help with. Come back soon !</p>
        </div>
    </div>
</section>

@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
?>
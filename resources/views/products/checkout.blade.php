@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top: 20px;">
    <!--form-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Checkout</li>
            </ol>
        </div>
        @if(Session::has('flash_message_error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">&#215;</button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
        @endif
        @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">&#215;</button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
        @endif
        <form action="{{ url('/checkout') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Bill To</h2>
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
                            <select id="billing_country" name="billing_country" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->country_name }}" @if(!empty($userDetails->country) &&
                                    $country->country_name ==
                                    $userDetails->country) selected @endif >{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="billing_zipcode" id="billing_zipcode" @if(!empty($userDetails->zipcode))
                            value="{{ $userDetails->zipcode }}" @endif
                            class="form-control" type="text" placeholder="Billing Zipcode" />
                        </div>
                        <div class="form-group">
                            <input name="billing_mobile" id="billing_mobile" @if(!empty($userDetails->mobile))
                            value="{{ $userDetails->mobile }}" @endif
                            class="form-control" type="text" placeholder="Billing Mobile" />
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="copyAddress">
                            <label class="form-check-label" for="copyAddress">Shipping Address same as Billing
                                Address</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1">

                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <h2>Ship To</h2>
                        <div class="form-group">
                            <input name="shipping_name" id="shipping_name" @if(!empty($shippingDetails->name))
                            value="{{ $shippingDetails->name }}" @endif
                            class="form-control" type="text" placeholder="Shipping Name" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_address" id="shipping_address" @if(!empty($shippingDetails->address))
                            value="{{ $shippingDetails->address }}" @endif
                            class="form-control" type="text" placeholder="Shipping Address" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_city" id="shipping_city" @if(!empty($shippingDetails->city))
                            value="{{ $shippingDetails->city }}" @endif
                            class="form-control" type="text" placeholder="Shipping City" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state))
                            value="{{ $shippingDetails->state }}" @endif
                            class="form-control" type="text" placeholder="Shipping State" />
                        </div>
                        <div class="form-group">
                            <select id="shipping_country" name="shipping_country" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->country_name }}" @if(!empty($shippingDetails->country) &&
                                    $country->country_name ==
                                    $shippingDetails->country) selected @endif >{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="shipping_zipcode" id="shipping_zipcode" @if(!empty($shippingDetails->zipcode))
                            value="{{ $shippingDetails->zipcode }}" @endif
                            class="form-control" type="text" placeholder="Shipping Zipcode" />
                        </div>
                        <div class="form-group">
                            <input name="shipping_mobile" id="shipping_mobile" @if(!empty($shippingDetails->mobile))
                            value="{{ $shippingDetails->mobile }}" @endif
                            class="form-control" type="text" placeholder="Shipping Mobile" />
                        </div>
                        <button type="submit" class="btn btn-default">Checkout</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
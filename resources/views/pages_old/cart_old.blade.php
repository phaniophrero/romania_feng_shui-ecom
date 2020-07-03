@extends('acasa2')
@section('content')

<section class="cart-page">
    <div class="alert-container">
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (Cart::count() > 0)

        <h2 class="cart-alert-title">{{ Cart::count() }} item(s) in Shopping Cart</h2>

    </div>
    <header class="cart-header-wrap">

        <h1 class="cart-heading">Shopping Cart</h1>
        <a class="cart-checkout-btn" href="{{ route('checkout.index') }}"><i
                class="fas fa-long-arrow-alt-right arrow-right-checkout-btn"></i> CHECKOUT</a>
    </header>
    <hr class="cart-header-line">
    <div class="cart-page-table">

        <!-- begin simple product -->
        @foreach (Cart::content() as $item)

        <div class="cart-page-item">
            <div class="cart-page-item-main cart-f">
                <div class="cart-page-item-block ib-info cart-f">
                    <div class="cart-product-img-wrap">
                        <a class="product-img-wrap" href="{{ route('shop.show', $item->model->slug) }}">
                            <!-- Metoda de a incarca img este folosita pentru de Voyager Admin -->
                            <img class="cart-product-img" src="{{ productImage($item->model->image) }}">

                            <!-- Metoda de a incarca img este folosita inainte de Voyager Admin -->
                            {{-- <img class="cart-product-img" src="{{ asset('img/products/'.$item->model->slug.'.png') }}">
                            --}}
                        </a>
                    </div>
                    <div class="cart-ib-info-meta">
                        <a class="cart-product-title-link" href="{{ route('shop.show', $item->model->slug) }}">
                            <h1 class="cart-product-title">{{ $item->model->name }}</h1>
                        </a>
                        <span class="cart-itemno-id">{{ $item->model->details }}</span>
                    </div>
                </div>
                <div class="cart-item-remove-wrap">
                    {{-- <a class="cart-item-remove" href="">Remove</a> --}}
                    <form class="form-item-remove" action="{{ route('cart.destroy',$item->rowId) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="cart-item-remove">Remove</button>
                    </form>
                    {{-- <a class="cart-item-save" href="">Save for Later</a> --}}
                    <form class="form-item-remove" action="{{ route('cart.switchToSaveForLater',$item->rowId) }}"
                        method="POST">
                        {{ csrf_field() }}

                        <button type="submit" class="cart-item-save">Save for Later</button>
                    </form>
                </div>
                <!-- Aici poti schimba sa alegi mai mult de 5 produse daca vrei , acest exemplu este cu 5 | si in CartController-->
                <div class="cart-item-block ib-qty">
                    <select class="quantity" data-id="{{ $item->rowId }}"
                        data-productQuantity="{{ $item->model->quantity }}">
                        @for ($i = 1; $i < 5 + 1 ; $i++) <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}
                            </option>
                            @endfor

                    </select>
                    {{-- <input type="text" value="3" class="cart-qty" /> --}}
                    {{--  <span class="cart-table-price"><span class="price-x">x</span>  </span> --}}
                </div>
                <div class="cart-item-block2 ib-total-price">
                    <span class="cart-tp-price">{{ presentPrice($item->subtotal) }}</span>
                    <span class="cart-tp-remove"><i class="i-cancel-circle"></i></span>
                </div>
            </div>
            <div class="cart-item-foot cf">
                <!-- <div class="if-message"><p>Space Reserved for item/promo related messaging</p></div> -->
                <div class="cart-if-left"><span class="cart-if-status">IN STOCK</span></div>
                {{-- <div class="cart-if-right">
                    <a class="cart-blue-link" href="#">Add to
                        Wishlist</a>
                </div> --}}
            </div>
        </div>
        <hr>
        @endforeach
        <!-- end simple product -->
    </div>

    @if (! session()->has('coupon'))
    <a href="#" class="have-code-link">Have a Code ?</a>
    <div class="have-code-container">
        <form class="promo-code-form" action="{{ route('coupon.store') }}" method="POST">
            {{ csrf_field() }}
            <input class="promo-code-input" type="text" name="coupon_code" id="coupon_code">
            <button type="submit" class="button-promo-code">Apply</button>
        </form>
    </div>
    @endif


    <div class="cart-page-sub-table cart-f">
        <div class="cart-page-summary-block">
            <div class="cart-page-sb-promo">
                <div class="cart-page-copy-block">
                    <p class="copy-block-details">Items will be saved in your cart for 24h.</p>
                    <p class="cart-page-customer-care">
                        Call us M-F 8:00 am to 6:00 pm EST<br />
                        (877)-555-5555 or <a class="customer-care-contact-link" href="/contact">contact us</a>. <br />
                    </p>
                </div>
            </div>
            <div class="cart-page-subtotal-wrap">
                <ul class="cart-page-subtotal-ul">
                    <li class="cart-page-subtotal"><span class="cart-page-sb-label">Subtotal</span></li>
                    <li class="cart-page-subtotal"><span class="cart-page-sb-label">
                            @if (session()->has('coupon'))
                            <div class="checkout-discount">Discount({{ session()->get('coupon')['name'] }})
                                <form action="{{ route('coupon.destroy') }}" method="POST" style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }} <br>
                                    <button class="discount-remove-button" type="submit">Remove</button>
                                </form>
                                <br>
                                <hr>
                                New Subtotal <br>
                            </div>
                            @endif
                        </span></li>

                    <li class="cart-page-shipping"><span class="cart-page-sb-label">Tax(19%)</span></li>
                    <li class="cart-page-grand-total"><span class="cart-page-sb-label"><strong>Total</strong></span>
                    </li>
                </ul>
                <ul class="cart-page-subtotal-ul2">
                    <li><span class="cart-page-sb-price">{{ presentPrice(Cart::subtotal()) }}</span></li>
                    <li><span class="cart-page-sb-price">
                            @if (session()->has('coupon'))
                            <div class="checkout-discount">
                                -{{ presentPrice($discount) }} <br><br>
                                <hr>
                                {{ presentPrice($newSubtotal) }} <br>
                            </div>
                            @endif
                        </span></li>
                    <li><span class="cart-page-sb-value">{{ presentPrice($newTax) }}</span></li>
                    <li><span class="cart-page-sb-price-total"><strong>{{ presentPrice($newTotal) }}</strong></span>
                    </li>
                </ul>
            </div> <!-- end Cart SubTotal -->
        </div>
    </div> <!-- end Cart Sub Table -->

    <hr>

    <div class="cart-page-footer cf">
        <a class="cart-page-continue-shopping" href="{{ route('shop.index') }}"><i
                class="fas fa-arrow-left cont-shop-left-arrow"></i> Continue Shopping</a>
        <a class="cart-footer-checkout-btn" href="{{ route('checkout.index') }}">CHECKOUT</a>
    </div> <!-- end Cart Page Footer Buttons -->

    @else
    <h3 class="cart-no-items-title">No items in Cart!</h3>

    <a class="cart-page-continue-shopping" href="{{ route('shop.index') }}"><i
            class="fas fa-arrow-left cont-shop-left-arrow"></i> Continue Shopping</a>

    @endif

    <!-- Saved For Later Products -->
    @if (Cart::instance('saveForLater')->count() > 0)

    <h1 class="cart-saved-later-title">{{ Cart::instance('saveForLater')->count() }} item(s) Saved for Later</h1>

    <hr>
    <div class="cart-item-save-later">

        @foreach (Cart::instance('saveForLater')->content() as $item)

        <div class="cart-page-item-main cart-f">
            <div class="cart-page-item-block ib-info cart-f">
                <div class="cart-product-img-wrap">
                    <a href="{{ route('shop.show', $item->model->slug) }}">
                        <!-- Metoda de a incarca img este folosita pentru Voyager Admin -->
                        <img class="cart-product-img" src="{{ productImage($item->model->image) }}">

                        <!-- Metoda de a incarca img este folosita inainte de Voyager Admin -->
                        {{-- <img class="cart-product-img" src="{{ asset('img/products/'.$item->model->slug.'.png') }}">
                        --}}
                    </a>
                </div>
                <div class="cart-ib-info-meta">
                    <a class="cart-product-title-link" href="{{ route('shop.show', $item->model->slug) }}">
                        <h1 class="cart-product-title">{{ $item->model->name }}</h1>
                    </a>
                    <span class="cart-itemno-id">{{ $item->model->details }}</span>
                </div>
            </div>
            <div class="cart-item-remove-wrap">
                {{-- <a class="cart-item-remove" href="">Remove</a> --}}
                <form class="form-item-remove" action="{{ route('saveForLater.destroy',$item->rowId) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="cart-item-remove">Remove</button>
                </form>
                {{-- <a class="cart-item-save" href="">Move to Cart</a> --}}
                <form class="form-item-remove" action="{{ route('saveForLater.switchToCart',$item->rowId) }}"
                    method="POST">
                    {{ csrf_field() }}

                    <button type="submit" class="cart-item-save">Move to Cart</button>
                </form>
            </div>

            <div class="cart-item-block ib-qty"></div>

            <div class="cart-item-block2 ib-total-price">
                <span class="cart-tp-price">{{ $item->model->presentPrice() }}</span>
                <span class="cart-tp-remove"><i class="i-cancel-circle"></i></span>
            </div>
        </div>
        <div class="cart-item-foot cf">
            <!-- <div class="if-message"><p>Space Reserved for item/promo related messaging</p></div> -->
            <div class="cart-if-left"><span class="cart-if-status">IN STOCK</span></div>
            {{-- <div class="cart-if-right">
                <a class="cart-blue-link" href="#">Add to
                    Wishlist</a>
            </div> --}}
        </div>
    </div>
    @endforeach
    <!-- END -- Saved For Later Products -->

    @else
    <h3 class="cart-no-items-title">You have no items Saved for Later!</h3>

    @endif

</section>

@include('include.might-like')

@endsection


@section('extra-js')
<script>
    (function () {
        const classname = document.querySelectorAll('.quantity')

        Array.from(classname).forEach(function (element) {
            element.addEventListener('change', function () {
                const id = element.getAttribute('data-id')
                const productQuantity = element.getAttribute('data-productQuantity')

                axios.patch(`cart/${id}`, {
                    quantity: this.value,
                    productQuantity: productQuantity
                })
                .then(function (response) {
                    // console.log(response);
                    window.location.href = '{{ route('cart.index') }}'
                })
                .catch(function (error) {
                    //console.log(error);
                    console.log(error);
                    window.location.href = '{{ route('cart.index') }}'
                });
            })
        })
    })();
</script>
@endsection
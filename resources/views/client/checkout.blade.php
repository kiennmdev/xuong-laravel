@extends('client.layouts.master')

@section('title')
    Checkout
@endsection

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Checkout Area -->
    <div class="checkout-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="coupon-accordion">
                        <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                        <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est
                                    sit amet ipsum luctus.</p>
                                <form action="javascript:void(0)">
                                    <p class="form-row-first">
                                        <label>Username or email <span class="required">*</span></label>
                                        <input type="text">
                                    </p>
                                    <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="text">
                                    </p>
                                    <p class="form-row">
                                        <input value="Login" type="submit">
                                        <label>
                                            <input type="checkbox">
                                            Remember me
                                        </label>
                                    </p>
                                    <p class="lost-password"><a href="javascript:void(0)">Lost your password?</a></p>
                                </form>
                            </div>
                        </div>
                        <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form action="{{ route('add.coupon') }}" method="POST">
                                    @csrf
                                    <p class="checkout-coupon">
                                        <input placeholder="Coupon code" type="text" name="coupon">
                                        <input class="coupon-inner_btn" value="Apply Coupon" type="submit">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('checkout.create') }}" method="POST" class="row">
                @csrf
                <div class="col-lg-6 col-12">

                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">

                            @if (!Auth::check())
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Your Name <span class="required">*</span></label>
                                        <input placeholder="Your Name" type="text" name="user_name" value="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Address" type="text" name="user_address" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="Email Address" type="email" name="user_email" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input placeholder="Phone" type="text" name="user_phone" value="">
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Your Name <span class="required">*</span></label>
                                        <input placeholder="Your Name" type="text" name="user_name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Address" type="text" name="user_address"
                                            value="{{ Auth::user()->address }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="Email Address" type="email" name="user_email"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input placeholder="Phone" type="text" name="user_phone"
                                            value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                            @endif

                            {{-- <div class="col-md-12">
                                <div class="checkout-form-list create-acc">
                                    <input id="cbox" type="checkbox">
                                    <label>Create an account?</label>
                                </div>
                                <div id="cbox-info" class="checkout-form-list create-account">
                                    <p>Create an account by entering the information below. If you are a returning
                                        customer please login at the top of the page.</p>
                                    <label>Account password <span class="required">*</span></label>
                                    <input placeholder="password" type="password">
                                </div>
                            </div> --}}
                        </div>

                    </div>

                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $product)
                                        <tr class="cart_item">
                                            <td class="cart-product-name">{{ $product['name'] }}<strong
                                                    class="product-quantity">
                                                    × {{ $product['quantity_purchase'] }}</strong>
                                            </td>
                                            @php
                                                $price = $product['price_sale'] ?? $product['price_regular'];
                                            @endphp
                                            <td class="cart-product-total">
                                                <span class="amount">{{ number_format($price, 0, ',', '.') }}<sup>đ</sup>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Tạm tính</th>
                                        <td>
                                            <span class="amount">{{ number_format($totalAmount, 0, ',', '.') }}<sup>đ</sup>
                                            </span>
                                        </td>
                                    </tr>
                                    @session('coupon')
                                        <tr class="" style="background-color: rgba(141, 101, 33, 0.212)">
                                            <td>Mã giảm giá: {{ session('coupon')->code }}</td>
                                            <td>
                                                @php

                                                    $discount = session('coupon')->discount;

                                                    $total = $totalAmount - $discount;

                                                    if (session('coupon')->type == 'percent') {
                                                        $discount = ($totalAmount * session('coupon')->discount) / 100;
                                                        $total = $totalAmount - $discount;
                                                    }
                                                @endphp
                                                <span
                                                    style="font-size: 12px">-{{ number_format($discount, 0, ',', '.') }}<sup>đ</sup>
                                                </span>
                                                <input type="hidden" name="discount" value="{{ $discount }}">
                                                <span><a href="{{ route('delete.coupon') }}">[Xóa]</a></span>
                                            </td>
                                        </tr>
                                    @endsession
                                    <tr class="order-total">
                                        <th>Tổng</th>
                                        <td>
                                            <strong>
                                                <span
                                                    class="amount">{{ number_format(session('coupon') ? $total : $totalAmount, 0, ',', '.') }}<sup>đ</sup>
                                                </span>
                                                <input type="hidden" name="total_price"
                                                    value="{{ session('coupon') ? $total : $totalAmount }}">
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <h5>Payment Method</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="cod" value="cod" checked>
                                        <label class="form-check-label" for="cod">
                                            Thanh toán khi nhận hàng
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="momo" value="momo">
                                        <label class="form-check-label" for="momo">
                                            Thanh toán bằng MOMO
                                        </label>
                                    </div>
                                    {{-- <div class="card">
                                        <div class="card-header" id="#payment-1">
                                            <h5 class="panel-title">
                                                <a href="javascript:void(0)" class="" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Direct Bank Transfer.
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment
                                                    reference. Your order won’t be shipped until the funds have cleared in
                                                    our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="#payment-2">
                                            <h5 class="panel-title">
                                                <a href="javascript:void(0)" class="collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo">
                                                    Cheque Payment
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment
                                                    reference. Your order won’t be shipped until the funds have cleared in
                                                    our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="#payment-3">
                                            <h5 class="panel-title">
                                                <a href="javascript:void(0)" class="collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseThree" aria-expanded="false"
                                                    aria-controls="collapseThree">
                                                    PayPal
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment
                                                    reference. Your order won’t be shipped until the funds have cleared in
                                                    our account.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="order-button-payment">
                                    <input value="Place order" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <form action="{{ route('payment.momo') }}" method="post">
                @csrf
                <button type="submit">submit</button>
            </form> --}}
        </div>
    </div>
    <!-- Kenne's Checkout Area End Here -->
@endsection

@section('styles')
    <style>
        .form-check-input:checked {
            background-color: #a8741a;
            border-color: #a8741a;
        }
    </style>
@endsection

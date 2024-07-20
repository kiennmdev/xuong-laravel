@extends('client.layouts.master')

@section('title')
    Cart
@endsection

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Uren's Cart Area -->
    @if (session('cart'))
        <div class="kenne-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('checkout.view') }}" method="GET">
                            @csrf
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="kenne-product-remove">remove</th>
                                            <th class="kenne-product-thumbnail">images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="kenne-product-price">Unit Price</th>
                                            <th class="kenne-product-quantity">Quantity</th>
                                            <th class="kenne-product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach (session('cart') as $idProduct => $product)
                                            <tr class="product_cart">
                                                <td class="kenne-product-remove"><a href="javascript:void(0)"><i
                                                            class="fa fa-trash" title="Remove"></i></a></td>
                                                <td class="kenne-product-thumbnail"><a href="javascript:void(0)"><img
                                                            width="100px"
                                                            src="{{ !\Str::contains($product['image'], 'http') ? \Storage::url($product['image']) : $product['image'] }}"
                                                            alt="Uren's Cart Thumbnail"></a></td>
                                                <td class="kenne-product-name"><a
                                                        href="javascript:void(0)">{{ $product['name'] . ' ' . $product['color']['name'] }}</a>
                                                </td>
                                                @php
                                                    $price = $product['price_sale'] ?? $product['price_regular'];
                                                @endphp
                                                <td class="kenne-product-price">
                                                    <span class="amount">
                                                        {{ number_format($price, 0, ',', '.') }}<sup>đ</sup>
                                                    </span>
                                                    <input type="hidden" class="price" value="{{ $price }}">
                                                </td>
                                                <td class="quantity">
                                                    <label>Quantity</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box quantity_product"
                                                            value="{{ $product['quantity_purchase'] }}" type="number">
                                                        <div class="dec qtybutton decrementButton"><i
                                                                class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton incrementButton"><i
                                                                class="fa fa-angle-up"></i></div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">
                                                    <span class="amount total">
                                                    </span><sup>đ</sup>
                                                    <input type="hidden" name="total_price" class="totalPost">
                                                    <input type="hidden" class="id_product" value="{{ $idProduct }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                                placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon" type="button">
                                        </div>
                                        <div class="coupon2">
                                            <input class="button" name="update_cart" value="Update cart" type="button">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Subtotal
                                                <span>{{ number_format($totalAmount, 0, ',', '.') }}<sup>đ</sup></span>
                                            </li>
                                            <li>Total
                                                <span>{{ number_format($totalAmount, 0, ',', '.') }}<sup>đ</sup></span>
                                            </li>
                                        </ul>
                                        <button type="submit" class="checkout mt-3">Proceed to checkout</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="kenne-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h5>
                            Giỏ hàng chưa có sản phẩm! <a href="{{route('shop')}}" class="text-decoration-underline">Quay lại</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Uren's Cart Area End Here -->
@endsection

@section('styles')
    <style>
        .checkout {
            background-color: #242424;
            border: 0 none;
            border-radius: 2px;
            color: #ffffff;
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            height: 42px;
            letter-spacing: 1px;
            line-height: 42px;
            padding: 0 25px;
            text-transform: uppercase;
            width: inherit;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function totalPrice(productCart) {
                let quantity = productCart.find('.quantity_product').val();
                let priceInput = productCart.find('.price').val();
                let total = quantity * priceInput;
                let totalFormat = total.toLocaleString('vi-VN');
                productCart.find('.total').text(totalFormat);
                productCart.find('.totalPost').val(total);
            }

            // Sự kiện khi click vào nút tăng
            $('.incrementButton').click(function() {
                var productCart = $(this).closest('.product_cart');
                totalPrice(productCart);
            });

            // Sự kiện khi click vào nút giảm
            $('.decrementButton').click(function(productCart) {
                var productCart = $(this).closest('.product_cart');
                totalPrice(productCart);
            });

            $('.quantity_product').on('input change', function() {
                var productCart = $(this).closest('.product_cart');
                totalPrice(productCart);
            });

            $('.product_cart').each(function() {
                totalPrice($(this));
            });

        });
    </script>
@endsection

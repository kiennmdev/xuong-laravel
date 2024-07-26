@extends('client.layouts.master')

@section('title')
    {{ $product->slug }}
@endsection

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Product Detail</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Product Detail</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Single Product Variable Area -->
    <div class="sp-area">
        <div class="container">
            <div class="sp-nav">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="sp-img_area">
                            <div class="sp-img_slider slick-img-slider kenne-element-carousel"
                                data-slick-options='{
                                    "slidesToShow": 1,
                                    "arrows": false,
                                    "fade": true,
                                    "draggable": false,
                                    "swipe": false,
                                    "asNavFor": ".sp-img_slider-nav"
                                    }'>
                                @foreach ($product->galleries as $gallery)
                                    <div class="single-slide {{ $gallery->id }} zoom">
                                        <img src="{{ !\Str::contains($gallery->image, 'http') ? \Storage::url($gallery->image) : $gallery->image }}"
                                            alt="Kenne's Product Image">
                                    </div>
                                @endforeach
                            </div>
                            <div class="sp-img_slider-nav slick-slider-nav kenne-element-carousel arrow-style-2 arrow-style-3"
                                data-slick-options='{
                                    "slidesToShow": 3,
                                    "asNavFor": ".sp-img_slider",
                                    "focusOnSelect": true,
                                    "arrows" : true,
                                    "spaceBetween": 30
                                    }'
                                data-slick-responsive='[
                                            {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                            {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                            {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                            {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                            {"breakpoint":575, "settings": {"slidesToShow": 2}}
                                        ]'>

                                @foreach ($product->galleries as $gallery)
                                    <div class="single-slide {{ $gallery->id }}">
                                        <img src="{{ !\Str::contains($gallery->image, 'http') ? \Storage::url($gallery->image) : $gallery->image }}"
                                            alt="Kenne's Product Thumnail">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="sp-content">
                                <div class="sp-heading">
                                    <h5><a href="#">{{ $product->name }}</a></h5>
                                </div>
                                <span class="reference">Catelogue: {{ $product->catalogue->name }}</span>
                                <div class="rating-box">
                                    <ul>
                                        <li><i class="ion-android-star"></i></li>
                                        <li><i class="ion-android-star"></i></li>
                                        <li><i class="ion-android-star"></i></li>
                                        <li class="silver-color"><i class="ion-android-star"></i></li>
                                        <li class="silver-color"><i class="ion-android-star"></i></li>
                                    </ul>
                                </div>
                                <div class="sp-essential_stuff">
                                    <ul>
                                        <li>SKU: <a href="javascript:void(0)">{{ $product->sku }}</a></li>
                                        <li class="price-box">
                                            Price: <span class="old-price">
                                                {{ number_format($product->price_regular, 0, ',', '.') }}<sup>đ</sup>
                                            </span>
                                            <span class="new-price">
                                                {{ number_format($product->price_sale, 0, ',', '.') }}<sup>đ</sup> </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-size_box">
                                    <span>Size</span>
                                    <select class="myniceselect nice-select" name="product_size_id">
                                        @foreach ($sizes as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="product-size_box">
                                    <span>Color</span>
                                    <select class="myniceselect nice-select" name="product_color_id">
                                        @foreach ($colors as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="quantity">
                                    <label>Quantity</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" value="1" type="text" name="quantity">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <div class="qty-btn_area">
                                    <ul>
                                        <li>
                                            <button type="submit" class="qty-cart_btn">Add To Cart</button>
                                        </li>
                                        <li><a class="qty-wishlist_btn" href="javascript:void(0)" data-bs-toggle="tooltip"
                                                title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                        </li>
                                        <li><a class="qty-compare_btn" href="javascript:void(0)" data-bs-toggle="tooltip"
                                                title="Compare This Product"><i class="ion-ios-shuffle-strong"></i></a></li>
                                    </ul>
                                </div>
                                <div class="kenne-tag-line">
                                    <h6>Tags:</h6>
                                    @foreach ($product->tags as $tag)
                                        <a href="javascript:void(0)">{{ $tag->name }}</a>,
                                    @endforeach
                                </div>
                                <div class="kenne-social_link">
                                    <ul>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com/" data-bs-toggle="tooltip" target="_blank"
                                                title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="https://twitter.com/" data-bs-toggle="tooltip" target="_blank"
                                                title="Twitter">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li class="youtube">
                                            <a href="https://www.youtube.com/" data-bs-toggle="tooltip" target="_blank"
                                                title="Youtube">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-bs-toggle="tooltip"
                                                target="_blank" title="Google Plus">
                                                <i class="fab fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://rss.com/" data-bs-toggle="tooltip" target="_blank"
                                                title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kenne's Single Product Variable Area End Here -->

    <!-- Begin Product Tab Area Two -->
    <div class="product-tab_area-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sp-product-tab_nav">
                        <div class="product-tab">
                            <ul class="nav product-menu">
                                <li><a class="active" data-bs-toggle="tab"
                                        href="#description"><span>Description</span></a>
                                </li>
                                <li><a data-bs-toggle="tab" href="#comments"><span>Comments</span></a>
                                </li>
                                <li><a data-bs-toggle="tab" href="#specification"><span>Specification</span></a></li>
                                <li><a data-bs-toggle="tab" href="#reviews"><span>Reviews (1)</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content uren-tab_content">
                            <div id="description" class="tab-pane active show" role="tabpanel">
                                <div class="product-description">
                                    {!!$product->content!!}
                                </div>
                            </div>
                            <div id="comments" class="tab-pane" role="tabpanel">
                                <div class="tab-pane active" id="tab-comment">
                                    @if (Auth::check())
                                        <form class="form-horizontal" id="form-comment" method="POST" action="{{route('comment.save')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="form-group required second-child">
                                                <div class="col-sm-12 p-0">
                                                    <label class="control-label">Comment:</label>
                                                    <textarea class="review-textarea" name="content" id="con_message"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group last-child required mb-3">
                                                <div class="kenne-btn-ps_right">
                                                    <button class="kenne-btn" type="submit">Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div class="text-end mb-3">
                                            Vui lòng <a style="color: #a8741a" href="{{route('form.login')}}">đăng nhập</a> để bình luận.
                                        </div>
                                    @endif

                                    <div id="comment">
                                        @foreach ($comments as $comment)
                                            <div class="content row p-2">
                                                <div class="avatar col-1">
                                                    <img src="{{ Storage::url($comment->user->avatar) }}" alt=""
                                                        width="100%" class="rounded-circle">
                                                </div>
                                                <div class="text col-11 rounded-pill ps-4 pt-3"
                                                    style="background-color: #f5f5f5">
                                                    <span>{{ $comment->user->name }}</span>
                                                    <span><sup
                                                            class="text-secondary">{{ $comment->created_at }}</sup></span>
                                                    <p>
                                                        {{ $comment->content }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div id="specification" class="tab-pane" role="tabpanel">
                                <table class="table table-bordered specification-inner_stuff">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><strong>Memory</strong></td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td>test 1</td>
                                            <td>8gb</td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><strong>Processor</strong></td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td>No. of Cores</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="reviews" class="tab-pane" role="tabpanel">
                                <div class="tab-pane active" id="tab-review">
                                    <form class="form-horizontal" id="form-review">
                                        <div id="review">
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50%;"><strong>Customer</strong></td>
                                                        <td class="text-right">26/10/19</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <p>Good product! Thank you very much</p>
                                                            <div class="rating-box">
                                                                <ul>
                                                                    <li><i class="ion-android-star"></i></li>
                                                                    <li><i class="ion-android-star"></i></li>
                                                                    <li><i class="ion-android-star"></i></li>
                                                                    <li><i class="ion-android-star"></i></li>
                                                                    <li><i class="ion-android-star"></i></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <h2>Write a review</h2>
                                        <div class="form-group required">
                                            <div class="col-sm-12 p-0">
                                                <label>Your Email <span class="required">*</span></label>
                                                <input class="review-input" type="email" name="con_email"
                                                    id="con_email" required>
                                            </div>
                                        </div>
                                        <div class="form-group required second-child">
                                            <div class="col-sm-12 p-0">
                                                <label class="control-label">Share your opinion</label>
                                                <textarea class="review-textarea" name="con_message" id="con_message"></textarea>
                                                <div class="help-block"><span class="text-danger">Note:</span> HTML is
                                                    not
                                                    translated!</div>
                                            </div>
                                        </div>
                                        <div class="form-group last-child required">
                                            <div class="col-sm-12 p-0">
                                                <div class="your-opinion">
                                                    <label>Your Rating</label>
                                                    <span>
                                                        <select class="star-rating">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="kenne-btn-ps_right">
                                                <button class="kenne-btn">Continue</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Tab Area Two End Here -->

    <!-- Begin Product Area -->
    <div class="product-area pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Best Seller</h3>
                        <div class="product-arrow"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="kenne-element-carousel product-slider slider-nav"
                        data-slick-options='{
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "infinite": false,
                            "arrows": true,
                            "dots": false,
                            "spaceBetween": 30,
                            "appendArrows": ".product-arrow"
                            }'
                        data-slick-responsive='[
                            {"breakpoint":992, "settings": {
                            "slidesToShow": 3
                            }},
                            {"breakpoint":768, "settings": {
                            "slidesToShow": 2
                            }},
                            {"breakpoint":575, "settings": {
                            "slidesToShow": 1
                            }}
                        ]'>

                        @foreach ($productBestSellers as $productBestSeller)
                            
                        <div class="product-item">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="single-product.html">
                                        <img class="primary-img" src="{{Storage::url($productBestSeller->img_thumbnail)}}"
                                            alt="Kenne's Product Image">
                                        <img class="secondary-img" src="{{Storage::url($productBestSeller->img_thumbnail)}}"
                                            alt="Kenne's Product Image">
                                    </a>
                                    <span class="sticker">Bestseller</span>
                                    {{-- <div class="add-actions">
                                        <ul>
                                            <li class="quick-view-btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                    data-bs-toggle="tooltip" data-placement="right" title="Quick View"><i
                                                        class="ion-ios-search"></i></a>
                                            </li>
                                            <li><a href="wishlist.html" data-bs-toggle="tooltip" data-placement="right"
                                                    title="Add To Wishlist"><i class="ion-ios-heart-outline"></i></a>
                                            </li>
                                            <li><a href="compare.html" data-bs-toggle="tooltip" data-placement="right"
                                                    title="Add To Compare"><i class="ion-ios-reload"></i></a>
                                            </li>
                                            <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="right"
                                                    title="Add To cart"><i class="ion-bag"></i></a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>
                                <div class="product-content">
                                    <div class="product-desc_info">
                                        <h3 class="product-name"><a href="single-product.html">{{$productBestSeller->name}}</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">{{ number_format($productBestSeller->price_sale, 0, ',', '.') }}<sup>đ</sup></span>
                                            <span class="old-price">{{ number_format($productBestSeller->price_regular, 0, ',', '.') }}<sup>đ</sup></span>
                                        </div>
                                        <div class="rating-box">
                                            <ul>
                                                <li><i class="ion-ios-star"></i></li>
                                                <li><i class="ion-ios-star"></i></li>
                                                <li><i class="ion-ios-star"></i></li>
                                                <li><i class="ion-ios-star"></i></li>
                                                <li><i class="ion-ios-star"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
@endsection

@section('styles')
    <style>
        .sp-area .sp-nav .sp-content .qty-btn_area>ul li>button.qty-cart_btn {
            background-color: #a8741a;
            color: #ffffff;
            padding: 10px 15px;
        }
    </style>
@endsection

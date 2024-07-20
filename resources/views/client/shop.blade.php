@extends('client.layouts.master')

@section('title')
    Shop
@endsection

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->

    <!-- Begin Kenne's Content Wrapper Area -->
    <div class="kenne-content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2 order-lg-1">
                    <div class="kenne-sidebar-catagories_area">
                        <div class="kenne-sidebar_categories">
                            <div class="kenne-categories_title first-child">
                                <h5>Filter by price</h5>
                            </div>
                            <div class="price-filter">
                                <div id="slider-range"></div>
                                <div class="price-slider-amount">
                                    <div class="label-input">
                                        <label>price : </label>
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                        <button class="filter-btn">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kenne-sidebar_categories category-module">
                            <div class="kenne-categories_title">
                                <h5>Product Categories</h5>
                            </div>
                            <div class="sidebar-categories_menu">
                                <ul>
                                    @foreach ($catalogues as $catalogue)
                                        <li>
                                            <a
                                                href="{{ route('shop.slug', ['id' => $catalogue->id, 'slug' => $catalogue->slug]) }}">{{ $catalogue->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="kenne-sidebar_categories">
                            <div class="kenne-categories_title">
                                <h5>Color</h5>
                            </div>
                            <ul class="sidebar-checkbox_list">
                                <li>
                                    <a href="javascript:void(0)">Black (1)</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Blue (1)</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Gold (3)</a>
                                </li>
                            </ul>
                        </div> --}}
                        <div class="kenne-sidebar_categories">
                            <div class="kenne-categories_title kenne-tags_title">
                                <h5>Product Tags</h5>
                            </div>
                            <ul class="kenne-tags_list">
                                @foreach ($tags as $tag)
                                    
                                <li><a href="javascript:void(0)">{{$tag->name}}</a></li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-1 order-lg-2">
                    <div class="shop-toolbar">
                        <div class="product-view-mode">
                            <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top"
                                title="Grid View"><i class="fa fa-th"></i></a>
                            <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top"
                                title="List View"><i class="fa fa-th-list"></i></a>
                        </div>
                        {{-- <div class="product-page_count">
                            <p>Showing 1–9 of 40 results)</p>
                        </div> --}}
                        <div class="product-item-selection_area">
                            <div class="product-short">
                                <label class="select-label">Short By:</label>
                                <select class="nice-select myniceselect">
                                    <option value="1">Default sorting</option>
                                    <option value="2">Name, A to Z</option>
                                    <option value="3">Name, Z to A</option>
                                    <option value="4">Price, low to high</option>
                                    <option value="5">Price, high to low</option>
                                    <option value="5">Rating (Highest)</option>
                                    <option value="5">Rating (Lowest)</option>
                                    <option value="5">Model (A - Z)</option>
                                    <option value="5">Model (Z - A)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="shop-product-wrap grid gridview-3 row">

                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="product-item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <img class="primary-img"
                                                    src="{{ !\Str::contains($product->img_thumbnail, 'http') ? \Storage::url($product->img_thumbnail) : $product->img_thumbnail }}"
                                                    alt="Kenne's Product Image">
                                                <img class="secondary-img"
                                                    src="{{ !\Str::contains($product->img_thumbnail, 'http') ? \Storage::url($product->img_thumbnail) : $product->img_thumbnail }}"
                                                    alt="Kenne's Product Image">
                                            </a>
                                            <span
                                                class="sticker">-{{ number_format(($product->price_sale / $product->price_regular) * 100) }}%</span>
                                            {{-- <div class="add-actions">
                                                <ul>
                                                    <li class="quick-view-btn" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                            data-bs-toggle="tooltip" data-placement="right"
                                                            title="Quick View"><i class="ion-ios-search"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Add To Wishlist"><i
                                                                class="ion-ios-heart-outline"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Add To Compare"><i
                                                                class="ion-ios-reload"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)" data-bs-toggle="tooltip"
                                                            data-placement="right" title="Add To cart"><i
                                                                class="ion-bag"></i></a>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <h3 class="product-name single-line"><a
                                                        href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                                </h3>
                                                <div class="price-box">
                                                    <span class="new-price">
                                                        {{ number_format($product->price_sale, 0, ',', '.') }}<sup>đ</sup>
                                                    </span>
                                                    <span class="old-price">
                                                        {{ number_format($product->price_regular, 0, ',', '.') }}<sup>đ</sup>
                                                    </span>
                                                </div>
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-product_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <img src="{{ !\Str::contains($product->img_thumbnail, 'http') ? \Storage::url($product->img_thumbnail) : $product->img_thumbnail }}"
                                                    alt="Kenne's Product Image">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <div class="price-box">
                                                    <span
                                                        class="new-price">{{ number_format($product->price_regular, 0, ',', '.') }}<sup>đ</sup>
                                                    </span>
                                                    <span
                                                        class="old-price">{{ number_format($product->price_sale, 0, ',', '.') }}<sup>đ</sup>
                                                    </span>
                                                </div>
                                                <h6 class="product-name"><a
                                                        href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                                </h6>
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li><i class="ion-ios-star"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                        <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-short_desc">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco,Proin
                                                        lectus ipsum, gravida et mattis vulputate, tristique ut lectus
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- <div class="add-actions">
                                                <ul>
                                                    <li class="quick-view-btn" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                            data-bs-toggle="tooltip" data-placement="top"
                                                            title="Quick View"><i class="ion-ios-search"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)" data-bs-toggle="tooltip"
                                                            data-placement="top" title="Add To Wishlist"><i
                                                                class="ion-ios-heart-outline"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)" data-bs-toggle="tooltip"
                                                            data-placement="top" title="Add To Compare"><i
                                                                class="ion-ios-reload"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Add To cart"><i class="ion-bag"></i></a>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="kenne-paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="kenne-pagination-box primary-color">
                                            <li class="active"><a href="javascript:void(0)">1</a></li>
                                            <li><a href="javascript:void(0)">2</a></li>
                                            <li><a href="javascript:void(0)">3</a></li>
                                            <li><a href="javascript:void(0)">4</a></li>
                                            <li><a href="javascript:void(0)">5</a></li>
                                            <li><a class="Next" href="javascript:void(0)">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row mt-3">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Kenne's Content Wrapper Area End Here -->
@endsection

@section('styles')
    <style>
        .single-line {
            white-space: nowrap;
            /* Không cho phép xuống dòng */
            overflow: hidden;
            /* Ẩn phần văn bản tràn ra ngoài */
            text-overflow: ellipsis;
            /* Hiển thị dấu ba chấm (...) */
        }

        .pagination {
            --bs-pagination-active-bg: #a8741a;
            --bs-pagination-active-border-color: #a8741a;
        }
    </style>
@endsection

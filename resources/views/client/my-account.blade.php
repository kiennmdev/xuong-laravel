@extends('client.layouts.master')

@section('title')
    My Account
@endsection

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active"><a href="{{ route('my.account') }}">My Account</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Page Content Area -->
    <main class="page-content">
        <div class="account-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="account-dashboard-tab" data-bs-toggle="tab"
                                    href="#account-dashboard" role="tab" aria-controls="account-dashboard"
                                    aria-selected="false">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="account-orders-tab" data-bs-toggle="tab"
                                    href="#account-orders" role="tab" aria-controls="account-orders"
                                    aria-selected="true">Order List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="#account-address"
                                    role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-details-tab" data-bs-toggle="tab" href="#account-details"
                                    role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-logout-tab" href="{{ route('logout') }}" role="tab"
                                    aria-selected="false"
                                    onclick="return confirm('Bạn có chắc muốn đăng xuất không?')">Logout</a>
                            </li>
                            @if (Auth::user()->type === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" id="account-logout-tab" href="{{ route('admin.dashboard') }}"
                                        role="tab" aria-selected="false">Admin</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane fade" id="account-dashboard" role="tabpanel"
                                aria-labelledby="account-dashboard-tab">
                                <div class="myaccount-dashboard">
                                    <p>Hello <b>{{ Auth::user()->name }}</b></p>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{Storage::url(Auth::user()->avatar)}}" alt="Avatar" class="rounded" width="100px">
                                        <div>
                                            <p>Phone: {{Auth::user()->phone}}</p>
                                            <p>Address: {{Auth::user()->address}}</p>
                                        </div>
                                    </div>
                                    <p class="mt-2">From your account dashboard you can view your recent orders, manage your shipping and
                                        billing addresses and <a href="javascript:void(0)">edit your password and account
                                            details</a>.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="account-orders" role="tabpanel"
                                aria-labelledby="account-orders-tab">
                                <div class="myaccount-orders">
                                    <h4 class="small-title">MY ORDERS</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>ORDER</th>
                                                    <th>DATE</th>
                                                    <th>STATUS ORDER</th>
                                                    <th>STATUS PAYMENT</th>
                                                    <th>TOTAL</th>
                                                    <th></th>
                                                </tr>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>#{{ $order->id }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>{{ $order->status_order }}</td>
                                                        <td>{{ $order->status_payment }}</td>
                                                        <td>{{ number_format($order->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                        </td>
                                                        <td><a href="{{ route('order.detail', $order) }}"
                                                                class="kenne-btn kenne-btn_sm"><span>View</span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-address" role="tabpanel"
                                aria-labelledby="account-address-tab">
                                <div class="myaccount-address">
                                    <p>The following addresses will be used on the checkout page by default.</p>
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="small-title">Billing Adress</h4>
                                            <address>
                                                1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                            </address>
                                        </div>
                                        <div class="col">
                                            <h4 class="small-title">Shipping Address</h4>
                                            <address>
                                                1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-details" role="tabpanel"
                                aria-labelledby="account-details-tab">
                                <div class="myaccount-details">
                                    <form action="{{route('user.update', Auth::user())}}" class="kenne-form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="kenne-form-inner">
                                            <div class="single-input">
                                                <label for="account-details-firstname">Your Name*</label>
                                                <input type="text" id="account-details-firstname"
                                                    value="{{ Auth::user()->name }}" name="name">
                                            </div>
                                            <div class="single-input">
                                                <input type="file" id="account-details-firstname" name="avatar"  height="100%">
                                                <img src="{{Storage::url(Auth::user()->avatar)}}" alt="Avatar" class="rounded" width="100px">
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-email">Email*</label>
                                                <input type="email" id="account-details-email"
                                                    value="{{ Auth::user()->email }}" name="email">
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-oldpass">Phone number</label>
                                                <input type="text" id="account-details-oldpass" value="{{ Auth::user()->phone }}" name="phone">
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-newpass">Address</label>
                                                <input type="text" id="account-details-newpass" value="{{ Auth::user()->address }}" name="address">
                                            </div>
                                            <div class="single-input">
                                                <button class="kenne-btn kenne-btn_dark" type="submit" onclick="return confirm('Bạn có chắc muốn cập nhật thông tin tài khoản ?')"><span>SAVE
                                                        CHANGES</span></button>
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
        <!-- Kenne's Account Page Area End Here -->
    </main>
@endsection

@extends('client.layouts.master')

@section('title')
    Register
@endsection

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Login Or Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Login Register Area -->
    <div class="kenne-login-register_area">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Register</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Your Name</label>
                                    <input type="text" placeholder="Your Name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label>Email Address*</label>
                                    <input type="email" placeholder="Email Address" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="password" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                                <div class="col-12">
                                    <button class="kenne-register_btn" type="submit">Register</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="text-end">
                                        <p>Already have an account ? <a href="{{route('form.login')}}" class="fw-bold text-decoration-underline">Signin</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Kenne's Login Register Area  End Here -->
@endsection

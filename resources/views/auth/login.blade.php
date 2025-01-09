@extends('layouts.dashboard')
@section('title', 'Home')
@push('styles')

<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<!-- Magnific Popup -->
<link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
<!-- Fancybox -->
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
<!-- Themify Icons -->
<link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="{{ asset('css/niceselect.css') }}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="{{ asset('css/flex-slider.min.css') }}">
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
<!-- Slicknav -->
<link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">

<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

<!-- Color CSS -->
<!--<link rel="stylesheet" href="{{ asset('css/color/color.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color3.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color4.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color5.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color6.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color7.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color8.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color9.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color10.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color11.css') }}">-->
<!--<link rel="stylesheet" href="{{ asset('css/color/color12.css') }}">-->

<link rel="stylesheet" href="#" id="colors">


@endpush
@section('address', 'Login')
@section('breadcrumb')
<li class="breadcrumb-item active">Login</li>
@parent
@endsection
@section('content')
<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Login</h2>
                    <p>Please register in order to checkout more quickly</p>
                    <!-- Form -->
                    <form class="form" method="post" action="#">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Email<span>*</span></label>
                                    <input type="email" name="email" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Password<span>*</span></label>
                                    <input type="password" name="password" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <button class="btn" type="submit">Login</button>
                                    <a href="register.html" class="btn">Register</a>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Remember me</label>
                                </div>
                                <a href="#" class="lost-pass">Lost your password?</a>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
    </div>
</section>
@stop

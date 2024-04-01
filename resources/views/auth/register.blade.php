@extends('frontend.frontend_dashboard')
@section('main')

<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url(frontend/assets/images/shape/shape-9.png);"></div>
        <div class="pattern-2" style="background-image: url(frontend/assets/images/shape/shape-10.png);"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Register</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Register</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


 <!-- ragister-section -->
 <section class="ragister-section centred sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">User</li>
                            <li class="tab-btn" data-tab="#tab-2">Agent</li>
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <h4>Register</h4>
                                <form action="{{ route('register') }}" method="post" class="default-form">
                                    @csrf

                                    <div class="form-group">
                                        <label>User name</label>
                                        <input type="text" name="name" id="name" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" name="email" id="email" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" required="">
										<x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" required="">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Register</button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Already have an account? <a href="">Login</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <h4>Sign up</h4>
                                <form action="{{ route('register') }}" method="post" class="default-form">
                                    @csrf

                                    <div class="form-group">
                                        <label>Agent name</label>
                                        <input type="text" name="name" id="name" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" name="email" id="email" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" required="">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" required="">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Register</button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Already have an account? <a href="">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ragister-section end -->

@endsection

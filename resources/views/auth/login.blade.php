@extends('frontend.frontend_dashboard')
@section('main')

<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url(frontend/assets/images/shape/shape-9.png);"></div>
        <div class="pattern-2" style="background-image: url(frontend/assets/images/shape/shape-10.png);"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Login</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="">Home</a></li>
                <li>Login</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- ragister-section -->
<section class="ragister-section centred sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-xl-8 col-lg-8 offset-xl-2 big-column">
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
                                <h4>Sign in</h4>
                                <form action="{{ route('login') }}" method="post" class="default-form">
                                    @csrf

                                    <div class="form-group">
                                        <label>User Email/Name</label>
                                        <input type="text" name="login" id="login" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" required="">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Sign in</button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Have not any account? <a href="{{ route('register') }}">Register Now</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <h4>Sign in</h4>
                                <form action="{{ route('login') }}" method="post" class="default-form">
                                    @csrf
                                    <div class="form-group">
                                        <label>Agent Email/Name</label>
                                        <input type="text" name="login" id="login" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" required="">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Sign in</button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Don't have an account? <a href="{{ route('register') }}">Register Now</a></p>
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

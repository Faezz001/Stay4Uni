<header class="main-header">
<!-- header-lower -->
<div class="header-lower">
<div class="outer-box">
<div class="main-box">
<div class="logo-box">
<figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a></figure>
</div>
<div class="menu-area clearfix">
<!--Mobile Navigation Toggler-->
<div class="mobile-nav-toggler">
<i class="icon-bar"></i>
<i class="icon-bar"></i>
<i class="icon-bar"></i>
</div>
<nav class="main-menu navbar-expand-md navbar-light">
<div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
    <ul class="navigation clearfix">

    <li><a href="{{ url('/') }}"><span>Home</span></a> </li>
    <li><a href="{{ url('/listing/property') }}"><span>Accommodation</span></a> </li>

        @auth

        <li><a href="{{ route('dashboard') }}"><span>Dashboard</span></a></li>

        <li><a href="{{ route('user.logout') }}"><span>Logout</span></a></li>

        @else

        <li><a href="{{ route('login') }}"><span>Login</span></a></li>

        @endauth
    </ul>
</div>
</nav>
</div>
<div class="btn-box">
<a href="{{ route('agent.login') }}" class="theme-btn btn-one"><span>+</span>Add Listing</a>
</div>
</div>
</div>
</div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="{{ route('agent.login') }}" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                </div>
            </div>
        </div>
    </div>
</header>

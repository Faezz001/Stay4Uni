@extends('frontend.frontend_dashboard')
@section('main')


  <!--Page Title-->
           <section class="page-title-two bg-color-1 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
                <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>{{ $agent->name }}</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>{{ $agent->name }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- agent-details -->
        <section class="agent-details">
            <div class="auto-container">
                <div class="agent-details-content">
                    <div class="agents-block-one">
                        <div class="inner-box mr-0">
<figure class="image-box"><img src="{{ (!empty($agent->photo)) ? url('upload/agent_images/'.$agent->photo) : url('upload/no_image.jpg') }}" alt="" style="width:270px; height:330px;" ></figure>
<div class="content-box">
<div class="upper clearfix">
    <div class="title-inner pull-left">
        <h4>{{ $agent->name }}</h4>
        <span class="designation">{{ $agent->username }}</span>
    </div>
</div>
<ul class="info clearfix mr-0">
    <li><i class="fab fa fa-envelope"></i><a href="mailto:bean@realshed.com">{{ $agent->email }}</a></li>
    <li><i class="fab fa fa-phone"></i>
    	<a href="tel:03030571965">{{ $agent->phone }}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- agent-details end -->


<!-- agents-page-section -->
<section class="agents-page-section agent-details-page">
<div class="auto-container">
<div class="row clearfix">
<div class="col-lg-8 col-md-12 col-sm-12 content-side">
<div class="agents-content-side tabs-box">
<div class="group-title">
<h3>Listing By {{ $agent->name }}</h3>
</div>

<div class="tabs-content">
<div class="tab active-tab" id="tab-1">
    <div class="wrapper list">
        <div class="deals-list-content list-item">


            @foreach($property as $item)
            <div class="deals-block-one">
                <div class="inner-box">
                    <div class="image-box">
                        <figure class="image"><img src="{{ asset($item->property_thumbnail  ) }}" alt=""  style="width:300px; height:350px;"></figure>
                        <div class="buy-btn"><a href="property-details.html">{{ $item->property_status }}</a></div>
                    </div>
                    <div class="lower-content">
                        <div class="title-text"><h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4></div>
                        <div class="price-box clearfix">
                            <div class="price-info pull-left">
                                <h6>Monthly</h6>
                                <h4>{{ $item->rental_price }}</h4>
                            </div>

                        </div>
                        <p>{{ $item->short_descp }}</p>
                        <ul class="more-details clearfix">
                            <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                            <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                            <li><i class="{{ $item->type->type_icon }}"></i>{{ $item->type->type_name }}</li>
                        </ul>
                        <div class="other-info-box clearfix">
                            <div class="btn-box pull-left"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two">See Details</a></div>
                            <ul class="other-option pull-right clearfix">
                                <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                            </ul>
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
</div>
</div>
</div>

        </section>
        <!-- agents-page-section end -->

@endsection

@extends('frontend.frontend_dashboard')
@section('main')

<!-- Page Title -->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Property Search</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Property Search</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="default-sidebar property-sidebar">
                    <div class="filter-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Property</h5>
                        </div>
                        @php
                            $ptypes = App\Models\PropertyType::latest()->get();
                        @endphp

                        <form action="{{ route('all.property.search') }}" method="post" class="search-form">
                            @csrf
                            <div class="widget-content">
                                <div class="select-box">
                                    <select name="property_status" class="wide">
                                        <option data-display="All Type">Status</option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select name="ptype_id" class="wide">
                                        <option data-display="Type" selected="" disabled="">Select Type</option>
                                        @foreach($ptypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select name="bedrooms" class="wide">
                                        <option data-display="Rooms">Max Rooms</option>
                                        <option value="1">1 Room</option>
                                        <option value="2">2 Rooms</option>
                                        <option value="3">3 Rooms</option>
                                        <option value="4">4 Rooms</option>
                                        <option value="5">5 Rooms</option>
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select name="bathrooms" class="wide">
                                        <option data-display="Bathrooms">Max Bathrooms</option>
                                        <option value="1">1 Bathroom</option>
                                        <option value="2">2 Bathrooms</option>
                                        <option value="3">3 Bathrooms</option>
                                        <option value="4">4 Bathrooms</option>
                                        <option value="5">5 Bathrooms</option>
                                    </select>
                                </div>

                                <div class="filter-btn">
                                    <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            <h5>Search Results: <span>Showing {{ $properties->count() }} Listings</span></h5>
                        </div>
                    </div>
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            @if($properties->isEmpty())
                                <p>No properties found based on the selected criteria.</p>
                            @else
                                @foreach($properties as $item)
                                    <div class="deals-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset($item->property_thumbnail) }}" alt="" style="width:300px; height:350px;"></figure>
                                                <div class="buy-btn"><a href="property-details.html">{{ $item->property_status }}</a></div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="title-text">
                                                    <h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Monthly</h6>
                                                        <h4>{{ $item->rental_price }}</h4>
                                                    </div>
                                                </div>
                                                <p>{{ $item->short_desc }}</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                                    <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                                    <li><i class="{{ $item->type->type_icon }}"></i>{{ $item->type->type_name }}</li>
                                                </ul>
                                                <div class="other-info-box clearfix">
                                                    <div class="btn-box pull-left">
                                                        <a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two">See Details</a>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)"><i class="icon-13"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->

@endsection

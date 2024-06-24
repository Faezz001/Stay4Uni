@php
$property = App\Models\Property::where('status','1')->limit(3)->get();
$agents = App\Models\User::where('status','active')->where('role','agent');
@endphp

<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h2>Featured Accommodation</h2>
        </div>
        <div class="row clearfix">

            @foreach($property as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="{{ asset($item->property_thumbnail) }}" alt=""></figure>
                        </div>
                        <div class="lower-content">
                            <div class="author-info clearfix">
                                <div class="author pull-left">
                                            <h6>{{ $item->user->name ?? 'None'}}</h6>
                                    <div class="title-text"><h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4></div>
                                </div>
                                <div class="buy-btn pull-right"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_status }}</a></div>
                            </div>
                            <div class="price-box clearfix">
                                <div class="price-info pull-left">
                                    <h6>Monthly Rent</h6>
                                    <h4>{{ $item->rental_price }}</h4>
                                </div>
                                <ul class="other-option pull-right clearfix">
                                    <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                                </ul>
                            </div>
                            <p>{{ $item->short_descp }}</p>
                            <ul class="more-details clearfix">
                                <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                <li><i class="{{ $item->type->type_icon }}"></i>{{ $item->type->type_name }}</li>
                            </ul>
                            <div class="btn-box"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two">See Details</a></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="more-btn centred"><a href="{{ url('/listing/property') }}" class="theme-btn btn-one">View All Listing</a></div>
    </div>
</section>

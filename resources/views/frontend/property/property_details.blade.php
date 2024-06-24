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
            <h1>{{ $property->property_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>{{ $property->property_name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- property-details -->
<section class="property-details property-details-one">
    <div class="auto-container">
        <div class="top-details clearfix">
            <div class="left-column pull-left clearfix">
                <h3>{{ $property->property_name }}</h3>
            </div>
            <div class="right-column pull-right clearfix">
                <div class="price-inner clearfix">
                    <ul class="category clearfix pull-left">
                        <li><a href="property-details.html">{{ $property->type->type_name }}</a></li>
                        <li><a href="property-details.html">Currently {{ $property->property_status }}</a></li>
                    </ul>
                    <div class="price-box pull-right">
                        <h3>{{ $property->rental_price }}</h3>
                    </div>
                </div>
                <ul class="other-option pull-right clearfix">
                    <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $property->id }}" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                    <li>{!! Share::page(url()->current(), $property->property_name)->whatsapp() !!}</li>
                </ul>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-details-content">
                    <div class="carousel-inner">
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                            @foreach($multiImage as $img)
                            <figure class="image-box"><img src="{{ asset($img->photo_name) }}" alt=""></figure>
                            @endforeach
                        </div>
                    </div>
                    <div class="discription-box content-widget">
                        <div class="title-box">
                            <h4>Property Description</h4>
                        </div>
                        <div class="text">
                            <p>{!! $property->long_desc !!}</p>
                        </div>
                    </div>
                    <div class="details-box content-widget">
                        <div class="title-box">
                            <h4>Property Details</h4>
                        </div>
                        <ul class="list clearfix">
                            <li>Property ID: <span>{{ $property->property_code }}</span></li>
                            <li>Rooms: <span>{{ $property->bedrooms }}</span></li>
                            <li>Property Type: <span>{{ $property->type->type_name }}</span></li>
                            <li>Bathrooms: <span>{{ $property->bathrooms }}</span></li>
                        </ul>
                    </div>
                    <div class="amenities-box content-widget">
                        <div class="title-box">
                            <h4>Amenities</h4>
                        </div>
                        <ul class="list clearfix">
                            @foreach($property_amen as $amen)
                            <li>{{ $amen }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="location-box content-widget">
                        <div class="title-box">
                            <h4>Location</h4>
                        </div>
                        <ul class="info clearfix">
                            <li><span>Address:</span> {{ $property->address }}</li>
                            <li><span>State:</span> {{ $property->state }}</li>
                            <li><span>Zip:</span> {{ $property->zip }}</li>
                            <li><span>City:</span> {{ $property->city }}</li>
                        </ul>
                    </div>
                    <div class="nearby-box content-widget">
                        <div class="title-box">
                            <h4>Nearby Places</h4>
                        </div>
                        <div class="inner-box">
                            <div class="single-item">
                                <div class="icon-box"><i class="fas fa-book-reader"></i></div>
                                <div class="inner">
                                    <h5>Places:</h5>
                                    @foreach($facility as $item)
                                    <div class="box clearfix">
                                        <div class="text pull-left">
                                            <h6>{{ $item->facility_name }} <span>({{ $item->distance }} km)</span></h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Move the sidebar column into the same row as the main content column -->
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="property-sidebar default-sidebar">
                    <div class="author-widget sidebar-widget">
                        <div class="author-box">
                            @if($property->agent_id == Null)
                            <figure class="author-thumb"><img src="{{ url('upload/ariyan.jpg') }}" alt=""></figure>
                            <div class="inner">
                                <h4>Admin</h4>
                                <ul class="info clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i>84 St. John Wood High Street, St Johns Wood</li>
                                    <li><i class="fas fa-phone"></i><a href="tel:03030571965">030 3057 1965</a></li>
                                </ul>
                                <div class="btn-box"><a href="agents-details.html">View Listing</a></div>
                            </div>
                            @else
                            <figure class="author-thumb"><img src="{{ (!empty($property->user->photo)) ? url('upload/agent_images/'.$property->user->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                            <div class="inner">
                                <h4>{{ $property->user->name }}</h4>
                                <ul class="info clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i>{{ $property->user->address }}</li>
                                    <li><i class="fas fa-phone"></i><a href="https://wa.me/{{ $property->user->phone }}">{{ $property->user->phone }}</a></li>
                                </ul>
                                <div class="btn-box"><a href="{{ route('agent.details',$property->user->id) }}">Show Agent Profile</a></div>
                            </div>
                            @endif
                        </div>

                        <div class="form-inner">
                            @auth

                            @php
                                $id = Auth::user()->id;
                                $userData = App\Models\User::find($id);
                            @endphp

                             <form action="{{ route('property.complaint') }}" method="post" class="default-form">
                                @csrf

                                <input type="hidden" name="property_id" value="{{ $property->id }}">

                                @if($property->agent_id == Null)
                                <input type="hidden" name="agent_id" value="">

                                @else
                                <input type="hidden" name="agent_id" value="{{ $property->agent_id }}">
                                @endif


                                        <div class="form-group">
                                            <input type="text" name="complaint_name" placeholder="Your name" value="{{ $userData->name }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="complaint_email" placeholder="Your Email" value="{{ $userData->email }}">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="complaint" placeholder="Fill in your complaint"></textarea>
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Submit Complaint</button>
                                        </div>
                                    </form>

                            @else

                            <form action="{{ route('property.complaint') }}" method="post" class="default-form">
                                @csrf

                                <input type="hidden" name="property_id" value="{{ $property->id }}">

                                @if($property->agent_id == Null)
                                <input type="hidden" name="agent_id" value="">

                                @else
                                <input type="hidden" name="agent_id" value="{{ $property->agent_id }}">
                                @endif




                                        <div class="form-group">
                                            <input type="text" name="complaint_name" placeholder="Your name" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="complaint_email" placeholder="Your Email" required="">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="complaint" placeholder="Fill in your complaint"></textarea>
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Submit Complaint</button>
                                        </div>
                                    </form>

                            @endauth



                                </div>
                    </div>
                </div>
            </div>




                </div>

            <!-- End sidebar column -->
        </div>
    </div>
</section>
<!-- property-details end -->

@endsection

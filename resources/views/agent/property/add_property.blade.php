@extends('agent.agent_dashboard')
@section('agent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property</h6>
                        <form method="post" action="{{ route('agent.store.property') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Name</label>
                                        <input type="text" name="property_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Status</label>
                                        <select name="property_status" class="form-select" required>
                                            <option selected="" disabled="">Select Status</option>
                                            <option value="Available">Available</option>
                                            <option value="Unavailable">Unavailable</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Rental Price</label>
                                        <input type="text" name="rental_price" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Thumbnail</label>
                                        <input type="file" name="property_thumbnail" class="form-control" onChange="mainThamUrl(this)" required>
                                    </div>
                                    <img src="" id="mainThmb" style="display:none;" />
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Multiple Image</label>
                                        <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple required>
                                    </div>
                                    <div class="row" id="preview_img"></div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Type</label>
                                        <select name="ptype_id" class="form-select" required>
                                            <option selected="" disabled="">Select Type</option>
                                            @foreach($propertytype as $ptype)
                                            <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Property Amenities</label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%" required>
                                            @foreach($amenities as $ameni)
                                            <option value="{{ $ameni->id }}">{{ $ameni->amenities_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bedrooms</label>
                                        <input type="text" name="bedrooms" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bathrooms</label>
                                        <input type="text" name="bathrooms" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row add_item">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="facility_name" class="form-label">Facilities</label>
                                        <select name="facility_name[]" id="facility_name" class="form-control">
                                            <option value="">Select Facility</option>
                                            <option value="UNIMAS">UNIMAS</option>
                                            <option value="Airport">Airport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="distance" class="form-label">Distance</label>
                                        <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4" style="padding-top: 30px;">
                                    <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Long Description</label>
                                    <textarea class="form-control" name="long_desc" rows="10" required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Enter address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" placeholder="Enter city" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" placeholder="Enter state" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Zip</label>
                                        <input type="text" name="zip" class="form-control" placeholder="Enter zip code" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Property</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-1">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="facility_name">Facilities</label>
                        <select name="facility_name[]" id="facility_name" class="form-control">
                            <option value="">Select Facility</option>
                            <option value="UNIMAS">UNIMAS</option>
                            <option value="Airport">Airport</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
   var counter = 0;
   $(document).on("click",".addeventmore",function(){
         var whole_extra_item_add = $("#whole_extra_item_add").html();
         $(this).closest(".add_item").append(whole_extra_item_add);
         counter++;
   });
   $(document).on("click",".removeeventmore",function(event){
         $(this).closest("#whole_extra_item_delete").remove();
         counter -= 1
   });
});
</script>

<script type="text/javascript">
$(document).ready(function (){
    $('#myForm').validate({
        rules: {
            property_name: {
                required : true,
            },
            property_status: {
                required : true,
            },
            rental_price: {
                required : true,
            },
            property_thumbnail: {
                required : true,
            },
            ptype_id: {
                required : true,
            },
        },
        messages :{
            property_name: {
                required : 'Please Enter Property Name',
            },
            property_status: {
                required : 'Please Select Property Status',
            },
            rental_price: {
                required : 'Please Enter Rental Price',
            },
            ptype_id: {
                required : 'Please Select Property Type',
            },
            property_thumbnail: {
                required : 'Please Enter Property Thumbnail',
            },
        },
        errorElement : 'span',
        errorPlacement: function (error,element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight : function(element, errorClass, validClass){
            $(element).addClass('is-invalid');
        },
        unhighlight : function(element, errorClass, validClass){
            $(element).removeClass('is-invalid');
        },
    });
});
</script>

<script type="text/javascript">
function mainThamUrl(input){
if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
        $('#mainThmb').attr('src',e.target.result).width(80).height(80).show();
    };
    reader.readAsDataURL(input.files[0]);
}
}
</script>

<script>
$(document).ready(function(){
    $('#multiImg').on('change', function(){
        if (window.File && window.FileReader && window.FileList && window.Blob){
            var data = $(this)[0].files;
            $.each(data, function(index, file){
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){
                    var fRead = new FileReader();
                    fRead.onload = (function(file){
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100).height(80);
                            $('#preview_img').append(img);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                }
            });
        }else{
            alert("Your browser doesn't support File API!");
        }
    });
});
</script>

@endsection

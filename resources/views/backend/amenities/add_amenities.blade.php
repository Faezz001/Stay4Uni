@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">

        <div class="row profile-body">
          <!-- left wrapper start -->
          <!-- left wrapper end -->
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
             <div class="card">
              <div class="card-body">

			<h6 class="card-title">Add Amenities  </h6>

			<form id="myForm" method="POST" action="{{ route('store.amenities') }}" class="forms-sample">
				@csrf


				<div class="form-group mb-3">
 <label for="TypeProperty" class="form-label">Amenities  </label>
					 <input type="text" name="amenities_name" class="form-control">
				</div>

	 <button type="submit" class="btn btn-primary me-2">Add Amenities </button>

			</form>
              </div>
            </div>
            </div>
          </div>
          <!-- middle wrapper end -->
          <!-- right wrapper start -->

          <!-- right wrapper end -->
        </div>
			</div>


            <script type="text/javascript">
                $(document).ready(function (){
                    $('#myForm').validate({
                        rules: {
                            amenities_name: {
                                required : true,
                            },

                        },
                        messages :{
                            amenities_name: {
                                required : 'Please Enter Amenities',
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

@endsection

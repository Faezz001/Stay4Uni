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

			<h6 class="card-title">Edit User   </h6>

  <form id="myForm" method="POST" action="{{ route('update.user') }}" class="forms-sample">
				@csrf

    <input type="hidden" name="id" value="{{ $alluser->id }}">

				<div class="form-group mb-3">
 <label for="exampleInputEmail1" class="form-label">User Name   </label>
	 <input type="text" name="name" class="form-control" value="{{ $alluser->name }}" >
				</div>

                <div class="form-group mb-3">
 <label for="exampleInputEmail1" class="form-label">User Email   </label>
     <input type="email" name="email" class="form-control"  value="{{ $alluser->email }}" >
                </div>


                <div class="form-group mb-3">
 <label for="exampleInputEmail1" class="form-label">User Phone   </label>
     <input type="text" name="phone" class="form-control"  value="{{ $alluser->phone }}"  >
                </div>



                <div class="form-group mb-3">
 <label for="exampleInputEmail1" class="form-label">User Address   </label>
     <input type="text" name="address" class="form-control"  value="{{ $alluser->address }}" >
                </div>




	 <button type="submit" class="btn btn-primary me-2">Save Changes </button>

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
                name: {
                    required : true,
                },
                 email: {
                    required : true,
                },
                 phone: {
                    required : true,
                },
                 password: {
                    required : true,
                },

            },
            messages :{
                name: {
                    required : 'Please Enter Name',
                },
                 email: {
                    required : 'Please Enter Email',
                },
                 phone: {
                    required : 'Please Enter Phone',
                },
                 password: {
                    required : 'Please Enter Password',
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

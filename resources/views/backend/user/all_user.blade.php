@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<div class="page-content">


				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All User </h6>

                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>Image </th>
                        <th>Name </th>
                        <th>Role </th>
                        <th>Phone Number </th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($alluser as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ (!empty($item->photo)) ? url('upload/agent_images/'.$item->photo) : url('upload/no_image.jpg') }}" style="width:60px; height:60px;"> </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->role }}</td>
                        <th>{{ $item->phone}}</th>


                        <td>


       <a href="{{ route('edit.user',$item->id) }}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>

       <a href="{{ route('delete.user',$item->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
                        </td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

			</div>

            <script type="text/javascript">
                $(function() {
                    $('.toggle-class').change(function() {
                        var status = $(this).prop('checked') == true ? 1 : 0;
                        var user_id = $(this).data('id');

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '/changeStatus',
                            data: {'status': status, 'user_id': user_id},
                            success: function(data){
                    if ($.isEmptyObject(data.error)) {
                        // Success notification
                        toastr.success(data.success, 'Success');
                    } else {
                        // Error notification
                        toastr.error(data.error, 'Error');
                    }

                    // Refresh the page after 3 seconds
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            });
        });
    });
</script>




@endsection

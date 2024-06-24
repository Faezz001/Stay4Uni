@extends('agent.agent_dashboard')
@section('agent')



<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
<a href="{{ route('agent.add.property') }}" class="btn btn-inverse-info"> Add Property</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Property All </h6>

    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>No </th>
            <th>Property Name </th>
            <th>Property Type </th>
            <th>Status Type </th>
            <th>Rental Price </th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zipcode</th>
            <th>Action </th>
          </tr>
        </thead>
        <tbody>
       @foreach($property as $key => $item)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item->property_name }}</td>
            <td>{{ $item['type']['type_name'] }}</td>
            <td>{{ $item->property_status }}</td>
            <td>{{ $item->rental_price }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->city }}</td>
            <td>{{ $item->state }}</td>
            <td>{{ $item->zip }}</td>
            <td>
<a href="{{ route('agent.edit.property',$item->id) }}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>
<a href="{{ route('agent.delete.property',$item->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i> </a>
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

@endsection

@extends('agent.agent_dashboard')
@section('agent')

@php

$id = Auth::user()->id;
$profileData = App\Models\User::find($id);
$agentId = App\Models\User::find($id);
$status = $agentId->status;
$totalProperties = App\Models\Property::count();
$availableStatus = App\Models\Property::where('agent_id', $id)->where('property_status', 'available')->count();
$unavailableStatus = App\Models\Property::where('agent_id', $id)->where('property_status', 'unavailable')->count();

@endphp

 <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Welcome {{ $profileData->name }}</h4>
        </div>
        <div>
            @if($status === 'active')
    <h5> Your account is <span class="text-success">Verified </span> </h5>

    @else
 <h5>Your account is <span class="text-danger">Unverified </span> </h5>
 <p class="text-danger"><b> Please e-mail your administrator to activate your account</b></p>
    @endif
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Your Total Accommodation Listed</h6>
                      <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $totalProperties }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body ">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total Listed Available Accommodation</h6>
                      <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $availableStatus }}</h3>
                        <div class="d-flex align-items-baseline">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total Listed Unavailable Accommodation</h6>
                      <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{ $unavailableStatus }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->


        <!-- row -->

      </div>

@endsection

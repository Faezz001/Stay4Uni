<nav class="navbar">
    <a href="#" class="sidebar-toggler">
      <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
      <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
              <p>9 New Messages</p>
              <a href="javascript:;" class="text-muted">Clear all</a>
            </div>
            <div class="p-1">
              <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                <div class="d-flex justify-content-between flex-grow-1">
                  <div class="me-4">
                    <p>Leonardo Payne</p>
                    <p class="tx-12 text-muted">Project status</p>
                  </div>
                  <p class="tx-12 text-muted">2 min ago</p>
                </div>
              </a>
              <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                <div class="me-3">
                  <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
                </div>
                <div class="d-flex justify-content-between flex-grow-1">
                  <div class="me-4">
                    <p>Carl Henson</p>
                    <p class="tx-12 text-muted">Client meeting</p>
                  </div>
                  <p class="tx-12 text-muted">30 min ago</p>
                </div>
              </a>
              <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                <div class="me-3">
                  <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
                </div>
                <div class="d-flex justify-content-between flex-grow-1">
                  <div class="me-4">
                    <p>Jensen Combs</p>
                    <p class="tx-12 text-muted">Project updates</p>
                  </div>
                  <p class="tx-12 text-muted">1 hrs ago</p>
                </div>
              </a>
              <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                <div class="me-3">
                  <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
                </div>
                <div class="d-flex justify-content-between flex-grow-1">
                  <div class="me-4">
                    <p>Amiah Burton</p>
                    <p class="tx-12 text-muted">Project deatline</p>
                  </div>
                  <p class="tx-12 text-muted">2 hrs ago</p>
                </div>
              </a>
              <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                <div class="me-3">
                  <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
                </div>
                <div class="d-flex justify-content-between flex-grow-1">
                  <div class="me-4">
                    <p>Yaretzi Mayo</p>
                    <p class="tx-12 text-muted">New record</p>
                  </div>
                  <p class="tx-12 text-muted">5 hrs ago</p>
                </div>
              </a>
            </div>
            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
              <a href="javascript:;">View all</a>
            </div>
          </div>
        </li>
        

      @php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
      @endphp


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/agent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
          </a>
          <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
              <div class="mb-3">
                <img class="wd-80 ht-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/agent_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="">
              </div>
              <div class="text-center">
                <p class="tx-16 fw-bolder">{{ $profileData->name }}</p>
                <p class="tx-12 text-muted">{{ $profileData->email }}</p>
              </div>
            </div>
            <ul class="list-unstyled p-1">
              <li class="dropdown-item py-2">
  <a href="{{ route('agent.profile') }}" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="user"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li class="dropdown-item py-2">
                <a href="{{ route('agent.change.password') }}" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="edit"></i>
                  <span>Change Password</span>
                </a>
              </li>
              <li class="dropdown-item py-2">
                <a href="javascript:;" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="repeat"></i>
                  <span>Switch User</span>
                </a>
              </li>
              <li class="dropdown-item py-2">
   <a href="{{ route('agent.logout') }}" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="log-out"></i>
                  <span>Log Out</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </nav>

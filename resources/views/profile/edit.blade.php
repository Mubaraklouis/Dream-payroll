<x-admin-layout>
    <x-slot:title>My profile</x-slot:title>
  
    <main id="main" class="main">
  
      <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Home</a></li>
            <li class="breadcrumb-item">{{ ucfirst($auth->role) }}</li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">
  
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
  
                <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                <h2>{{ $auth->name }}</h2>
                <h3>{{ ucfirst($auth->role) }}</h3>
  
              </div>
            </div>
  
          </div>
  
          <div class="col-xl-8">
  
            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
  
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>
  
  
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>
  
                </ul>
                <div class="tab-content pt-2">
  
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">About</h5>
                    <p class="small fst-italic">The Dream Bridge Payroll System is designed to serve employees of Dream Bridge Consultants Ltd. It allows employees to check and calculate their financial dues automatically and generates their payment files efficiently.</p>
  
                    <h5 class="card-title">Profile Details</h5>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                      <div class="col-lg-9 col-md-8">{{ $auth->name }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Company</div>
                      <div class="col-lg-9 col-md-8">{{ $auth->company }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Job</div>
                      <div class="col-lg-9 col-md-8">{{ $auth->job }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Country</div>
                      <div class="col-lg-9 col-md-8">{{ $auth->country }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">City</div>
                      <div class="col-lg-9 col-md-8">{{ $auth->city }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Phone</div>
                      <div class="col-lg-9 col-md-8">{{ $auth->phone_number }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8">{{ $auth->email }}</div>
                    </div>
  
                  </div>
  
                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
  
                    <!-- Profile Edit Form -->
                    <form action="{{route("profile.update")}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method("PATCH")

                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>

                        <div class="col-md-8 col-lg-9">
                          <img src="{{ $auth->image_url }}" alt="Profile">
                          <div class="pt-2">
                            <label for="profileImage" class="btn btn-primary btn-sm" aria-label="Upload new profile image"><i class="bi bi-upload"></i></label>
                            <input type="file" name="image" id="profileImage" hidden>
                            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                          </div>
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="ame" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="name" type="text" class="form-control" id="name" value="{{ old("name", $auth->name) }}">
                          @error("name")
                            <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      {{-- <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="about" class="form-control" id="about" style="height: 100px">The Dream Bridge Payroll System is designed to serve employees of Dream Bridge Consultants Ltd. It allows employees to check and calculate their financial dues automatically and generates their payment files efficiently.</textarea>
                        </div>
                      </div> --}}
  
                      <div class="row mb-3">
                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="text" name="company" id="company" class="form-control" value="{{ old("company", $auth->company) }}">
                          @error("company")
                            <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="job" type="text" class="form-control" id="job" value="{{ old("job", $auth->job) }}">
                          @error("job")
                            <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="country" type="text" class="form-control" id="country" value="{{ old("country", $auth->country) }}">
                          @error("country")
                            <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="city" type="text" class="form-control" id="city" value="{{ old("city", $auth->city) }}">
                          @error("city")
                            <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="phone_number" type="text" class="form-control" id="Phone" value="{{ old("phone_number", $auth->phone_number) }}">
                          @error("phone_number")
                            <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="Email" value="{{ old("email", $auth->email) }}">
                          @error("email")
                            <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
  
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form><!-- End Profile Edit Form -->
  
                  </div>
  
                  <div class="tab-pane fade pt-3" id="profile-settings">
  
  
  
                  </div>
  
                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                      @csrf
                      @method('PUT')
  
                      <div class="row mb-3">
                        <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="current_password" type="password" class="form-control" id="current_password" autocomplete="current-password">
                          @error("current_password")
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password" type="password" class="form-control" id="newPassword" autocomplete="new-password">
                          @error("password")
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password_confirmation" type="password" class="form-control" id="renewPassword" autocomplete="new-password">
                        </div>
                      </div>
  
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                      </div>
                    </form><!-- End Change Password Form -->
  
                  </div>
  
                </div><!-- End Bordered Tabs -->
  
              </div>
            </div>
  
          </div>
        </div>
      </section>
  
    </main><!-- End #main -->
</x-admin-layout>

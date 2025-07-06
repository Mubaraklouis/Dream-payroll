<x-admin-layout>

    <x-slot:title>Add new employee</x-slot:title>
  
    <main id="main" class="main">
  
      <div class="pagetitle">
        <h1>New Employee</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Home</a></li>
            <li class="breadcrumb-item">Employees</li>
            <li class="breadcrumb-item active">Add employee</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
          <div class="col-lg-6">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add new Employee</h5>

                @session("success")
                  <small class="text-success">{{ $value }}</small>
                @endsession
  
                <!-- Horizontal Form -->
                <form action="{{ route("employee.store") }}" method="POST">
                  @csrf

                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Names</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputText" name="name" required autocomplete="name">
                      @error("name")
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="email" required autocomplete="usename">
                      @error("email")
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  {{-- <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Key</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Automatic generation..." id="no-clic" readonly>
                    </div>
                  </div> --}}
  
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Add Employee</button>
                    {{-- <button type="reset" class="btn btn-secondary btn-sm">Reset</button> --}}
                  </div>
                </form><!-- End Horizontal Form -->
  
              </div>
            </div>
  
          </div>
  
          <div class="col-lg-6">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Accounts not validated</h5>
                
                @foreach($pending_employees as $employee)
                <!-- DEBUT ACCORDION -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed sub-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      {{ $employee->name }}
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <!-- Horizontal Form -->
                      <form>
                        <div class="row mb-3">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Names</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value=" {{ $employee->name }}" id="inputText">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" value=" {{ $employee->email }}" id="inputEmail">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">Key</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value=" {{ $employee->otp }}" id="no-clic" readonly>
                          </div>
                        </div>
                        
                      </form><!-- End Horizontal Form -->
                      <div class="text-center">
                        <form class="text-center" action="{{ route("employee.delete", $employee) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          {{-- <button type="button" class="btn btn-primary btn-sm">Generate Unique Key</button> --}}
                          <button type="submit" class="btn btn-danger btn-sm" style="align-self:end; margin-bottom:8px;">Delete Employee</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                <!-- END ACCORDION -->
  
              </div>
            </div>
  
          </div>
        </div>
      </section>
  
    </main><!-- End #main -->
</x-admin-layout>

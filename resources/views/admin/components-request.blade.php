
<x-admin-layout>
    
  <x-slot:title>Employee requests</x-slot:title>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Employee requests</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Employee requests</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Employee account requests</h5>
              <!-- Default Accordion -->
              <div class="accordion" id="accordionExample">
                @foreach($pending_employees as $employee)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button sub-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      #{{ $employee->id . ' - ' . $employee->name }}
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                     <!-- Vertical Form -->
                     <form class="row g-3" action="{{ route("employee.update", ["employee" => $employee ]) }}" method="POST">
                      @csrf
                      @method("PATCH")
    
                      <h5 class="sub-title">Personnal Informations</h5>
    
                      <div class="col-12">
                        <label for="name" class="form-label">Names</label>
                        <input type="text" name="name" value="{{ old("name", $employee->name) }}" class="form-control" id="name">
                      </div>
                      <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old("email", $employee->email) }}" class="form-control" id="email">
                      </div>
                      <div class="col-12">
                        <label for="address" class="form-label">Current Address</label>
                        <input type="text" name="address" value="{{ old("address", $employee->address) }}" class="form-control" id="address">
                      </div>
                      <div class="col-12">
                        <label for="phone_number" class="form-label">Telephone</label>
                        <input type="tel" class="form-control" id="phone_number"name="phone_number" value="{{ old("phone_number", $employee->phone_number) }}" placeholder="+1 000 000 000">
                      </div>
                      <div class="col-12">
                        <label for="birth_date" class="form-label">Birth date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old("birth_date", $employee->birth_date) }}" placeholder="YYYY-MM-DD">
                      </div>
    
                      <br><br><br><br>
    
                      <h5 class="sub-title">Job Informations</h5>
                      <div class="col-12">
                        <label for="reg_number" class="form-label">Reg Number</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">#</span>
                          <input type="text" id="reg_number" class="form-control" name="reg_number" value="{{ old("reg_number", $employee->reg_number) }}" placeholder="2123" aria-label="Registration number" aria-describedby="basic-addon1">
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="job_title" class="form-label">Job title</label>
                        <input type="text" name="job_title" value="{{ old("job_title", $employee->job_title) }}" class="form-control" id="job_title" placeholder="texte">
                      </div>
                      <div class="col-12">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" name="department" value="{{ old("department", $employee->department) }}" class="form-control" id="department" placeholder="texte">
                      </div>
                      <div class="col-12">
                        <label for="base_location" class="form-label">Base location</label>
                        <input type="text" class="form-control" name="base_location" value="{{ old("base_location", $employee->base_location) }}" id="base_location" placeholder="texte">
                      </div>
                      <div class="col-12">
                        <label for="inputAddress" class="form-label">Contract type</label>
                        <select name="contract_type" id="contract_type" class="form-control">
                          <option value="Fixed-term contract" >Select a contract type</option>
                          <option value="Fixed-term contract" @selected(old("contract_type", $employee->contract_type) == "Fixed-term contract")>Fixed-term contract</option>
                          <option value="Permanent contract"  @selected(old("contract_type", $employee->contract_type) == "Permanent contract")>Permanent contract</option>
                        </select>
                      </div>
                      <br><br><br><br>
                      <h5 class="sub-title">Banking Informations</h5>
                      <div class="col-12">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name" value="{{ old("bank_name", $employee->bank_name) }}" id="bank_name" placeholder="texte">
                      </div>
                      <div class="col-12">
                        <label for="bank_account_number" class="form-label">Bank Account Number</label>
                        <input type="text" class="form-control" name="bank_account_number" value="{{ old("bank_account_number", $employee->bank_account_number) }}" id="bank_account_number" placeholder="texte">
                      </div>
                      <div class="col-12">
                        <label for="bank_account_name" class="form-label">Bank Account Name</label>
                        <input type="text" class="form-control" name="bank_account_name" value="{{ old("bank_account_name", $employee->bank_account_name) }}" id="bank_account_name" placeholder="texte">
                      </div>
    
                      <br><br><br><br>
    
                      {{-- <h5 class="sub-title">Authentifications</h5>
                      <div class="col-12">
                        <label for="inputAddress" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="inputAddress" value="oliver2" placeholder="texte">
                      </div>
                      <div class="col-12">
                        <label for="inputAddress" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputAddress" value="1203212324rfdf" placeholder="texte">
                      </div> --}}
                    </form><!-- Vertical Form -->
                    <div class="text-center d-flex">
                      <form action="{{ route("reject.account", $employee) }}" method="POST" style="margin-right:16px;">
                        @csrf
                        @method("PATCH")
                        <button type="submit" class="btn btn-danger">Reject</button>
                      </form>

                      <form action="{{ route("validate.account", $employee) }}" method="POST">
                        @csrf
                        @method("PATCH")
                        <button type="submit" class="btn btn-primary">Confirm</button>
                      </form>
                      
                    </div>
                  </div>
                  </div>
                </div>
                @endforeach

              </div><!-- End Default Accordion Example -->
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Internal Employee requests</h5>
              <!-- Accordion without outline borders -->
              <div class="accordion accordion-flush" id="accordionFlushExample">
                @session('success')
                  <small class="text-success">{{ $value }}</small>    
                @endsession
                @foreach($requests as $request)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed sub-title" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                      #{{ $request->employee->id }} | {{ $request->employee->name }}
                    </button>
                  </h2>
                  <small class="activite-label" style="color:gray;">{{ $request->created_at->diffForHumans() }}</small>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      {{ $request->content }}
                    </div>
                    
                    @if ($request->attachment)
                    <div>
                      <a href="{{ $request->attachment_url }}" target="blank">Download Attachment</a>
                    </div>
                    @endif

                    <div class="text-center">
                      <form action="{{ route("request.update", ["id" => $request->id]) }}" method="POST">
                        @csrf

                        @method("PATCH")
                        <input type="hidden" name="status" value="seen">
                        <input type="hidden" name="read_at" value={{ now() }} readonly aria-hidden="true">
                        <button type="submit" class="btn btn-primary btn-sm">Mark as read</button>
                      </form>
                    </div>

                    <div class="form-floating d-flex justify-content-between align-items-center">
                      <form action="{{ route("reply.store", ["id" => $request->id]) }}" method="POST">
                        @csrf
                        <textarea class="form-control flex-grow-1" name="content" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Reply</label>
                        <button type="submit" class="btn btn-success btn-sm">Reply</button>
                      </form>
                    </div>
                  </div>
                </div>
                @endforeach
      
              </div><!-- End Accordion without outline borders -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
</x-admin-layout>

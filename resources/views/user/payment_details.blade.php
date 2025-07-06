
  <x-employee-layout>

    <x-slot:title>{{$payment->created_at->format("M Y")}} Payment details</x-slot:title>

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>{{$payment->created_at->format("M Y")}} Payment details</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Home</a></li>
            <li class="breadcrumb-item">My Salary</li>
            <li class="breadcrumb-item active">{{$payment->created_at->format("M Y") }}</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">#{{ $employee->id . ' - ' . $employee->name }} 
                  <button 
                    type="button" 
                    @class([
                      "btn btn-sm",
                      "btn-success" => $employee->is_validated,
                      "btn-warning" => $employee->is_pending,
                      "btn-danger" => $employee->is_rejected,
                    ])
                    onclick="openModal()">{{ ucfirst($employee->status) }}
                  </button>
                </h5>
                @session("success")
                  <small class="text-success">{{ $value }}</small>
                @endsession
                <p>
                  <img src="{{ $employee->image_url }}" class="rounded" alt="Employee profile image">
                </p>
                <!-- Vertical Form -->
                <form class="row g-3">

                  <h5 class="sub-title">Personnal Informations</h5>

                  <div class="col-12">
                    <label for="name" class="form-label">Names</label>
                    <input type="text" name="name" value="{{ old("name", $employee->name) }}" class="form-control" id="name" readonly>
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old("email", $employee->email) }}" class="form-control" id="email" readonly>
                  </div>
                  <div class="col-12">
                    <label for="address" class="form-label">Current Address</label>
                    <input type="text" name="address" value="{{ old("address", $employee->address) }}" class="form-control" id="address" readonly>
                  </div>
                  <div class="col-12">
                    <label for="phone_number" class="form-label">Telephone</label>
                    <input type="tel" class="form-control" id="phone_number"name="phone_number" value="{{ old("phone_number", $employee->phone_number) }}" placeholder="+1 000 000 000" readonly>
                  </div>
                  <div class="col-12">
                    <label for="birth_date" class="form-label">Birth date</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old("birth_date", $employee->birth_date) }}" placeholder="YYYY-MM-DD" readonly>
                  </div>

                  <div class="col-12">
                    <label for="dependents" class="form-label">Dependents</label>
                    <input type="text" class="form-control" id="dependents" name="dependents" value="{{ old("dependents", $employee->dependents) }}" placeholder="Has no dependents" readonly>
                  </div>

                  <br><br><br><br>

                  <h5 class="sub-title">Job Informations</h5>
                  <div class="col-12">
                    <label for="reg_number" class="form-label">Reg Number</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">#</span>
                      <input type="text" id="reg_number" class="form-control" name="reg_number" value="{{ old("reg_number", $employee->reg_number) }}" placeholder="2123" aria-label="Registration number" aria-describedby="basic-addon1" readonly>
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="job_title" class="form-label">Job title</label>
                    <input type="text" name="job_title" value="{{ old("job_title", $employee->job_title) }}" class="form-control" id="job_title" placeholder="texte" readonly>
                  </div>
                  <div class="col-12">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" name="department" value="{{ old("department", $employee->department) }}" class="form-control" id="department" placeholder="texte" readonly>
                  </div>
                  <div class="col-12">
                    <label for="base_location" class="form-label">Base location</label>
                    <input type="text" class="form-control" name="base_location" value="{{ old("base_location", $employee->base_location) }}" id="base_location" placeholder="texte" readonly>
                  </div>
                  <div class="col-12">
                    <label for="inputAddress" class="form-label">Contract type</label>
                    <select name="contract_type" id="contract_type" class="form-control" readonly>
                      <option value="Fixed-term contract" >Select a contract type</option>
                      <option value="Fixed-term contract" @selected(old("contract_type", $employee->contract_type) == "Fixed-term contract")>Fixed-term contract</option>
                      <option value="Permanent contract"  @selected(old("contract_type", $employee->contract_type) == "Permanent contract")>Permanent contract</option>
                    </select>
                  </div>
                  
                  @if($employee->contract_type == "Fixed-term contract")
                  <div class="col-12">
                    <label for="contract_duration" class="form-label">Duration (in months)</label>
                    <input type="number" class="form-control" name="contract_duration" value="{{ old("contract_duration", $employee->contract_duration) }}" id="contract_duration" placeholder="texte" readonly>
                  </div>
                  @endif

                  <div class="col-12">
                    <label for="contract_start_date" class="form-label">Contract start date</label>
                    <input type="date" class="form-control" name="contract_start_date" value="{{ old("contract_start_date", $employee->contract_start_date) }}" id="contract_start_date" placeholder="texte" readonly>
                  </div>

                  <br><br><br><br>
                  <h5 class="sub-title">Banking Informations</h5>
                  <div class="col-12">
                    <label for="bank_name" class="form-label">Bank Name</label>
                    <input type="text" class="form-control" name="bank_name" value="{{ old("bank_name", $employee->bank_name) }}" id="bank_name" placeholder="texte" readonly>
                  </div>
                  <div class="col-12">
                    <label for="bank_account_number" class="form-label">Bank Account Number</label>
                    <input type="text" class="form-control" name="bank_account_number" value="{{ old("bank_account_number", $employee->bank_account_number) }}" id="bank_account_number" placeholder="texte" readonly>
                  </div>
                  <div class="col-12">
                    <label for="bank_account_name" class="form-label">Bank Account Name</label>
                    <input type="text" class="form-control" name="bank_account_name" value="{{ old("bank_account_name", $employee->bank_account_name) }}" id="bank_account_name" placeholder="texte" readonly>
                  </div>

                </form><!-- Vertical Form -->

                <!-- Vertical Form -->


                <!-- Modal -->
      
                {{-- <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="requestModalLabel">Request Infos Modification</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form id="modificationForm" action="{{ route("request.store") }}" method="POSt">
                            @csrf

                            <div class="mb-3">
                              <label for="requestType" class="form-label">Type of Modification</label>
                              <select class="form-select" id="requestType" name="subject" required>
                                <option value="">Select type</option>
                                <option value="Writing error" @selected(old("title") == "Writing error") >Writing error</option>
                                <option value="Wrong Informations" @selected(old("title") == "Wrong Informations")>Wrong Informations</option>
                                <option value="Position Change" @selected(old("title") == "Position Change")>Position Change</option>
                                <option value="Other" @selected(old("title") == "Other")>Other</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="description" class="form-label">Description</label>
                              <textarea class="form-control" id="description" rows="3" name="content" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                          </form>
                        </div>
                      </div>
                    </div>
                </div> --}}
    
                <script>
                  document.getElementById('request-modification-btn').addEventListener('click', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('requestModal'));
                    myModal.show();
                  });
                </script>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Salary Inputs | {{ $payment->created_at->format("M Y") }}</h5>
                <!-- Advanced Form Elements -->
                <form>
                  <div>
                    <h5 class="sub-title">Gross Salary</h5>
                    @foreach($payment->json_data->gross_salaries as $salary)
                      <p>
                        <label for="salaries[]">{{ $salary->name }}</label>
                        <input 
                          type="number" 
                          name="salaries[{{ $salary->id }}]"
                          value="{{ $salary->amount }}" 
                          placeholder="Enter amount for this employee..." 
                          class="rounded-end"
                          readonly>
                      </p>
                    @endforeach
                    <h6 class="sub-title underlined">Gross Salary : {{ $payment->gross_salary }} SSP</h6> <br>
                  </div>

                  
                  <div>
                    <h5 class="sub-title">Deductions</h5>
                    @foreach($payment->json_data->deductions as $salary)
                    <p>
                        <label for="salaries[]">{{ $salary->name }} {{  $salary->extra ?? "" }}</label>
                        <input 
                          type="number" 
                          name="salaries[{{ $salary->id }}]"
                          value="{{ $salary->amount }}" 
                          class="rounded-end"
                          readonly>
                      </p>
                    @endforeach

                    <h6 class="sub-title underlined">Deductions : {{ $payment->deductions }} SSP</h6>
                    <h6 class="sub-title underline-total">NET SALARY : {{ $payment->net_salary }} SSP</h6> <br>
                  </div>
                  <button type="button" class="btn btn-secondary btn-sm" id="request-salary-btn">Send a request</button> 
                </form><!-- End General Form Elements -->
                <br>
                <div>
                  <a href="{{ route("payment_sheet", $employee) }}" class="btn btn-success btn-sm">Show Pay Sheet</a>
                </div>

                
                 <!-- Modal -->
                <div class="modal fade" id="requestModalSalary" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true" style="z-index: 1090;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="requestModalLabel">Request Salary Modification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="modificationForm" action="{{ route("request.store") }}" method="POST">
                          @csrf

                          <div class="mb-3">
                            <label for="requestType" class="form-label">Type of Modification</label>
                            <select class="form-select" id="requestType" name="object" required>
                              <option value="">Select type</option>
                              <option value="Writing error" @selected(old("object") == "Writing error") >Writing error</option>
                              <option value="Wrong Informations" @selected(old("object") == "Wrong Informations")>Wrong Informations</option>
                              <option value="Position Change" @selected(old("object") == "Position Change")>Position Change</option>
                              <option value="Other" @selected(old("object") == "Other")>Other</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="content" required></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit Request</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  document.getElementById('request-salary-btn').addEventListener('click', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('requestModalSalary'));
                    myModal.show();
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main><!-- End #main -->
  </x-employee-layout>

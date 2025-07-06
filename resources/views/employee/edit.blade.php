
  <x-admin-layout>

    <x-slot:title>Employee data</x-slot:title>

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Employee data</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard")}}">Home</a></li>
            <li class="breadcrumb-item">Employees</li>
            <li class="breadcrumb-item active">{{ $employee->name }}</li>
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
                  <div class="col-12">
                    <label for="dependents" class="form-label">Dependents</label>
                    <input type="text" class="form-control" id="dependents" name="dependents" value="{{ old("dependents", $employee->dependents) }}" placeholder="Has no dependents">
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

                  @if($employee->contract_type == "Fixed-term contract")
                  <div class="col-12">
                    <label for="contract_duration" class="form-label">Duration (in months)</label>
                    <input type="number" class="form-control" name="contract_duration" value="{{ old("contract_duration", $employee->contract_duration) }}" id="contract_duration" placeholder="texte">
                  </div>
                  @endif

                  <div class="col-12">
                    <label for="contract_start_date" class="form-label">Contract start date</label>
                    <input type="date" class="form-control" name="contract_start_date" value="{{ old("contract_start_date", $employee->contract_start_date) }}" id="contract_start_date" placeholder="texte">
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
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Modification</button>
                  </div>
                </form><!-- Vertical Form -->
                <form action="{{ route("employee.delete", ["employee" => $employee]) }}" method="POST">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="btn btn-danger">Delete Employee</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Salary Inputs</h5>
                <!-- Advanced Form Elements -->
                <form action="{{ route("employee.update.salary", ["employee" => $employee]) }}" method="POST">
                  @csrf

                  <div>
                    <h5 class="sub-title">Gross Salary</h5>
                    @foreach($employee->getGrossSalaries() as $salary)
                      <p>
                        <label for="salaries[]">{{ $salary["name"] }}</label>
                        <input 
                          type="number" 
                          name="salaries[{{ $salary["id"] }}]"
                          value="{{ $salary["amount"] }}" 
                          placeholder="Enter amount for this employee..." 
                          class="rounded-end">
                      </p>
                    @endforeach
                    <h6 class="sub-title underlined">Gross Salary : {{ $employee->gross_salary }} SSP</h6> <br>
                  </div>

                  
                  <div>
                    <h5 class="sub-title">Deductions</h5>
                    @foreach($employee->getDeductionSalaries() as $salary)
                      <p>
                        <label for="salaries[]">{{ $salary["name"] . $salary["extra"] }} </label>
                        <input 
                          type="number" 
                          name="salaries[{{ $salary["id"] }}]"
                          value="{{ $salary["amount"] }}" 
                          placeholder="Enter amount for this employee..." 
                          class="rounded-end">
                      </p>
                    @endforeach
                    <h6 class="sub-title underlined">Deductions : {{ $employee->deduction_salary }} SSP</h6>
                    <h6 class="sub-title underline-total">NET SALARY : {{ $employee->net_salary }} SSP</h6> <br>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Save input</button>
                  @session("success_salaries")
                    <small class="text-success">{{ $value }}</small>
                  @endsession
                </form><!-- End General Form Elements -->

                {{-- Use link instead of button to view employee pay sheet --}}
                <br>
                <div>
                  <a href="{{ route("payment_sheet", $employee) }}" class="btn btn-success btn-sm">Generate Pay Sheet</a>
                </div>
                {{-- ----- --}}
                
                
                <form action="{{ route("payment.store", $employee ) }}" method="POST" class="mt-4">
                  @csrf
                  {{-- <button type="button" class="btn btn-success btn-sm" onclick="openModal()">Send Pay Sheet to the Employee</button> --}}
                  <button type="submit" class="btn btn-success btn-sm">Send Pay Sheet to the Employee</button>
                  
                  
                  @session("success_payment_sheet")
                    <small class="text-success">{{ $value }}</small>
                  @endsession

                  @session("error")
                    <small class="text-danger">{{ $value }}</small>
                  @endsession
                </form>
    
              </div>
            </div>
          </div>
        </div>
      </section>

      <aside style="display: none;">
        <div class="card-body">
          <div id="printAreaa">
              <div id="printHeader" class="header">
                  <img src="{{ asset("img/logo.jpg") }}" style="height:60px" alt="Logo Dream Bridge">
                  <div>
                      <h4>DREAM BRIDGE Ltd.</h4>
                      <p>Dream Bridge Consultants Ltd offers a wide range of consulting services to help you take your business to the next level. Get in touch with us today to book in a consultation. With us on our side, your business will rise in no time.</p>
                      <p>Adresse: Juba – South Sudan<br>Email: info@dreambridgeconsultants.com<br>Site web : <a href="https://www.dreambridgeconsultants.com">www.dreambridgeconsultants.com</a></p>
                  </div>
              </div>
              <h2>PAYMENT SHEET - {{ strtoupper($employee->name) }}</h2>
              <hr>
              <div class="employee-info">
                  <p>Employee Names : {{ $employee->name }}</p>
                  <p>Position : {{ $employee->job_title }}</p>
                  <p>Contract type : {{ $employee->contract_type }}</p>
                  <p>Salary Date : {{ today()->format("j M Y") }}</p>
              </div>
              <div class="table-responsive" style="margin-top:100px">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th class="number-col">#</th>
                              <th colspan="2" class="description-col">Gross Salary</th>
                              <th colspan="2" class="description-col">Deductions</th>
                          </tr>
                          <tr>
                              <th></th>
                              <th class="description-col">Description</th>
                              <th class="amount-col">Amount</th>
                              <th class="description-col">Description</th>
                              <th class="amount-col">Amount</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $iteration = 1;
                          @endphp
                          @foreach($employee->getGrossSalaries() as $salary)
                          <tr class="gross-salary">
                              <td>{{ $iteration }}</td>
                              <td>{{ $salary["name"] }}</td>
                              <td>$ {{ $salary["amount"] }}</td>
                              <td></td>
                              <td></td>
                          </tr>
                          @php
                              $iteration += 1
                          @endphp
                          @endforeach
                          
                          @foreach ($employee->getDeductionSalaries() as $salary)
                          <tr class="deductions">
                              <td>{{ $loop->index + $iteration }}</td>
                              <td></td>
                              <td></td>
                              <td>{{ $salary["name"] }}</td>
                              <td>$ -{{ $salary["amount"] }}</td>
                          </tr>
                          @endforeach

                          <tr class="table-footer">
                              <td></td>
                              <td colspan="2">Net Salary</td>
                              <td colspan="2">$ {{ $employee->net_salary }}</td>
                          </tr>
                      </tbody>
                  </table>
                  <br><br><br><br>
                  <p>
                    Signature <br><br>
                    HR
                  </p>
              </div>
          </div>
        </div>
      </aside>

      <script>
          function printAside() {
              // console.log("printAside function called"); // Debug log
              var divToPrint = document.getElementById("printAreaa").innerHTML;
              // console.log("divToPrint content:", divToPrint); // Debug log
              var newWin = window.open("", "Print-Window");
              newWin.document.open();
              newWin.document.write('<html><head><title>Print</title><style>.header{display:flex;justify-content:space-between;align-items:center;}.header img{width:150px;}.header div{text-align:right;}h2{text-align:center;}hr{border:1px solid black;}.employee-info{margin-bottom:20px;}.table-responsive{margin-top:20px;}table{width:100%;border-collapse:collapse;}table, th, td{border:1px solid black;}th, td{padding:8px;text-align:left;}.table-footer{font-weight:bold;}.gross-salary{background-color:#e0f7fa;}.deductions{background-color:#ffebee;}.number-col{width:5%;}.description-col{width:30%;}.amount-col{width:15%;}</style></head><body onload="window.print()">' + divToPrint + '</body></html>');
              newWin.document.close();
              // setTimeout(function() { newWin.close(); }, 10);
          }
      </script>
      
    </main><!-- End #main -->
  </x-admin-layout>

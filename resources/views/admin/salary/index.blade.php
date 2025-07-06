<x-admin-layout>
    <x-slot:title>Salary inputs</x-slot:title>
  
    <main id="main" class="main">
  
      <div class="pagetitle">
        <h1>Salary Inputs</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">Salary Inputs</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-6">
            @session("error")
                <small class="text-danger">{{ $value }}</small>
            @endsession
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Gross Salary</h5>

                @session("gross-success")
                  <small class="text-success">{{ $value }}</small>
                @endsession
  
                <!-- Default Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
             
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Note</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add Input</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Inputs list</button>
                  </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                  
                  

                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    Gross salary is the total salary before deductions. It typically includes: <br> <br>
                    <ul>
                      <li><mark>Base Pay:</mark> The fixed amount agreed upon, either hourly or as a salary.</li>
                      <li><mark>Overtime Pay:</mark> Additional pay for hours worked beyond the standard workweek. </li>
                      <li><mark>Bonuses and Commissions: </mark>Performance-related pay, which can be periodic</li>
                      <li><mark>Allowances:</mark> Extra payments such as travel, housing, or food allowances.</li>
                    </ul>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="{{ route("salary.store") }}" method="POST">
                      @csrf
                      <p>Input name : <input type="text"  name="name" placeholder="Enter the gross input name"></p>
                      <p>Price ($): <input type="number" name="price" placeholder="Eg. 12"></p>
                      <input type="hidden" name="category" value="gross">
                      {{-- <p>Frequency : 
                        <select name="pay_period">
                          <option value="">Select a pay period</option>
                          <option value="hourly">Hourly</option>
                          <option value="daily">Dayly</option>
                          <option value="weekly">Weekly</option>
                          <option value="monthly">Monthly</option>
                        </select></p> --}}
                      <p><input class="submit" type="submit" value="Save"></p>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @foreach($gross_salaries as $salary)
                        <p class="list-inputs">
                            <span>{{ $salary->name }} | {{ $salary->price }} $</span>
                            <button type="button" class="btn btn-success btn-sm" onclick="openModal('{{ route('salary.update', $salary->id) }}', '{{ $salary->name }}', '{{ $salary->price }}')">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteModal('{{ route('salary.delete', $salary) }}')">Delete</button>
                        </p>
                    @endforeach

                  </div>
  
                  
                </div><!-- End Default Tabs -->
  
              </div>
            </div>
  
          </div>
  
          <div class="col-lg-6">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Deductions</h5>

                @session("deduction-success")
                  <small class="text-success">{{ $value }}</small>
                @endsession
  
                <!-- Default Tabs -->
                <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                  <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Note</button>
                  </li>
                  <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Add input</button>
                  </li>
                  <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">Inputs list</button>
                  </li>
                </ul>
                <div class="tab-content pt-2" id="myTabjustifiedContent">
                  <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                    Deductions from the gross salary include: <br> <br>
                    <ul>
                      <li><mark>Taxes:</mark> Federal, state, and local taxes.</li>
                      <li><mark>Social Security and Medicare:</mark>  Insurance Contributions </li>
                      <li><mark>Retirement Contributions: </mark>Employee contributions to retirement plans </li>
                      <li><mark>Insurance Premiums: </mark>Health, dental, vision, or life insurance premiums</li>
                      <li><mark>Other Deductions: </mark>Union dues, garnishments, etc.</li>
                    </ul>
                  </div>
                  <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="{{ route("salary.store") }}" method="POST">
                      @csrf
                      <p>Input name : <input type="text"  name="name" placeholder="Enter the gross input name"></p>
                      <p>Price ($): <input type="number" name="price" placeholder="Eg. 12"></p>
                      <input type="hidden" name="category" value="deduction">
                      <p><input class="submit" type="submit" value="Save"></p>
                    </form>
                  </div>

                  <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab">
                    @foreach($deduction_salaries as $salary)
                        <p class="list-inputs">
                            <span>{{ $salary->name }} | {{ $salary->price }} {{ $salary->id == 4 ? "%" : "$"}}</span>
                            <button type="button" class="btn btn-success btn-sm" onclick="openModal('{{ route('salary.update', $salary->id) }}', '{{ $salary->name }}', '{{ $salary->price }}')">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteModal('{{ route('salary.delete', $salary) }}')">Delete</button>
                        </p>
                    @endforeach


                  </div>
                </div><!-- End Default Tabs -->
  
              </div>
            </div>

            {{-- <!-- Modal Structure --> --}}
            <div id="editModal" class="modal">
              <div class="modal-content">
                  <span class="close" onclick="closeModal()">&times;</span>
                  <form action="" method="POST" id="editForm">
                      @csrf
                      @method('PATCH')

                      <p>Input name: <input type="text" placeholder="Enter the gross input name" name="name" id="input_name"></p>
                      <p>Price ($): <input type="number" placeholder="Eg. 12" name="price" id="input_price"></p>
                      <p><input class="submit" type="submit" value="Save Modification"></p>
                  </form>
              </div>
            </div>
            
            {{-- Delete modal --}}
            <div id="deleteModal" class="modal">
              <div class="modal-content" style="max-width:500px">
                  <span class="close bg-danger" style="color:white;border-radius:4px;width:30px;height:30px;display:flex;justify-content:center;align-items:center;" onclick="closeModal()">&times;</span>
                  <p id="deleteMessage"> Message goes here </p>
                  <div style="display:flex;gap:16px;align-self:end">
                    <button class="btn btn-primary btn-sm" onclick="closeModal()">Cancel</button>
                    <form action="" method="POST" id="deleteForm">
                      @csrf
                      @method("DELETE")
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generator of all salaries</h5>
                    
                    <a class="btn btn-success btn-sm" href="{{ route("payment_sheet.all") }}">Generate all Pay Sheets</a>
                    {{-- <button class="btn btn-success btn-sm" 
                  onclick="printAside()">Print All Pay Sheets</button> --}}
                </div>
            </div>
          </div>
  
        </div>
      </section>
    </main><!-- End #main -->

    <script>
      function openModal(link, name, price) {
          document.getElementById('editModal').style.display = "block";
          document.getElementById('input_name').value = name;
          document.getElementById('input_price').value = price;
          document.getElementById("editForm").action = link;
      }
  
      function confirmDeleteModal(link, message="Are you sure you want to delete this record ?") {
          document.getElementById('deleteModal').style.display = "block";
          document.getElementById("deleteForm").action = link;
          document.getElementById("deleteMessage").innerText = message;
      }
  
      function closeModal() {
          document.getElementById('editModal').style.display = "none";
          document.getElementById("deleteModal").style.display= "none";
      }
  
      window.onclick = function(event) {
          if (event.target == document.getElementById('editModal')) {
              document.getElementById('editModal').style.display = "none";
          }
          else if (event.target == document.getElementById('deleteModal')) {
              document.getElementById('deleteModal').style.display = "none";
          }
      }
  
      function printAside() {
      console.log("printAside function called"); // Debug log
      var divToPrint = document.getElementById("allPayslips").innerHTML;
      console.log("divToPrint content:", divToPrint); // Debug log
      var newWin = window.open("", "Print-Window");
      newWin.document.open();
      newWin.document.write('<html><head><title>Payment Sheet - Payroll System - DBC Ltd.</title><style>' +
          '.header{display:flex;justify-content:space-between;align-items:center;}' +
          '.header img{width:150px;}' +
          '.header div{text-align:right;}' +
          'h2{text-align:center;}' +
          'hr{border:1px solid black;}' +
          '.employee-info{margin-bottom:20px;}' +
          '.table-responsive{margin-top:20px;}' +
          'table{width:100%;border-collapse:collapse;}' +
          'table, th, td{border:1px solid black;}' +
          'th, td{padding:8px;text-align:left;}' +
          '.table-footer{font-weight:bold;background-color:#f2f2f2;}' +
          '.gross-salary{background-color:#e0f7fa !important;}' +
          '.deductions{background-color:#ffebee !important;}' +
          '.number-col{width:5%;}' +
          '.description-col{width:30%;}' +
          '.amount-col{width:15%;}' +
          '.page-break{page-break-before:always;}' +  // Add this line for page break
          '</style></head><body onload="window.print()">' + divToPrint + '</body></html>');
      newWin.document.close();
      // setTimeout(function() { newWin.close(); }, 10);
    }
  
  </script>
</x-admin-layout>

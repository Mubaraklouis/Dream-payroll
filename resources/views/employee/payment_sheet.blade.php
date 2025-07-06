<x-employee-layout>
    <main class="main" id="main">
        
        <x-slot:title>Employee Payment sheet</x-slot:title>

        <div class="pagetitle">
            <h1>Payment sheet</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Home</a></li>
                <li class="breadcrumb-item">Employees</li>
                <li class="breadcrumb-item">{{ $employee->name }}</li>
                <li class="breadcrumb-item active">Payment sheet</li>
              </ol>
            </nav>
            
          </div><!-- End Page Title -->

          <div class="card-body">
            <div id="printAreaa">
                <div id="printHeader" class="d-flex align-items-start" style="display:flex;">
                    <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" style="height: 60px; margin-right:50px" alt="Logo Dream Bridge">
                    <div class="ml-3">
                        <h4>DREAM BRIDGE Ltd.</h4>
                        <p>Adresse: Juba – South Sudan<br>Email: info@dreambridgeconsultants.com<br>Site web : <a href="https://www.dreambridgeconsultants.com">www.dreambridgeconsultants.com</a></p>
                    </div>
                </div>
                <h2>PAYMENT SHEET - {{ strtoupper($employee->name) }}</h2>
                <hr>
                <div class="employee-info">
                    <p>Employee Names : {{ $employee->name }}</p>
                    <p>Position : {{ $employee->job_title }}</p>
                    <p>Contract type : {{ $employee->contract_type }}</p>
                    <p>Bank name : {{ $employee->bank_name }}</p>
                    <p>Bank account name : {{ $employee->bank_account_name }}</p>
                    <p>Bank account # : {{ $employee->bank_account_number }}</p>
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
                                <td>{{ $salary["name"] . $salary["extra"] }}</td>
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
                    <div class="stamp-container" style="position: relative; height: 2px;">
                        <img src="{{ asset('img/stamp.png') }}" alt="stamp Dream Bridge" class="stamp" style="position: absolute; bottom: 0; left: 10%; transform: translateX(-50%); height: 150px; opacity: 0.3; z-index: -1;">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button class="btn btn-success btn-sm" onclick="printAside()">Print pay sheet</button> 

            
        </div>

        <script>
            function printAside() {
                var printContent = document.getElementById("printAreaa").innerHTML;
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = `
                    <html>
                    <head>
                        <title>Print</title>
                        <style>
                            .header{display:flex;justify-content:space-between;align-items:center;}
                            .header img{width:150px;}
                            .header div{text-align:right;}
                            h2{text-align:center;}
                            hr{border:1px solid black;}
                            .employee-info{margin-bottom:20px;}
                            .table-responsive{margin-top:20px;}
                            table{width:100%;border-collapse:collapse;}
                            table, th, td{border:1px solid black;}
                            th, td{padding:8px;text-align:left;}
                            .table-footer{font-weight:bold;}
                            .gross-salary{background-color:#e0f7fa;}
                            .deductions{background-color:#ffebee;}
                            .number-col{width:5%;}
                            .description-col{width:30%;}
                            .amount-col{width:15%;}
                            .payslip-container { page-break-after: always; }
                            .stamp-container {position: relative; height: 2px;}
                            .stamp {position: absolute; bottom: 0; left: 10%; transform: translateX(-50%); height: 150px; opacity: 0.3; z-index: -1;}
                        </style>
                    </head>
                    <body>
                        ${printContent}
                    </body>
                    </html>
                `;
                window.print();
                document.body.innerHTML = originalContent;
                location.reload();
            }
        </script>
    </main>
</x-employee-layout>

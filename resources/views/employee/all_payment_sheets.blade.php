<x-admin-layout>
    <main class="main" id="main">
        
        <x-slot:title>All Payment sheets</x-slot:title>

        <div class="card-body" id="allPayslips">
            @foreach($validated_employees as $employee)
            <div class="payslip-container" style="page-break-after: always;"> <!-- Apply page-break-after here -->
                <div class="d-flex align-items-start" style="display:flex;">
                    <img src="{{ asset("img/logo.jpg") }}" class="img-fluid" style="height: 60px; margin-right:50px" alt="Logo Dream Bridge">
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
                <div class="table-responsive">
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
            @endforeach
        </div>

        <div>
            <button class="btn btn-success btn-sm" onclick="printAside()">Print All Pay Sheets</button>

            <form action="{{ route("payment.store_many") }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-sm mt-4 mb-4">Send pay sheets to all employees</button> 
            </form>
            @session("success_payment_sheet")
                {{ $value }}
            @endsession
        </div>

        <script>
            function printAside() {
                var originalContent = document.body.innerHTML;
                var printArea = document.createElement("div");
                printArea.innerHTML = `
                    <html>
                    <head>
                        <title>Payment Sheet - Payroll System - DBC Ltd.</title>
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
                            .table-footer{font-weight:bold;background-color:#f2f2f2;}
                            .gross-salary{background-color:#e0f7fa !important;}
                            .deductions{background-color:#ffebee !important;}
                            .number-col{width:5%;}
                            .description-col{width:30%;}
                            .amount-col{width:15%;}
                            .payslip-container { page-break-after: always; }
                            .stamp-container {position: relative; height: 2px;}
                            .stamp {position: absolute; bottom: 0; left: 10%; transform: translateX(-50%); height: 150px; opacity: 0.3; z-index: -1;}
                        </style>
                    </head>
                    <body>` + document.getElementById("allPayslips").innerHTML + `</body></html>`;
                document.body.innerHTML = printArea.innerHTML;
                window.print();
                document.body.innerHTML = originalContent;
                location.reload(); 
            }
        </script>
    </main>
</x-admin-layout>

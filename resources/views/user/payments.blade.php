  <x-employee-layout>
    <x-slot:title>Payment history</x-slot:title>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>New Employee</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Home</a></li>
            <li class="breadcrumb-item">{{ "Auth username"}}</li>
            <li class="breadcrumb-item active">Payment History</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">
    
              <div class="card-body">
                <h5 class="card-title">Payment record <span>| Years</span></h5>
                <table class="table table-borderless datatable">
    
                  <thead>
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">Gross Salary</th>
                      <th scope="col">Deductions</tr>
                      <th scope="col">Net Salary</th>
                      <th scope="col">Observation</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(auth()->user()->employee->payments as $payment)
                        <tr>
                          <th scope="row"><a href="{{ route("salary-details", $payment)}}" class="text-primary">{{ $payment->created_at }}</a></th>
                          <td>{{ $payment->gross_salary }} SSP</td>
                          <td>{{ $payment->deductions }} SSP</td>
                          <td>{{ $payment->net_salary }} SSP</td>
                          <td>{{ $payment->comment }}</td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- End Recent Sales -->
      </section>
    </main><!-- End #main -->
  </x-employee-layout>

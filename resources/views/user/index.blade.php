
  <x-employee-layout>

    <x-slot:title>My Dashboard</x-slot:title>

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>My Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section dashboard">
        <div class="row">
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Net Salary <span>| Monthly</span></h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cash-coin"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $employee->net_salary }} SSP</h6>
    
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Sales Card -->
    
              <!-- Revenue Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                  <div class="card-body">
                    <h5 class="card-title">Gross salary <span>| Monthly</span></h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $employee->gross_salary }} SSP</h6>
    
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Revenue Card -->
              <!-- Customers Card -->
              <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">
                  <div class="card-body">
                    <h5 class="card-title">Deductions <span>| Monthly</span></h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $employee->deduction_salary }} SSP</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Customers Card -->
    
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
                        @foreach($employee->payments()->orderBy("created_at", "desc")->get() as $payment)
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
            </div>
          </div><!-- End Left side columns -->
          <!-- Right side columns -->
          <div class="col-lg-4">
            <!-- Recent Activity -->
            <div class="card">
    
              <div class="card-body">
                <h5 class="card-title">Payment Notifications <span>| Salary</span></h5>
                <div class="activity">


                  @foreach ($employee->unreadPaymentNotifications as $notification)
                  <div class="activity-item d-flex">
                    <div class="activite-label">{{ $notification->created_at->diffForHumans() }}</div>
                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                    <div class="activity-content">
                      {{ $notification->data["message"] }}
                    </div>
                    
                    {{-- Create a button in a form to mark a notification as read,
                    On click the nofitication div must be removed (JS) --}}
                    
                  </div><!-- End activity item-->
                  @endforeach

                </div>
              </div>
            </div><!-- End Recent Activity -->
    
            <!-- News & Updates Traffic -->
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Latest news <span>| 3 lasts</span></h5>

              <div class="news">
                @foreach($employee->unreadNewsNotifications as $notification)
                  
                  <div class="post-item clearfix" onclick="showNews('{{ $notification->data['title'] }}', '{{ $notification->data['content'] }}', '{{ $notification->created_at->format('j M Y') }}')">
                    <img src="{{ asset("img/megaphone.jpeg") }}" alt="{{ $notification->data['title'] }}">
                    <h4><a href="#">{{ $notification->data['title'] }}</a></h4>
                    <p>{{ $notification->data['content'] }}</p>

                    @if ($notification->data['attachment'])
                    <a href="{{ Storage::url($notification->data['attachment']) }}">Download attachment</a>
                    @endif
                  </div>

                  @if($loop->iteration == 3)
                    @break
                  @endif

                @endforeach

              </div><!-- End sidebar recent posts-->
              <div class="text-right mt-3">
                <a href="{{ route("message.index") }}" class="btn btn-sm btn-primary">Go to news portal</a>
              </div>
              <br>
            </div>
          </div><!-- End News & Updates -->
        </div><!-- End Right side columns -->
      </div>
    </section>

    <!-- News Modal -->
    <div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newsModalLabel">News Title</h5>
            
              
          </div>
          <div class="modal-body">
            <p id="newsContent">News content goes here...</p>
          </div>
          <div class="modal-footer">
            <p>Posted on : <span id="newsDate">14/11/2023</span></p>
          </div>
        </div>
      </div>
    </div>

    <script>
      function showNews(title, content, date) {
        document.getElementById('newsModalLabel').innerText = title;
        document.getElementById('newsContent').innerText = content;
        document.getElementById('newsDate').innerText = date;
        $('#newsModal').modal('show');
      }
    </script>

  </main><!-- End #main -->

  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</x-employee-layout>

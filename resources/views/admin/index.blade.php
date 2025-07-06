<x-admin-layout>

    <x-slot:title>Dashboard </x-slot:title>

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                    <h5 class="card-title">Employees <span>| Validated</span></h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-check"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $validated_employees->count() }}</h6>
    
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Sales Card -->
    
              <!-- Revenue Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                  <div class="card-body">
                    <h5 class="card-title">Employees <span>| Pending</span></h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-dash"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $pending_employees->count() }}</h6>
    
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Revenue Card -->
              <!-- Customers Card -->
              <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">
                  <div class="card-body">
                    <h5 class="card-title">Employees <span>| Rejected</span></h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-x"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $rejected_employees->count() }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Customers Card -->
    
              <!-- Recent Sales -->
              <div class="col-12">
                <div class="card recent-sales overflow-auto">
    
                  <div class="card-body">
                    <h5 class="card-title">Employees list <span>| All</span></h5>
                    <table class="table table-borderless datatable">
    
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Post</tr>
                          <th scope="col">Base</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- approved employees -->
                        @foreach($employees as $employee)
                        <tr>
                          <th scope="row"><a href="{{ route("employee.edit", ["employee" => $employee]) }}">#{{$employee->id}}</a></th>
                          <td>{{ $employee->name }}</td>
                          <td><a href="{{ route("employee.edit", ["employee" => $employee]) }}" class="text-primary">{{ $employee->job_title ?? "Undefined" }}</a></td>
                          <td>{{ $employee->base_location ?? "Unknown"}}</td>
                          <td>
                            <span @class([
                              "badge bg-success" => $employee->is_validated,
                              "badge bg-warning" => $employee->is_pending,
                              "badge bg-danger" => $employee->is_rejected,
                              ])>{{ ucfirst($employee->status) }}
                            </span>
                          </td>
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
                <h5 class="card-title">Recent Request <span>| Employees</span></h5>
                <div class="activity">
                  
                  @foreach($requests as $request)
                  <div class="activity-item d-flex">
                      <div class="activite-label">{{ $request->created_at->diffForHumans() }}</div>
                      <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                      <div class="activity-content">
                        {{ $request->employee->name }} <a href="#" class="fw-bold text-dark">{{ $request->object }}</a>
                      </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div><!-- End Recent Activity -->
    
            <!-- News & Updates Traffic -->
            {{-- <div class="card"> --}}
    
              {{-- <div class="card-body pb-0">
                <h5 class="card-title">Recents news <span>| 5 lasts</span></h5>
                <div class="news">
                  <div class="post-item clearfix">
                    <img src="{{ asset('img/messages-1.jpg') }}" alt="">
                    <h4><a href="#">Quidem autem et impedit</a></h4>
                    <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                  </div>
                  <div class="post-item clearfix">
                    <img src="{{ asset('img/news-2.jpg') }}" alt="">
                    <h4><a href="#">Quidem autem et impedit</a></h4>
                    <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                  </div>
                  <div class="post-item clearfix">
                    <img src="{{ asset('img/news-3.jpg') }}" alt="">
                    <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                    <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                  </div>
                  <div class="post-item clearfix">
                    <img src="{{ asset('img/news-4.jpg') }}" alt="">
                    <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                    <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                  </div>
                  <div class="post-item clearfix">
                    <img src="{{ asset('img/news-5.jpg') }}" alt="">
                    <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                    <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                  </div>
                </div><!-- End sidebar recent posts-->
              </div> --}}
            {{-- </div><!-- End News & Updates --> --}}
          </div><!-- End Right side columns -->
        </div>
      </section>
    </main><!-- End #main -->
  </x-admin-layout>

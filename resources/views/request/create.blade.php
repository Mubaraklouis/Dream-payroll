  <x-employee-layout>
    <x-slot:title>Send requests</x-slot:title>

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Send request</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Request</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section contact">
        <div class="row gy-4">
    
          <div class="col-xl-6">
            <div class="card p-4">

              <form action="{{ route("request.store") }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row gy-4">
                  <div>
                    <input type="text" name="object" value="{{ old("content") }}" placeholder="Object of the request" required>
                    @error("object")
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="col-md-12">
                    <textarea class="form-control" name="content" rows="6" placeholder="Message" required>{{ old("content") }}</textarea>
                    @error("content")
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="col-md-12">
                    <label for="attachment">Attach a file (optional)</label>
                    <input type="file" class="form-control" name="attachment" accept=".pdf">
                    @error('attachment')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                  <div class="col-md-12 text-center">
                    @session("success")
                      <small class="text-success">{{ $value }}</small >
                    @endsession
                    <button type="submit" style="background: #4154f1;border: 0;
                    padding: 10px 30px;
                    color: #fff;
                    transition: 0.4s;
                    border-radius: 4px;">Send Request</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Requests</h5>
                 <!-- Accordion without outline borders -->
              <div class="accordion accordion-flush" id="accordionFlushExample">
              
                @foreach ($employee->requests as $request)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed sub-title d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                      <span>#{{ $request->created_at->format("d/m/Y")}} | {{ $request->object }}</span>
                      <a href="##" class="btn btn-primary btn-sm ml-auto" style="margin-left:10px">{{ ucfirst($request->status) }}</a>
                    </button>                    
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      {{ $request->content }}
                    </div>


                    @if($request->hasReplies())
                      <div class="text-left" style="color: #4154f1">
                        Answer from Admin
                      </div>
                      
                      @foreach($request->replies as $reply)
                      <div class="form-floating d-flex justify-content-between align-items-center">
                        <p class="form-control flex-grow-1">{{ $reply->content }}</p> 
                      </div>
                      @endforeach
                    @endif                  
                  </div>
                </div>
                @endforeach


              </div><!-- End Accordion without outline borders -->

              </div>
            </div>
          </div>
          
          {{-- <div class="col-xl-6">
            <div class="card p-4">

                <form action="##" method="POST" enctype="multipart/form-data">
                    

                    <div class="row gy-4">
                        <div>
                            <input type="text" name="object" placeholder="Object of the request from file" required>
                            @error('object')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 text-center">
                            
                            <button type="submit" style="background: #4154f1;border: 0;
                            padding: 10px 30px;
                            color: #fff;
                            transition: 0.4s;
                            border-radius: 4px;">Send File</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>

      </section>
    </main><!-- End #main -->
  </x-employee-layout>

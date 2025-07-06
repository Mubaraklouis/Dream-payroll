
  <x-admin-layout>

    <x-slot:title>Contact                                                                     </x-slot:title>

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Contact</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Contact</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section contact">
        <div class="row gy-4">
    
          <div class="col-xl-6">
            <div class="card p-4">
              <form action="{{ route("broadcast_message.send") }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row gy-4">
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="title" placeholder="Subject" required/>
                    @error("title")
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <textarea class="form-control" name="content" rows="6" placeholder="Message" required></textarea>
                    @error("content")
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  
                  <div class="col-md-12">
                    <label for="attachment">Attach a file (optional) </label>
                    <input type="file" name="attachment" accept=".pdf">
                    @error("attachment")
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Send Message to all Employees</button>
                    @session("success")
                      <small class="text-success">{{ $value }}</small>
                    @endsession
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main><!-- End #main -->
  </x-admin-layout>

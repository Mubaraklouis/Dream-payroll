
  <x-guest-layout>

    <x-slot:title>Sign in</x-slot:title>

    <main>
      <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4">
                  <a href="#" class="logo d-flex align-items-center w-auto">
                    {{-- <img src="{{ asset('img/logo.jpg') }}" alt="" > --}}
                    {{-- <span class="d-none d-lg-block">Pyroll System</span> --}}
                  </a>
                </div><!-- End Logo -->
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                      <p class="text-center small">Enter your Email & password to login</p>
                    </div>
                    <form method="post" action="{{ route('admin.login') }} "class="row g-3 needs-validation" novalidate>
                       @csrf

                      <div class="col-12 mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="email" id="email" name="email" value="{{old("email")}}" class="form-control" id="email" placeholder="youremail@dream.com" required>
                          <div class="invalid-feedback">Please enter your email.</div>
                        </div>
                        @error('email')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror

                      </div>
                      <div class="col-12  mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required autocomplete="current-password">
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                      @error('password')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
    
                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit" style="background-color: #122840; border: none;">Login</button>
                      </div>
    
                    </form>
                  </div>
                </div>
                <div class="credits" style="font-size: x-small;">
                  Developed with ❤️ and ☕ by <a href="https://nguvutech.com/" target="_blank">NGUVU TECH</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main><!-- End #main -->
  </x-guest-layout>


<x-guest-layout>

    <x-slot:title>Forgot password</x-slot:title>

    <section class="login-section">

        <div class="login-container">
            <div class="login-welcome-bloc">
                <p>So you have forgotten your password !</p>
                <h4>YOU CAN EASILY RESET IT</h4>
                <h6></h6>
            </div>

            <div class="login-form">
                <h5>Reset password</h5>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div>
                        <input type="email" id="email" name="email" value="{{old("email")}}" placeholder="Enter your email" required autofocus>
                        @error("email")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="input-submit">
                        <input type="submit" value="Email Password Reset Link">
                    </div>
                </form>
            </div>
        </div>

    </section>

</x-guest-layout>

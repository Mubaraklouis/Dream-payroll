
<x-guest-layout>

    <x-slot:title>Employee Login</x-slot>

    <section class="login-section">

        <div class="login-container">
            <div class="login-welcome-bloc">
                <p>Nice to see you again</p>
                <h4>WELCOME TO OUR PAYROLL SYSTEM</h4>
                <h6></h6>
            </div>

            <div class="login-form">
                <h5>Employee Login</h5>
                <form action="{{route("login")}}" method="POST">
                    @csrf

                    <div>
                        <input type="email" id="email" name="email" value="{{ old("email") }}" placeholder="Enter your email">
                        @error("email")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                        @error("password")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="login-create-account">
                        <a href="{{ route('password.request') }}">Forgot password</a>
                        <i class="bi bi-pause"></i>
                        <a href="{{ route("employee.register") }}">Create Account</a>
                    </div>
                    
                    <div class="input-submit">
                        <input type="submit" value="Log in">                       
                    </div>
                </form>
            </div>
        </div>

    </section>
</x-guest-layout>
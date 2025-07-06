<x-guest-layout>
    
    <x-slot:title>Create Account</x-slot:title>
    
    <section class="login-section">

        <div class="login-container">

            <div class="login-form">
                <h5>Create your account Now</h5>
                <form action="{{ route("employee.register") }}" method="POST">
                    @csrf
                    <div>
                        <input type="email" id="email" name="email" value="{{ old("email") }}" autocomplete="username" placeholder="Enter your email">
                        @error('email')
                            <small class="text-danger">{{ $message }} <br> If this is your email, please contact your administrator.</small>
                         @enderror
                    </div>
                    <div>
                        <input type="text" id="code" name="code" value="{{ old("code") }}" placeholder="Enter unique code">
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-submit">
                        <input type="submit" value="Continue">
                    </div>
                </form>
            </div>

            <div class="login-welcome-bloc">
                <p>Welcome to</p>
                <h4>DREAM BRIDGE PAYROLL SYSTEM</h4>
                <h6></h6>
            </div>
        </div>

    </section>
</x-guest-layout>

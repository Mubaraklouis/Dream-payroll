<x-guest-layout>
    <header>
        <img class="logo-long" src="{{ asset("img/logo.jpg")}}" alt="Dream Bridge Logo">
        <img class="logo-court" src="{{ asset("img/logo-court.jpg")}}" alt="Dream Bridge Logo">
        <nav>
            <ul>
                <li><a href="{{ route("home") }}">Home</a></li>
                <li><a href="https://www.dreambridgeconsultants.com" target="_blank">Visit our website</a></li>
                <li><a href="##" id="contact-link">Contacts</a></li>
            </ul>

            <div class="menu">
                <i class="bi bi-list-nested menu-icon"></i>
                <i class="bi bi-x exit-icon"></i>
            </div>

            <div class="active"></div>
        </nav>
        <div class="login">
            <a href="{{route("login")}}">Login</a>
        </div>
    </header>

    <section class="welcome-section">
        <div class="content-wrapper">
            <div class="image-container">
                <img src="{{ asset("img/image1.jpg") }}" alt="Welcome Image">
            </div>
            <div class="text-container">
                <h1>Welcome to Dream Bridge Payroll System!</h1>
                <p>The Dream Bridge Payroll System is designed to serve employees of Dream Bridge Consultants Ltd. It allows employees to check and calculate their financial dues automatically and generates their payment files efficiently.</p>
            </div>
        </div>
    </section>

    {{-- <!-- Popup for Contacts --> --}}
    <div id="contact-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Contact Us</h2>
            <p>Email: info@dreambridgeconsultants.com</p>
            <p>Phone: +61 415 534 616</p>
            <p>Address: Juba - South Sudan</p>
        </div>
    </div>

    <footer class="footer">
        <div class="social-icons">
            <a href="##" target="_blank" class="social-icon">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="##" target="_blank" class="social-icon">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="##" target="_blank" class="social-icon">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="##" target="_blank" class="social-icon">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
        <div class="copyright">
            &copy; 2024 Dream Bridge Consultants Ltd. All rights reserved. <br>Developed with ❤️ and ☕ by <a href="https://nguvutech.com/" target="_blank">NGUVU TECH</a>
        </div>
    </footer>
</x-guest-layout>

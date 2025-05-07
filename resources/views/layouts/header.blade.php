<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediFind - Your Local Healthcare Directory</title>

    <link rel="stylesheet" href="{{asset('user_panel/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('user_panel/css//mobile-menu.css')}}">

</head>

<body>

    <header>
        <div class="header-container">
            <a href="index.html" class="logo">
                <i class="fas fa-heartbeat"></i>
                MediFind
            </a>

            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="{{ route('index')}}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('hospitals.view')}}" class="nav-link">Hospitals</a></li>
                    <li><a href="{{ route('doctors.view')}}" class="nav-link">Doctors</a></li>
                    <li><a href="{{ route('ambulances.view')}}" class="nav-link">Ambulances</a></li>
                    <li><a href="{{ route('emergency.view')}}" class="nav-link">Emergency</a></li>
                    <li><a href="{{ route('about.view')}}" class="nav-link">About</a></li>
                    <li><a href="{{ route('contact.view')}}" class="nav-link">Contact</a></li>
                </ul>

                <div class="auth-buttons">
                    <a href="profile.html" class="btn btn-login">Profile</a>

                    <a href="login.html" class="btn btn-login">Login</a>
                    <a href="signup.html" class="btn btn-signup">Sign Up</a>
                </div>
            </nav>

            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    @yield('content')


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>MediFind</h3>
                    <p>Your trusted healthcare directory for finding the best hospitals, treatments, and medical
                        professionals in your area.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="hospitals.html">Hospitals</a></li>
                        <li><a href="doctors.html">Doctors</a></li>
                        <li><a href="specialties.html">Specialties</a></li>
                        <li><a href="emergency.html">Emergency</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Information</h3>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter for health tips and updates.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; <span id="currentYear"></span> MediFind. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="{{asset('user_panel/js/main.css')}}"></script>
    <script src="{{asset('user_panel/js/mobile.menu.js')}}"></script>


</body>

</html>
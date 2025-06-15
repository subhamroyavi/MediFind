<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediFind - Your Local Healthcare Directory</title>
    <link rel="icon" href="{{ asset('user_panel/logo/mediquest-logo.png') }}" sizes="512x512" type="image/png">

    <link rel="stylesheet" href="{{asset('user_panel/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('user_panel/css//mobile-menu.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Dropdown Container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Toggle Button */
        .btn-dropdown {
            background: white;
            color: #0066cc;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .btn-dropdown:hover {
            background: #f5f5f5;
        }

        /* Dropdown Content */
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
            padding: 10px 0;
            margin-top: 5px;
            border: 1px solid #e0e0e0;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }

        /* Dropdown Sections */
        .dropdown-section {
            padding: 0 10px;
        }

        .dropdown-header {
            display: block;
            padding: 8px 12px;
            font-size: 12px;
            color: #070707;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        /* Dropdown Links */
        .dropdown-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            border-radius: 4px;
            margin: 0 5px;
        }

        .dropdown-link:hover {
            background-color: #f5f5f5;
            color: #0066cc;
        }

        .dropdown-link i {
            width: 18px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        /* Divider */
        .dropdown-divider {
            margin: 8px 0;
            border: none;
            border-top: 1px solid #e0e0e0;
        }

        /* Special Logout Link */
        .logout-link {
            color: #e74c3c;
        }

        .logout-link:hover {
            background-color: #fdecea;
            color: #e74c3c;
        }

        /* Caret Animation */
        .btn-dropdown i {
            transition: transform 0.3s ease;
            font-size: 12px;
        }

        .dropdown.active .btn-dropdown i {
            transform: rotate(180deg);
        }

        /* Mobile Responsiveness */
        @media (max-width: 1024px) {
            .dropdown {
                width: 100%;
            }

            .btn-dropdown {
                width: 100%;
                justify-content: space-between;
                padding: 12px 15px;
                background: white;
                border: none;
                /* border-radius: 0; */
                color: #070707;
            }

            .dropdown-content {
                position: static;
                box-shadow: none;
                /* background-color: transparent; */
                background-color: white;
                border: none;
                padding: 0;
                min-width: auto;
                display: none;
                margin-top: 0;
            }

            .dropdown.active .dropdown-content {
                display: block;
            }

            .dropdown-section {
                padding: 0;
            }

            .dropdown-link {
                padding: 12px 25px;
                color: #070707;
                border-radius: 0;
                margin: 0;
            }

            .dropdown-header {
                padding: 15px 25px 8px;
                color: #070707;
            }

            .dropdown-divider {
                margin: 5px 25px;
            }

            .auth-buttons .dropdown {
                order: 1;
            }

            .nav-menu.active .dropdown {
                border-top: 1px solid #eee;
                margin-top: 10px;
                padding-top: 10px;
            }
        }
    </style>

    <style>
        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 400px;
            width: 90%;
            padding: 0;
            margin: 0;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transform: translateX(120%);
            animation: slideIn 0.3s forwards;
            z-index: 9999;
        }

        .custom-alert+.custom-alert {
            top: 80px;
        }

        .custom-alert+.custom-alert+.custom-alert {
            top: 140px;
        }

        .alert-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        .custom-alert-success {
            background-color: #28a745;
            border-left: 5px solid #218838;
        }

        .custom-alert-danger {
            background-color: #dc3545;
            border-left: 5px solid #c82333;
        }

        .close-btn {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            padding: 0 0 0 15px;
            line-height: 1;
            transition: opacity 0.2s;
        }

        .close-btn:hover {
            opacity: 0.8;
        }

        @keyframes slideIn {
            from {
                transform: translateX(120%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .custom-alert {
                width: calc(100% - 40px);
                right: 20px;
                left: 20px;
                max-width: none;
            }
        }
    </style>
    @yield('header')
</head>

<body>

    <header>
        <div class="header-container">
            <a href="{{ route('index') }}" class="logo">
                <i class="fas fa-heartbeat"></i>
                MediFind
            </a>

            <nav class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="{{ route('index')}}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('hospitals.view') }}" class="nav-link">Hospitals</a></li>
                    <li><a href="{{ route('doctors') }}" class="nav-link">Doctors</a></li>
                    <li><a href="{{ route('ambulances.view')}}" class="nav-link">Ambulances</a></li>
                    <li><a href="{{ route('emergency.view')}}" class="nav-link">Emergency</a></li>
                    <li><a href="{{ route('about.view')}}" class="nav-link">About</a></li>
                    <li><a href="{{ route('contact.view')}}" class="nav-link">Contact</a></li>
                </ul>

                <div class="auth-buttons">
                    <div class="dropdown">
                        <button class="btn-dropdown" onclick="this.parentElement.classList.toggle('active')">
                            <span>Menu</span>
                            <i class="fas fa-caret-down"></i>
                        </button>
                        @if (Auth::check() && session()->get('authenticated'))
                        <div class="dropdown-content">
                            <a href="{{ route('profile')}}" class="dropdown-link">
                                <i class="fas fa-user-cog"></i> Profile
                            </a>
                            <hr class="dropdown-divider">

                            <a href="{{ route('logout') }}" class="dropdown-link logout-link">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                        @else
                        <div class="dropdown-content">
                            <!-- User Section -->
                            <div class="dropdown-section">
                                <a href="{{ route('login') }}" class="dropdown-link">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </a>
                                <hr class="dropdown-divider">
                                <span class="dropdown-header">As a User</span>
                                <a href="{{ route('signup') }}" class="dropdown-link">
                                    <i class="fas fa-user-plus"></i> Sign Up
                                </a>
                            </div>

                            <hr class="dropdown-divider">

                            <!-- Content Section -->
                            <div class="dropdown-section">
                                <span class="dropdown-header">As a Content Creator</span>
                                <a href="{{ route('signup') }}" class="dropdown-link">
                                    <i class="fas fa-user-plus"></i> Sign Up
                                </a>
                            </div>

                        </div>
                        @endif
                    </div>
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
    <script src="{{asset('user_panel/js/tap.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script>
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('active');
                }
            });
        });
    </script>
    @yield('js')



</body>

</html>
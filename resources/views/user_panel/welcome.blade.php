@extends('layouts.app')

@section('main-content')
 <!-- Hero Section -->
 <section class="hero">
        <div class="hero-content">
            <h1>Find the Best Healthcare Near You</h1>
            <p>Discover top-rated hospitals, specialized treatments, and expert doctors in your local area.</p>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search hospitals, treatments, or doctors...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>How MediFind Helps You</h2>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Find Local Hospitals</h3>
                        <p>Easily locate hospitals and healthcare facilities close to your location with detailed
                            information about their services.</p>
                        <a href="hospitals.html" class="feature-link">
                            Browse Hospitals <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Top Rated Doctors</h3>
                        <p>Discover experienced specialists and healthcare professionals with excellent patient reviews
                            in various medical fields.</p>
                        <a href="doctors.html" class="feature-link">
                            Find Doctors <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Emergency Services</h3>
                        <p>Quick access to emergency numbers, ambulance services, and urgent care facilities when you
                            need immediate help.</p>
                        <a href="emergency.html" class="feature-link">
                            Emergency Info <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hospitals Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Featured Hospitals</h2>
                <a href="hospitals.html" class="view-all">
                    View All Hospitals <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="hospital-grid">
                <!-- Hospital Card 1 -->
                <div class="hospital-card">
                    <div class="hospital-image"
                        style="background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                        <span class="rating-badge">
                            4.8 <i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="hospital-content">
                        <h3><a href="hospital-detail.html">City General Hospital</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Healthcare Ave, Downtown</span>
                        </div>
                        <div class="specialties">
                            <h4>Top Specialties:</h4>
                            <div class="specialties-list">
                                <span class="specialty-tag">Cardiology</span>
                                <span class="specialty-tag">Neurology</span>
                                <span class="specialty-tag">Emergency Care</span>
                            </div>
                        </div>
                        <div class="hospital-cta">
                            <div class="emergency-number">
                                <i class="fas fa-phone-alt"></i>
                                <span>Emergency: 555-1234</span>
                            </div>
                            <button class="view-details">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Hospital Card 2 -->
                <div class="hospital-card">
                    <div class="hospital-image"
                        style="background-image: url('https://images.unsplash.com/photo-1581595219315-a187dd40c322?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                        <span class="rating-badge">
                            4.6 <i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="hospital-content">
                        <h3><a href="hospital-detail.html">Regional Medical Center</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>456 Health St, Midtown</span>
                        </div>
                        <div class="specialties">
                            <h4>Top Specialties:</h4>
                            <div class="specialties-list">
                                <span class="specialty-tag">Pediatrics</span>
                                <span class="specialty-tag">Oncology</span>
                                <span class="specialty-tag">Orthopedics</span>
                            </div>
                        </div>
                        <div class="hospital-cta">
                            <div class="emergency-number">
                                <i class="fas fa-phone-alt"></i>
                                <span>Emergency: 555-5678</span>
                            </div>
                            <button class="view-details">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Hospital Card 3 -->
                <div class="hospital-card">
                    <div class="hospital-image"
                        style="background-image: url('https://images.unsplash.com/photo-1530026186672-2cd00ffc50fe?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                        <span class="rating-badge">
                            4.9 <i class="fas fa-star"></i>
                        </span>
                    </div>
                    <div class="hospital-content">
                        <h3><a href="hospital-detail.html">University Hospital</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>789 Campus Dr, University District</span>
                        </div>
                        <div class="specialties">
                            <h4>Top Specialties:</h4>
                            <div class="specialties-list">
                                <span class="specialty-tag">Research</span>
                                <span class="specialty-tag">Cardiac Surgery</span>
                                <span class="specialty-tag">Neurosurgery</span>
                            </div>
                        </div>
                        <div class="hospital-cta">
                            <div class="emergency-number">
                                <i class="fas fa-phone-alt"></i>
                                <span>Emergency: 555-9012</span>
                            </div>
                            <button class="view-details">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Featured Doctors</h2>
                <a href="doctors.html" class="view-all">
                    View All Doctors <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="doctor-grid">
                <!-- Doctor Card 1 -->
                <div class="doctor-card">
                    <div class="doctor-image">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Dr. Sarah Johnson">
                    </div>
                    <div class="doctor-content">
                        <h3><a href="doctor-detail.html">Dr. Sarah Johnson</a></h3>
                        <p class="specialty">Cardiologist</p>
                        <div class="hospital">
                            <i class="fas fa-hospital"></i>
                            <span>City General Hospital</span>
                        </div>
                        <div class="rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>4.7 (128 reviews)</span>
                            </div>
                        </div>
                        <div class="doctor-cta">
                            <a href="doctor-detail.html" class="view-profile">View Profile</a>
                            <button class="book-appointment">Book Appointment</button>
                        </div>
                    </div>
                </div>

                <!-- Doctor Card 2 -->
                <div class="doctor-card">
                    <div class="doctor-image">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Dr. Michael Chen">
                    </div>
                    <div class="doctor-content">
                        <h3><a href="doctor-detail.html">Dr. Michael Chen</a></h3>
                        <p class="specialty">Neurologist</p>
                        <div class="hospital">
                            <i class="fas fa-hospital"></i>
                            <span>Regional Medical Center</span>
                        </div>
                        <div class="rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>5.0 (87 reviews)</span>
                            </div>
                        </div>
                        <div class="doctor-cta">
                            <a href="doctor-detail.html" class="view-profile">View Profile</a>
                            <button class="book-appointment">Book Appointment</button>
                        </div>
                    </div>
                </div>

                <!-- Doctor Card 3 -->
                <div class="doctor-card">
                    <div class="doctor-image">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dr. Angela Martinez">
                    </div>
                    <div class="doctor-content">
                        <h3><a href="doctor-detail.html">Dr. Angela Martinez</a></h3>
                        <p class="specialty">Pediatrician</p>
                        <div class="hospital">
                            <i class="fas fa-hospital"></i>
                            <span>Children's Health Center</span>
                        </div>
                        <div class="rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>4.2 (215 reviews)</span>
                            </div>
                        </div>
                        <div class="doctor-cta">
                            <a href="doctor-detail.html" class="view-profile">View Profile</a>
                            <button class="book-appointment">Book Appointment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Need Immediate Medical Assistance?</h2>
                <p>Access our complete directory of emergency services and get help when you need it most.</p>
                <div class="cta-buttons">
                    <button class="cta-btn primary">Emergency Services</button>
                    <button class="cta-btn secondary">Contact Support</button>
                </div>
            </div>
        </div>
    </section>
@endsection
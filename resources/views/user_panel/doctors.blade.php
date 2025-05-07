@extends('layouts.app')

@section('main-content')

 <!-- Main Content -->
 <main class="section">
        <div class="container">
            
            <!-- Page Header -->
            <div class="section-title">
                <h2>Find Doctors Near You</h2>
                <!-- Breadcrumb Navigation -->
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>/</span>
                <a href="doctors.html">Doctors</a>
            </div>

                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search hospitals, treatments, or doctors...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>           

            <!-- Search Results -->
            <div class="doctor-grid" id="doctorResults">
                <!-- Doctor cards will be loaded here -->
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

                <!-- Additional doctor cards would be loaded here -->
            </div>

            <!-- Load More Button -->
            <div class="text-center">
                <button class="btn btn-primary" id="loadMoreDoctors">Load More Doctors</button>
            </div>

            <!-- Pagination (alternative to load more) -->
            <div class="pagination">
                <a href="#" class="page-link"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">4</a>
                <a href="#" class="page-link"><i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </main>


@endsection
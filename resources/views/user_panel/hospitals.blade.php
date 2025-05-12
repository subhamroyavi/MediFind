@extends('layouts.app')

@section('main-content')
<!-- Main Content -->
<main class="section">
    <div class="container">

        <!-- Page Header -->
        <div class="section-title">
            <h2>Find Hospitals Near You</h2>
            <!-- Breadcrumb Navigation -->
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>/</span>
                <a href="hospitals.html">Hospitals</a>
            </div>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search hospitals, treatments, or doctors...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>


        <!-- Search Results -->
        <div class="hospital-grid" id="hospitalResults">
            <!-- Hospital cards will be loaded here -->
            <!-- Cards from index.html would be repeated here -->
            <!-- Hospital Card 1 -->
            <div class="hospital-card">
                <div class="hospital-image"
                    style="background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                    <span class="rating-badge">
                        4.8 <i class="fas fa-star"></i>
                    </span>
                </div>
                <div class="hospital-content">
                    <h3><a href="{{ route('hospitals.details')}}">City General Hospital</a></h3>
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
                        <button class="view-details"><a href="{{ route('hospitals.details')}}">View Details</a></button>
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
                    <h3><a href="{{ route('hospitals.details')}}">City General Hospital</a></h3>
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
                        <button class="view-details"><a href="{{ route('hospitals.details')}}">View Details</a></button>
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
                    <h3><a href="{{ route('hospitals.details')}}">City General Hospital</a></h3>
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
                        <button class="view-details"><a href="{{ route('hospitals.details')}}">View Details</a></button>
                    </div>
                </div>
            </div>

            <!-- Additional hospital cards would be loaded here -->
        </div>

        <!-- Load More Button -->
        <div class="text-center">
            <button class="btn btn-primary" id="loadMoreHospitals">Load More Hospitals</button>
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
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

            <div class="hospital-grid">
                <!-- Ambulance Service 1 -->
                <div class="hospital-card">
                    <div class="hospital-image"
                        style="background-image: url('https://images.unsplash.com/photo-1605296830685-6f9ed2400178?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                    </div>
                    <div class="hospital-content">
                        <h3><a href="#">City Emergency Medical Services</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Emergency Lane, Downtown</span>
                        </div>
                        <div class="specialties">
                            <h4>Services:</h4>
                            <div class="specialties-list">
                                <span class="specialty-tag">Emergency Response</span>
                                <span class="specialty-tag">ALS</span>
                                <span class="specialty-tag">24/7 Service</span>
                            </div>
                        </div>
                        <div class="hospital-cta">
                            <div class="emergency-number">
                                <i class="fas fa-phone-alt"></i>
                                <span>(555) 123-9999</span>
                            </div>
                            <button class="view-details">Request Ambulance</button>
                        </div>
                    </div>
                </div>

                <!-- Ambulance Service 2 -->
                <div class="hospital-card">
                    <div class="hospital-image"
                        style="background-image: url('https://images.unsplash.com/photo-1581595219315-a187dd40c322?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                    </div>
                    <div class="hospital-content">
                        <h3><a href="#">Regional Ambulance Network</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>456 Transport Ave, Midtown</span>
                        </div>
                        <div class="specialties">
                            <h4>Services:</h4>
                            <div class="specialties-list">
                                <span class="specialty-tag">Emergency</span>
                                <span class="specialty-tag">Non-Emergency</span>
                                <span class="specialty-tag">BLS</span>
                            </div>
                        </div>
                        <div class="hospital-cta">
                            <div class="emergency-number">
                                <i class="fas fa-phone-alt"></i>
                                <span>(555) 456-7890</span>
                            </div>
                            <button class="view-details">Request Ambulance</button>
                        </div>
                    </div>
                </div>

                <!-- Ambulance Service 3 -->
                <div class="hospital-card">
                    <div class="hospital-image"
                        style="background-image: url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                    </div>
                    <div class="hospital-content">
                        <h3><a href="#">LifeFlight Air Ambulance</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>City International Airport</span>
                        </div>
                        <div class="specialties">
                            <h4>Services:</h4>
                            <div class="specialties-list">
                                <span class="specialty-tag">Air Ambulance</span>
                                <span class="specialty-tag">Critical Care</span>
                                <span class="specialty-tag">Long Distance</span>
                            </div>
                        </div>
                        <div class="hospital-cta">
                            <div class="emergency-number">
                                <i class="fas fa-phone-alt"></i>
                                <span>(555) 789-1234</span>
                            </div>
                            <button class="view-details">Request Ambulance</button>
                        </div>
                    </div>
                </div>
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

            <!-- Ambulance Information -->
            <div class="content-section">
                <h2>About Ambulance Services</h2>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 2rem;">
                    <div>
                        <h3>Types of Ambulance Services</h3>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-top: 1rem;">
                            <li style="margin-bottom: 0.75rem;"><strong>Emergency Ambulances</strong> - For life-threatening situations requiring immediate medical attention during transport.</li>
                            <li style="margin-bottom: 0.75rem;"><strong>Non-Emergency Ambulances</strong> - For patient transport when no immediate medical treatment is required.</li>
                            <li style="margin-bottom: 0.75rem;"><strong>Basic Life Support (BLS)</strong> - Staffed by EMTs providing basic emergency care.</li>
                            <li style="margin-bottom: 0.75rem;"><strong>Advanced Life Support (ALS)</strong> - Staffed by paramedics who can provide advanced medical care.</li>
                            <li><strong>Air Ambulances</strong> - Helicopter or fixed-wing aircraft for rapid transport over long distances.</li>
                        </ul>
                    </div>
                    <div>
                        <h3>When to Call an Ambulance</h3>
                        <p>Call an ambulance for:</p>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-top: 1rem;">
                            <li style="margin-bottom: 0.5rem;">Chest pain or difficulty breathing</li>
                            <li style="margin-bottom: 0.5rem;">Sudden weakness or numbness in face, arm or leg</li>
                            <li style="margin-bottom: 0.5rem;">Severe bleeding that won't stop</li>
                            <li style="margin-bottom: 0.5rem;">Loss of consciousness</li>
                            <li style="margin-bottom: 0.5rem;">Severe burns or injuries</li>
                            <li style="margin-bottom: 0.5rem;">Suspected stroke or heart attack</li>
                            <li>Any situation where you believe immediate medical care is needed</li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

@endsection
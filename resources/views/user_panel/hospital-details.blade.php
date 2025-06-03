@extends('layouts.app')

@section('main-content')

<!-- Main Content -->
<main class="section">
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span>/</span>
            <a href="hospitals.html">Hospitals</a>
            <span>/</span>
            <a href="">{{ $hospital->hospital_name }}</a>
        </div>



        <!-- Hospital Header -->
        <div class="detail-header">
            <div>
                <h1>{{ $hospital->hospital_name }}</h1>
                <div class="meta-info">
                    <div class="meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $hospital->location->city.', '. $hospital->location->state}}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>Main: {{ $hospital->contacts->where('is_primary', 1)->first()?->value 
                                                ?? 'N/A'  }}</span>
                    </div>
                    <!-- <div class="meta-item">
                            <i class="fas fa-star"></i>
                            <span>4.8 (342 reviews)</span>
                        </div> -->
                </div>
            </div>
            <div class="detail-actions">
                <button class="btn btn-primary">
                    <i class="fas fa-phone-alt"></i> Emergency
                </button>
                <button class="btn btn-secondary">
                    <i class="fas fa-directions"></i> Directions
                </button>
            </div>
        </div>

        <!-- Hospital Gallery -->
        <div class="content-section">
            <div class="main-image-container">
                <img src="{{ asset('storage/' . $hospital->image) }}"
                    alt="{{ $hospital->hospital_name }}"
                    class="main-image"
                    style="width: 100%; height: 400px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: 1rem;">
            </div>
            <!-- Hospital Details Tabs -->
            <div class="content-section">
                <div class="tabs" style="display: flex; border-bottom: 1px solid var(--border-color); margin-bottom: 1.5rem;">
                    <button class="tab-link active" data-tab="overview" style="padding: 0.75rem 1.5rem; background: none; border: none; border-bottom: 3px solid var(--primary-color); font-weight: 500; cursor: pointer;">Overview</button>
                    <button class="tab-link" data-tab="services" style="padding: 0.75rem 1.5rem; background: none; border: none; font-weight: 500; cursor: pointer;">Services</button>
                    <button class="tab-link" data-tab="doctors" style="padding: 0.75rem 1.5rem; background: none; border: none; font-weight: 500; cursor: pointer;">Doctors</button>
                    <!-- <button class="tab-link" data-tab="reviews" style="padding: 0.75rem 1.5rem; background: none; border: none; font-weight: 500; cursor: pointer;">Reviews</button> -->
                </div>

                <!-- Overview Tab -->
                <div id="overview" class="tab-content active">
                    <h2>About {{ $hospital->hospital_name }}</h2>
                    <p>{{ $hospital->description }}</p>

                    <h3>Our Mission</h3>
                    <p>To provide exceptional healthcare services through advanced technology, compassionate care, and a commitment to improving the health and well-being of our community.</p>

                    <h3>Facilities</h3>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem;">
                        @foreach ($hospital->facilities as $facility)

                        <li>{{ $facility->description }}</li>
                        @endforeach

                    </ul>

                    <h3>Location Map</h3>
                    <div class="map-container">
                        <!-- In a real application, this would be an embedded Google Map -->
                        <div style="width: 100%; height: 100%; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                            <p>{{ $hospital->location->google_maps_link }}</p>
                        </div>
                    </div>
                </div>

                <!-- Services Tab -->
                <div id="services" class="tab-content" style="display: none;">
                    <h2>Our Services</h2>
                    <p>City General Hospital offers a wide range of medical services across various specialties:</p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                        @foreach ($hospital->services as $service)

                        <div class="service-card" style="background-color: var(--primary-light); padding: 1.5rem; border-radius: var(--border-radius);">
                            <h3 style="color: var(--primary-color); margin-bottom: 0.75rem;">{{ $service->service_name }}</h3>
                            <!-- <p>Comprehensive heart care including diagnostic testing, interventional procedures, and cardiac rehabilitation.</p> -->
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Doctors Tab -->
                <div id="doctors" class="tab-content" style="display: none;">
                    <h2>Our Doctors</h2>
                    <p>Meet our team of highly qualified medical professionals:</p>

                    <div class="doctor-grid" style="margin-top: 2rem;">
                        <!-- Doctor cards would be loaded here -->
                        <!-- Doctor Card 1 -->
                        <div class="doctor-card">
                            <div class="doctor-image">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Dr. Sarah Johnson">
                            </div>
                            <div class="doctor-content">
                                <h3><a href="doctor-detail.html">Dr. Sarah Johnson</a></h3>
                                <p class="specialty">Cardiologist</p>
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

                                </div>
                            </div>
                        </div>

                        <!-- Doctor Card 2 -->
                        <div class="doctor-card">
                            <div class="doctor-image">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Dr. Robert Chen">
                            </div>
                            <div class="doctor-content">
                                <h3><a href="doctor-detail.html">Dr. Robert Chen</a></h3>
                                <p class="specialty">Neurologist</p>
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
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Dr. Angela Martinez">
                            </div>
                            <div class="doctor-content">
                                <h3><a href="doctor-detail.html">Dr. Angela Martinez</a></h3>
                                <p class="specialty">Pediatrician</p>
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

                    <div class="text-center" style="margin-top: 2rem;">
                        <a href="doctors.html" class="btn btn-secondary">View All Doctors</a>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="reviews" class="tab-content" style="display: none;">
                    <h2>Patient Reviews</h2>
                    <p>What our patients say about their experience at City General Hospital:</p>

                    <div style="margin-top: 2rem;">
                        <!-- Review Card 1 -->
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer">
                                    <div class="reviewer-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Jennifer L.">
                                    </div>
                                    <div class="reviewer-info">
                                        <h4>Jennifer L.</h4>
                                        <div class="review-date">March 15, 2023</div>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>I had an excellent experience at City General Hospital. The staff was attentive and professional, and the facilities were clean and modern. Dr. Johnson was incredibly knowledgeable and took the time to explain everything to me. Highly recommend!</p>
                            </div>
                        </div>

                        <!-- Review Card 2 -->
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer">
                                    <div class="reviewer-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Michael T.">
                                    </div>
                                    <div class="reviewer-info">
                                        <h4>Michael T.</h4>
                                        <div class="review-date">February 28, 2023</div>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>The emergency department handled my situation quickly and efficiently. The nurses were compassionate and the doctor was thorough in his examination. The only reason I'm not giving 5 stars is because the wait time could be improved.</p>
                            </div>
                        </div>

                        <!-- Review Card 3 -->
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer">
                                    <div class="reviewer-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Sarah K.">
                                    </div>
                                    <div class="reviewer-info">
                                        <h4>Sarah K.</h4>
                                        <div class="review-date">January 10, 2023</div>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>I delivered my baby at City General and couldn't have asked for a better experience. The maternity ward was comfortable, the nurses were amazing, and the pediatrician was so gentle with our newborn. Thank you for making this special time so memorable!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Add Review Button -->
                    <div class="text-center" style="margin-top: 2rem;">
                        <button class="btn btn-primary">Add Your Review</button>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="content-section">
                <h2>Contact Information</h2>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 1.5rem;">
                    <div>
                        <h3>Address</h3>
                        <p>{{ $hospital->location->city.', '.$hospital->location->district }}<br>{{ $hospital->location->state.', '.$hospital->location->country }}</p>
                    </div>
                    <div>
                        <h3>Phone Numbers </h3>

                        @foreach ($hospital->contacts as $contact)
                        <p>{{ $contact->contact_type.': '. $contact->value}}<br></p>
                        @endforeach
                    </div>
                    <div>
                        <h3>Hours</h3>

                        @foreach ($hospital->openingDays as $day)
                        <p>{{ $day->opening_day.'-'. date('h:i A', strtotime($day->opening_time)).' to '.date('h:i A', strtotime($day->closing_time)) }}<br></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</main>


@endsection
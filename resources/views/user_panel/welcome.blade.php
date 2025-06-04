@extends('layouts.app')

@section('main-content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Find the Best Healthcare Near You</h1>
        <p>Discover top-rated hospitals, specialized treatments, and expert doctors in your local area.</p>
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
                    <a href="{{ route('hospitals.view') }}" class="feature-link">
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
                    <a href="{{ route('doctors') }}" class="feature-link">
                        Find Doctors <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-ambulance"></i>
                </div>
                <div class="feature-content">
                    <h3>Ambulances Services</h3>
                    <p>Quick access to ambulance numbers, ambulance services, and urgent care facilities when you
                        need immediate help.</p>
                    <a href="{{ route('ambulances.view') }}" class="feature-link">
                        Ambulances Info <i class="fas fa-arrow-right"></i>
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
            <a href="{{ route('hospitals.view') }}" class="view-all">
                View All Hospitals <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="hospital-grid">
            <!-- Hospital Card 1 -->
            @foreach ($hospitals as $hospital)
            <!-- Hospital Card 1 -->

            <div class="hospital-card">
                <div class="hospital-image">
                    <img src="{{ asset('storage/' . $hospital->image) }}" alt="Hospital">
                    <span class="rating-badge">
                        @if ($hospital->organization_type == 'government')
                        Govt.
                        @elseif ($hospital->organization_type == 'private')
                        Pvt.
                        @else
                        Public
                        @endif
                    </span>
                </div>

                <div class="hospital-content">
                    <h3><i class="fas fa-hospital"></i><a href="{{ route('hospitals.details', $hospital->hospital_id) }}"> {{ $hospital->hospital_name }}</a></h3>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $hospital->location ? $hospital->location->city . ', ' . $hospital->location->state : 'N/A' }}</span>
                    </div>
                    <div class="specialties">
                        <h4>Top Specialties:</h4>
                        <div class="specialties-list">
                            @foreach ($hospital->services as $service)
                            <span class="specialty-tag">{{ $service->service_name }}</span>
                            @endforeach

                        </div>
                    </div>
                    <div class="hospital-cta">
                        <div class="emergency-number">
                            <i class="fas fa-phone-alt"></i>
                            <span>{{
                                                $hospital->contacts->where('contact_type', 'phone')->first()?->value 
                                                ?? 'N/A' 
                                                }}
                            </span>
                        </div>
                    </div>
                    <div class="hospital-cta">
                        <a href="{{ route('hospitals.details', $hospital->hospital_id) }}"
                            class="view-profile" id="profile">
                            View Profile
                        </a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Doctors Section -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Featured Doctors</h2>
            <a href="{{ route('doctors') }}" class="view-all">
                View All Doctors <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="doctor-grid">
            <!-- Doctor Card 1 -->
            @foreach ($doctors as $doctor)

            <!-- Doctor Card 1 -->
            <div class="doctor-card">
                <div class="doctor-image">
                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="Dr. Sarah Johnson">
                </div>
                <div class="doctor-content">
                    <h3>
                        <i class="fas fa-user-md"></i>
                        <a href="{{ route('doctor-details', ['id' => $doctor->doctor_id]) }}"
                            id="profile"
                            data-id="{{ $doctor->doctor_id }}"> Dr. {{ $doctor->first_name.' '.$doctor->last_name }}</a></h3>
                    <p class=" specialty"><i class="fas fa-stethoscope"></i> {{ $doctor->specialization }}</p>
                    <div class="hospital">
                        <i class="fas fa-hospital"></i>
                        <div class="doctor-hospital">
                            @isset($doctor->hospital)
                            <span class="badge bg-primary">
                                {{ $doctor->hospital->name  }}
                            </span>
                            @else
                            <span class="text-muted">Hospital not specified</span>
                            @endisset
                        </div>
                    </div>
                  
                    <div class="doctor-cta">
                        <a href="{{ route('doctor-details', ['id' => $doctor->doctor_id]) }}"
                            class="view-profile" id="profile"
                            data-id="{{ $doctor->doctor_id }}">
                            View Profile
                        </a>
                        <!-- <button class="book-appointment">Book Appointment</button> -->
                    </div>
                </div>
            </div>
            @endforeach
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
                <a href="{{ route('emergency.view') }}" class="cta-btn primary">Emergency Services</a>
                <a href="{{ route('contact.view') }}" class="cta-btn secondary">Contact Suppor</a>
            </div>
        </div>
    </div>
</section>
@endsection
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
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="hospital-image d-flex align-items-center justify-content-center" style="height: 200px;">
                            @if (isset($hospital->image))
                            <img src="{{ asset('storage/' . $hospital->image) }}" alt="Hospital">
                            @else
                            <i class="fas fa-hospital-alt text-primary fs-1"></i>
                            @endif
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
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-hospital"></i><a href="{{ route('hospitals.details', $hospital->hospital_id) }}"> {{ $hospital->hospital_name }}</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $hospital->location ? $hospital->location->city . ', ' . $hospital->location->state : 'N/A' }}</span>
                            </div>
                            <div class="mb-3">
                                <h4 class="h6">Top Specialties:</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($hospital->services as $service)
                                    <span class="specialty-tag">{{ $service->service_name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <h4 class="h6">Featured Doctors:</h4>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-user-md text-primary me-2"></i>
                                    <span>Dr. James Wilson - Orthopedics</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-md text-primary me-2"></i>
                                    <span>Dr. Emily Rodriguez - Oncology</span>
                                </div>
                            </div> -->

                            <div class="hospital-cta">
                                <a href="tel: {{
                                                $hospital->contacts->where('contact_type', 'phone')->first()?->value 
                                                ?? 'N/A' 
                                                }}"
                                    class="view-profile" id="profile">
                                    Call Me
                                </a>
                                <a href="{{ route('hospitals.details', $hospital->hospital_id) }}"
                                    class="view-profile " id="profile">
                                    View Profile
                                </a>
                                <!-- <button class="btn btn-primary" style="width: 100%;">Request Ambulance</button> -->
                            </div>

                        </div>
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
            @foreach ($doctors as $doctor)
            <!-- Doctor Card 1 -->
            <div class="hospital-card">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="hospital-image d-flex align-items-center justify-content-center" style="height: 200px;">

                            @if (isset($doctor->image))
                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="do$doctor">
                            @else
                            <i class="fas fa-hospital-alt text-primary fs-1"></i>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-user-md"></i>
                                <a href="{{ route('doctor-details', ['id' => $doctor->doctor_id]) }}"
                                    id="profile"
                                    data-id="{{ $doctor->doctor_id }}"> Dr. {{ $doctor->first_name.' '.$doctor->last_name }}</a>
                            </h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $doctor->locations ? $doctor->locations->city . ', ' . $doctor->locations->state : 'N/A' }}</span>

                            </div>
                            <div class="location">
                                <i class="fas fa-stethoscope"></i>
                                <span>{{ $doctor->specialization }}</span>
                                <!-- <i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i>  -->
                            </div>
                            <div class="location">
                                <i class="fas fa-hospital"></i>
                                @if($doctor->experiences->isNotEmpty())
                                <span class="badge bg-primary">
                                    {{ $doctor->experiences->first()->hospital_name }}
                                </span>
                                @else
                                <span class="text-muted">Hospital not specified</span>
                                @endif
                            </div>
                            <!-- <div class="mb-3">
                                <h4 class="h6">Top Specialties:</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="specialty-tag badge rounded-pill">Orthopedics</span>
                                        <span class="specialty-tag badge rounded-pill">Oncology</span>
                                        <span class="specialty-tag badge rounded-pill">Pediatrics</span>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="mb-3">
                                <h4 class="h6">Featured Doctors:</h4>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-user-md text-primary me-2"></i>
                                    <span>Dr. James Wilson - Orthopedics</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-md text-primary me-2"></i>
                                    <span>Dr. Emily Rodriguez - Oncology</span>
                                </div>
                            </div> -->

                            <div class="hospital-cta">
                                <!-- <a href="tel: +91 44161414"
                                    class="view-profile" id="profile">
                                    Call Me
                                </a> -->
                                <a href="{{ route('doctor-details', ['id' => $doctor->doctor_id]) }}"
                                    class="view-profile" id="profile"
                                    data-id="{{ $doctor->doctor_id }}">
                                    View Profile
                                </a>
                            </div>
                        </div>
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
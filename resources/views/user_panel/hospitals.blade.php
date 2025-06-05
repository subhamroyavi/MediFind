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
                <a href="{{ route('index') }}">Home</a>
                <span>/</span>
                <a href="{{ url()->current() }}">Hospitals</a>
            </div>

            <form action="{{ url()->current() }}" method="GET" class="search-form">
                <div class="search-container">
                    <input type="text" class="search-input" name="search" placeholder="Search hospitals, treatments, or doctors..."
                        aria-label="Search">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>


        <!-- Search Results -->
        <div class="hospital-grid" id="hospitalResults">
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
                                    class="view-profile" id="profile" >
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

            <div class="hospital-card">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="hospital-image d-flex align-items-center justify-content-center" style="height: 200px;">

                            <img src="https://imgs.search.brave.com/NgjVdHN630BOWSkeb5B392BGNUKqBz-tkvzVG2IPaDI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTcz/ODYxMDgzL3Bob3Rv/L2luZHVzdHJpYWwt/cmVhbC1lc3RhdGUt/d2l0aC1zaWduLmpw/Zz9zPTYxMng2MTIm/dz0wJms9MjAmYz0w/LXhmZEhXNTc0Vi1U/a3dacEtFR3RSbGpP/ekpMSXU4cmttNjV4/VEk3Yk93PQ" alt="Hospital">
                            <span class="rating-badge">

                                Public
                            </span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-hospital"></i><a href="{{ route('hospitals.details', $hospital->hospital_id) }}"> Rockland Hospital</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Salt lake, west bengal</span>
                            </div>
                            <div class="mb-3">
                                <h4 class="h6">Top Specialties:</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="specialty-tag badge rounded-pill">Orthopedics</span>
                                        <span class="specialty-tag badge rounded-pill">Oncology</span>
                                        <span class="specialty-tag badge rounded-pill">Pediatrics</span>
                                    </div>
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
                                <a href="tel: +91 44161414"
                                    class="view-profile" id="profile">
                                    Call Me
                                </a>
                                <a href=""
                                    class="view-profile" id="profile">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hospital-card">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="hospital-image d-flex align-items-center justify-content-center" style="height: 200px;">

                            <img src="https://imgs.search.brave.com/uFLhx5RF7KEkZf8DU-bItEUCtV7erEZT-Pvakhn1jKk/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTQ3/MjgxMDgyL3Bob3Rv/L21lZGljYWwtY2xp/bmljLXNpZ24uanBn/P3M9NjEyeDYxMiZ3/PTAmaz0yMCZjPXJO/WjdvRURhVnpZdnVF/RE9YTzVOZVRXbU9I/NXBrQlVIZWVaMWt6/MlRjUFE9">

                            <span class="rating-badge">
                                Govt.
                            </span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-hospital"></i><a href="{{ route('hospitals.details', $hospital->hospital_id) }}"> Rockland Hospital</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Salt lake, west bengal</span>
                            </div>
                            <div class="mb-3">
                                <h4 class="h6">Top Specialties:</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="specialty-tag badge rounded-pill">Orthopedics</span>
                                        <span class="specialty-tag badge rounded-pill">Oncology</span>
                                        <span class="specialty-tag badge rounded-pill">Pediatrics</span>
                                    </div>
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
                                <a href="tel: +91 44161414"
                                    class="view-profile" id="profile">
                                    Call Me
                                </a>
                                <a href=""
                                    class="view-profile" id="profile">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hospital-card">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="hospital-image d-flex align-items-center justify-content-center" style="height: 200px;">

                            <img src="https://imgs.search.brave.com/_awyvyszqzEt_dn9XQ9Z5BCWSQTuRz6fEVAzWy47CvI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTg1/MjUyMTQ2L3Bob3Rv/L29mZmljZS1idWls/ZGluZy5qcGc_cz02/MTJ4NjEyJnc9MCZr/PTIwJmM9Z3ItZ2p4/MWJ2cjZ1S3dPX3NI/MGs1dlM1b1hvWTVK/Z0NZN2QxODNfZmNw/ST0" alt="Hospital">
                            <span class="rating-badge">

                                Public
                            </span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-hospital"></i><a href="{{ route('hospitals.details', $hospital->hospital_id) }}"> Rockland Hospital</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Salt lake, west bengal</span>
                            </div>
                            <div class="mb-3">
                                <h4 class="h6">Top Specialties:</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="specialty-tag badge rounded-pill">Orthopedics</span>
                                        <span class="specialty-tag badge rounded-pill">Oncology</span>
                                        <span class="specialty-tag badge rounded-pill">Pediatrics</span>
                                    </div>
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
                                <a href="tel: +91 44161414"
                                    class="view-profile" id="profile">
                                    Call Me
                                </a>
                                <a href=""
                                    class="view-profile" id="profile">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional hospital cards would be loaded here -->
        </div>

        <!-- Pagination (alternative to load more) -->
        @if($hospitals->hasPages())
        <div class="pagination-wrapper">
            {{ $hospitals->links('vendor.pagination.custom') }}
        </div>
        @endif

    </div>
</main>

@endsection
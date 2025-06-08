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
                <a href="{{ route('index') }}">Home</a>
                <span>/</span>
                <a href="{{ url()->current() }}">Doctors</a>
            </div>

            <form action="{{ url()->current() }}" method="GET" class="search-form">
                <div class="search-container">
                    <input type="text" class="search-input" name="search" placeholder="Search only one word for doctors..."
                        aria-label="Search">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <!-- Search Results -->
        <div class="doctor-grid">
            <!-- Doctor Card 1 -->
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
            <div class="hospital-card">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="hospital-image d-flex align-items-center justify-content-center" style="height: 200px;">
                            <img src="https://imgs.search.brave.com/5YEFlSaPsVszFQ-7sAe_edF-k-bUp6jJMYncmx4d0cU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTM3/MzI1OTYzMy9waG90/by9wb3J0cmFpdC1v/Zi1zdWNjZXNzZnVs/LW51cnNlLXdpdGgt/dGVhbS5qcGc_cz02/MTJ4NjEyJnc9MCZr/PTIwJmM9QXZQTjZJ/ckljbXZrZXo5MXRJ/eUtLbnRfZU5heTlK/azBHeU04YVZWNTR2/VT0" alt="doctor">
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-user-md"></i>
                                <a href="" id="profile"> Dr. Jhony Josef</a>
                            </h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span> Kamakhya, Assam</span>

                            </div>
                            <div class="location">
                                <i class="fas fa-stethoscope"></i>
                                <span>Pediatrician</span>
                                <!-- <i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i>  -->
                            </div>
                            <div class="location">
                                <i class="fas fa-hospital"></i>

                                <span class="text-muted">Massachusetts General Hospital</span>
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
                            <img src="https://imgs.search.brave.com/n4gmt0IAfqIS8UfkwZPV_h3Si0EGJjEwh_9aYI7AZWg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90NC5m/dGNkbi5uZXQvanBn/LzA2LzU4Lzc3LzUx/LzM2MF9GXzY1ODc3/NTE2M19tVGYwcTU1/YjNWakhOVXIxM0li/TzNjYkFKejhLNVdG/Vy5qcGc" alt="doctor">
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-user-md"></i>
                                <a href="" id="profile"> Dr. Jhony Josef</a>
                            </h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span> Kamakhya, Assam</span>

                            </div>
                            <div class="location">
                                <i class="fas fa-stethoscope"></i>
                                <span>Pediatrician</span>
                                <!-- <i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i>  -->
                            </div>
                            <div class="location">
                                <i class="fas fa-hospital"></i>

                                <span class="text-muted">Massachusetts General Hospital</span>
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
                            <img src="https://imgs.search.brave.com/sORsHeX8ku3bf55znHC8-aXV9CUVrqFbtNhV3nDu-fs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90NC5m/dGNkbi5uZXQvanBn/LzAzLzIwLzUyLzMx/LzM2MF9GXzMyMDUy/MzE2NF90eDdSZGQ3/STJYRFR2dktmejJv/UnVScEtPUEU1ejBu/aS5qcGc" alt="do$doctor">
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><i class="fas fa-user-md"></i>
                                <a href="" id="profile"> Dr. Jhony Josef</a>
                            </h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span> Kamakhya, Assam</span>

                            </div>
                            <div class="location">
                                <i class="fas fa-stethoscope"></i>
                                <span>Pediatrician</span>
                                <!-- <i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i>  -->
                            </div>
                            <div class="location">
                                <i class="fas fa-hospital"></i>

                                <span class="text-muted">Massachusetts General Hospital</span>
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
                                <a href=""
                                    class="view-profile" id="profile">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="pagination-wrapper">
            {{ $doctors->links('vendor.pagination.custom') }}
        </div>

    </div>
</main>

@endsection

@section('js-content')

@endsection
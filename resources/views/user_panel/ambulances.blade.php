@extends('layouts.app')

@section('main-content')
<!-- Main Content -->
<main class="section">
    <div class="container">
        <!-- Page Header -->
        <div class="section-title">
            <h2>Find Ambulances Near You</h2>
            <div class="breadcrumb">
                <a href="{{ route('index') }}">Home</a>
                <span>/</span>
                <a href="{{ url()->current() }}">Ambulances</a>
            </div>

            <form action="{{ url()->current() }}" method="GET" class="search-form">
                <div class="search-container">
                    <input type="text" class="search-input" name="search" placeholder="Search only one word for Ambulances..."
                        aria-label="Search">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="hospital-grid d-none" id="ambulances-container">
            @foreach ($ambulances as $ambulance)

            <div class="hospital-card">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="hospital-image d-flex align-items-center justify-content-center" style="height: 200px; position: relative;">
                            @if(!empty($ambulance->image) && Storage::exists('public/'.$ambulance->image))
                            <img src="{{ asset('storage/' . $ambulance->image) }}"
                                alt="Ambulance vehicle"
                                class="h-100 object-fit-cover w-100">
                            @else
                            <div class="text-center" aria-hidden="true">
                                <i class="fa-solid fa-truck-medical text-primary fs-1"></i>
                                <!-- <span class="visually-hidden">Ambulance placeholder image</span> -->
                            </div>
                            @endif

                            <span class="rating-badge position-absolute bottom-0 end-0 bg-white px-2 py-1 rounded-start">
                                @switch($ambulance->organization_type)
                                @case('government')
                                Govt.
                                @break
                                @case('private')
                                Pvt.
                                @break
                                @default
                                Public
                                @endswitch
                            </span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><a href=""><i class="fas fa-car"></i> {{ $ambulance->first_name }} {{ $ambulance->last_name }}</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span> {{ $ambulance->location->city }}, {{ $ambulance->location->district }}</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-id-card"></i>
                                <span>{{ $ambulance->vehicle_number }}</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-truck-medical"></i>
                                <span>{{ $ambulance->vehicle_model }}</span>
                            </div>
                            <div class="mb-3">
                                <h4 class="h6">Top Specialties:</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="specialty-tag badge rounded-pill">{{ $ambulance->service_type }}</span>
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
                                <a href="tel: {{ $ambulance->phone }}"
                                    class="view-profile" id="profile">
                                    Call Me
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

                            <img src="https://imgs.search.brave.com/3hMs2scCDmeEBov-oDWRtyQ1Wl1sHf2I8L03TgAfZiE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvNDc5/MzEzOTU0L3Bob3Rv/L3Jlc2N1ZS10ZWFt/LXByb3ZpZGluZy1m/aXJzdC1haWQuanBn/P3M9NjEyeDYxMiZ3/PTAmaz0yMCZjPWR3/d05wNUg0M3RiRkQz/bG9JZDlOYmgyekNX/RW1FQmFNM2J2VUF6/ZWJSQ0E9" alt="Hospital">
                            <span class="rating-badge">
                                Public
                            </span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><a href=""><i class="fas fa-car"></i> John Sen</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Salt lake, west bengal</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-id-card"></i>
                                <span>MH-01-AB-1234</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-truck-medical"></i>
                                <span>Toyota Corolla LE 2022</span>
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

                            <img src="https://imgs.search.brave.com/lUB1bjxo1gfwsX4etl3PoMfD6VsRfBcXBDpmOCvtNZI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/cHJlbWl1bS1waG90/by9wb3J0cmFpdC1k/b2N0b3Itd2Vhcmlu/Zy1tYXNrLXN0YW5k/aW5nLWFnYWluc3Qt/YW1idWxhbmNlXzEw/NDg5NDQtMTExMzk4/MDkuanBnP3NlbXQ9/YWlzX2h5YnJpZA" alt="Hospital">
                            <span class="rating-badge">
                                Govt.
                            </span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><a href=""><i class="fas fa-car"></i> John Sen</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Salt lake, west bengal</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-id-card"></i>
                                <span>MH-01-AB-1234</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-truck-medical"></i>
                                <span>Toyota Corolla LE 2022</span>
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

                            <img src="https://imgs.search.brave.com/obmiklJbtS8EmN9E7KTtDRiehq9UG-scqLjeD0qFP9c/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTQ4/NzQ1MDc2MC9waG90/by9mZW1hbGUtYW1i/dWxhbmNlLWRyaXZl/ci1iZWhpbmQtdGhl/LXdoZWVsLmpwZz9z/PTYxMng2MTImdz0w/Jms9MjAmYz1HQ21a/emFiYXNMNlBwVXB6/T0lLY1Uwa01vMTZ5/UjRDSlQ5Qk9fWVdr/a21BPQ" alt="Hospital">
                            <span class="rating-badge">
                                Public
                            </span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 text-primary"><a href=""><i class="fas fa-car"></i> John Sen</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Salt lake, west bengal</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-id-card"></i>
                                <span>MH-01-AB-1234</span>
                            </div>
                            <div class="location">
                                <i class="fa-solid fa-truck-medical"></i>
                                <span>Toyota Corolla LE 2022</span>
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

        </div>

        @if($ambulances->hasPages())
        <div class="pagination-wrapper">
            {{ $ambulances->links('vendor.pagination.custom') }}
        </div>
        @endif

        <!-- Ambulance Information -->
        <div class="content-section">
            <h2>About Ambulance Services</h2>
            <div class="ambulance-info-grid">
                <div>
                    <h3>Types of Ambulance Services</h3>
                    <ul class="info-list">
                        <li><strong>Emergency Ambulances</strong> - For life-threatening situations requiring immediate medical attention during transport.</li>
                        <li><strong>Non-Emergency Ambulances</strong> - For patient transport when no immediate medical treatment is required.</li>
                        <li><strong>Basic Life Support (BLS)</strong> - Staffed by EMTs providing basic emergency care.</li>
                        <li><strong>Advanced Life Support (ALS)</strong> - Staffed by paramedics who can provide advanced medical care.</li>
                        <li><strong>Air Ambulances</strong> - Helicopter or fixed-wing aircraft for rapid transport over long distances.</li>
                    </ul>
                </div>
                <div>
                    <h3>When to Call an Ambulance</h3>
                    <p>Call an ambulance for:</p>
                    <ul class="info-list">
                        <li>Chest pain or difficulty breathing</li>
                        <li>Sudden weakness or numbness in face, arm or leg</li>
                        <li>Severe bleeding that won't stop</li>
                        <li>Loss of consciousness</li>
                        <li>Severe burns or injuries</li>
                        <li>Suspected stroke or heart attack</li>
                        <li>Any situation where you believe immediate medical care is needed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js-content')
<style>
    .loading-spinner,
    .no-results,
    .error-message {
        grid-column: 1/-1;
        text-align: center;
        padding: 2rem;
        font-size: 1.2rem;
    }

    .loading-spinner {
        color: #3490dc;
    }

    .no-results {
        color: #e3342f;
    }

    .error-message {
        color: #d9534f;
    }
</style>

<script>
    let debounceTimer;
    $('#searchStr').on('keyup', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            let searchStr = $(this).val().trim();
            if (searchStr.length === 0) {
                $('#ambulances-container').addClass('d-none').html(''); // hide and clear
                return;
            }

            $.ajax({
                url: "{{ route('ambulance-search') }}",
                method: 'GET',
                data: {
                    searchStr
                },
                beforeSend: function() {
                    $('#ambulances-container')
                        .removeClass('d-none')
                        .html('<div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Searching...</div>');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#ambulances-container')
                            .removeClass('d-none')
                            .html(response.html);
                    } else if (response.status === 'nothing_found') {
                        $('#ambulances-container')
                            .removeClass('d-none')
                            .html('<div class="no-results">No ambulances found matching your search</div>');
                    }
                },
                error: function() {
                    $('#ambulances-container')
                        .removeClass('d-none')
                        .html('<div class="error-message">Something went wrong. Please try again later.</div>');
                }
            });
        }, 300);
    });
</script>

@endsection
@extends('layouts.app')

@section('main-content')
<!-- Main Content -->
<main class="section">
    <div class="container">
        <!-- Page Header -->
        <div class="section-title">
            <h2>Find Ambulances Near You</h2>
            <div class="breadcrumb">
                <a href="">Home</a>
                <span>/</span>
                <a href="#">Ambulances</a>
            </div>

            <div class="search-container">
                <input type="text" class="search-input" id="searchStr" name="searchStr"
                    placeholder="Search ambulances by name, email, or phone...">
                <button class="search-btn" id="searchBtn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="hospital-grid d-none" id="ambulances-container">
            @foreach ($ambulances as $ambulance)
            <div class="card">

                <div class="hospital-card" id="hospital-card">
                    <div class="doctor-image">
                        <img src="{{ asset('storage/' . $ambulance->image) }}" alt="{{ $ambulance->first_name }} {{ $ambulance->last_name }}">
                        <span class="rating-badge">
                            @if ($ambulance->organization_type == 'government')
                            Govt.
                            @elseif ($ambulance->organization_type == 'Private')
                            Pvt.
                            @else
                            Public
                            @endif
                        </span>
                    </div>
                    <div class="hospital-content">
                        <h3><a href="#">{{ $ambulance->first_name }} {{ $ambulance->last_name }}</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $ambulance->location->city }}, {{ $ambulance->location->district }}</span>
                        </div>
                        <div class="location">
                            <i class="fa-solid fa-id-card"></i>
                            <span>{{ $ambulance->vehicle_number }}</span>
                        </div>
                        <div class="location">
                            <i class="fa-solid fa-truck-medical"></i>
                            <span>{{ $ambulance->vehicle_model }}</span>
                        </div>
                        <div class="specialties">
                            <h4>Services:</h4>
                            <div class="specialties-list">
                                <span class="specialty-tag">{{ $ambulance->service_type }}</span>
                                <span class="specialty-tag">Critical Care</span>
                                <span class="specialty-tag">Long Distance</span>
                            </div>
                        </div>
                        <div class="hospital-cta">
                            <div class="emergency-number">
                                <i class="fas fa-phone-alt"></i>
                                <span>{{ $ambulance->phone }}</span>
                            </div>
                            <div class="detail-actions">
                                <button class="btn btn-primary">
                                    <i class="fas fa-phone-alt"></i> Call
                                </button>
                                <button class="btn btn-secondary">
                                    <i class="fas fa-directions"></i> Directions
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
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
    $(document).ready(function() {
        //it is running but show the result not good//
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
    })
</script>

@endsection
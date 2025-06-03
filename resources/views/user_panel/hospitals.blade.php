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
                    <h3><a href="{{ route('hospitals.details', $hospital->hospital_id) }}">{{ $hospital->hospital_name }}</a></h3>
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

                        <div class="hospital-cta">
                            <a href="{{ route('hospitals.details', $hospital->hospital_id) }}"
                                class="view-profile" id="profile"
                                data-id="{{$hospital->hospital_id }}">
                                View Profile
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            @endforeach
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
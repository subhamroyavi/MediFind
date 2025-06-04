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
                    <h3><i class="fas fa-hospital"></i> <a href="{{ route('hospitals.details', $hospital->hospital_id) }}"> {{ $hospital->hospital_name }}</a></h3>
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

            <div class="hospital-card">
                <div class="hospital-image">
                    <img src="https://imgs.search.brave.com/bDtvl2xGdg8Izvwt1qAYxfjKhzA24bQBivONZaQKOIU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90My5m/dGNkbi5uZXQvanBn/LzAxLzI5Lzk5LzYw/LzM2MF9GXzEyOTk5/NjA5NV84WlJha2pD/T3REV3JhdkVjVTc3/NEl0d0ZFTTlBM2FI/MS5qcGc" alt="Hospital">
                    <span class="rating-badge">Govt.</span>

                </div>
                <div class="hospital-content">
                    <h3><a href="hospital-detail.html"><i class="fas fa-hospital"></i> Rockland Hospital</a></h3>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Healthcare Ave, Downtown</span>
                    </div>
                    <div class="specialties">
                        <h4>Top Specialties:</h4>
                        <div class="specialties-list">
                            <span class="specialty-tag">ICU</span>
                            <span class="specialty-tag">Neurology</span>
                            <span class="specialty-tag">OPD</span>
                            <span class="specialty-tag">X-RAY</span>
                        </div>
                    </div>
                    <div class="hospital-cta">
                        <div class="emergency-number">
                            <i class="fas fa-phone-alt"></i>
                            <span>555-1234</span>
                        </div>
                    </div>

                    <div class="hospital-cta">
                        <a href="{{ route('hospitals.view') }}"
                            class="view-profile" id="profile">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="hospital-card">
                <div class="hospital-image">
                    <img src="https://imgs.search.brave.com/S5_I7WagCD6x5UPtL-MpMpZeidPN2gDa0awcIzURBfo/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvODQ2/NzgyNzUwL3Bob3Rv/L2J1aWxkaW5nLW9m/LXRoZS1lbWVyZ2Vu/Y3ktaG9zcGl0YWwu/anBnP3M9NjEyeDYx/MiZ3PTAmaz0yMCZj/PWpwVGtxYzF0UXVS/SThQZkRTN1E0dnZQ/OXlkV0s2ZVBMZnJf/SzVLR2NBY2c9" alt="Hospital">
                    <span class="rating-badge">Govt.</span>

                </div>
                <div class="hospital-content">
                    <h3><a href="hospital-detail.html"><i class="fas fa-hospital"></i> Tata Memorial Hospital</a></h3>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Healthcare Ave, Downtown</span>
                    </div>
                    <div class="specialties">
                        <h4>Top Specialties:</h4>
                        <div class="specialties-list">
                            <span class="specialty-tag">Cardiology</span>
                            <span class="specialty-tag">Neurology</span>
                            <span class="specialty-tag">OPD</span>
                            <span class="specialty-tag">Neurology</span>

                        </div>
                    </div>
                    <div class="hospital-cta">
                        <div class="emergency-number">
                            <i class="fas fa-phone-alt"></i>
                            <span>555-1234</span>
                        </div>
                    </div>

                    <div class="hospital-cta">
                        <a href="{{ route('hospitals.view') }}"
                            class="view-profile" id="profile">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
            <div class="hospital-card">
                <div class="hospital-image">
                    <img src="https://imgs.search.brave.com/ytcbhRMu_hJ8tVXCzXITsa1Df9GASv8RzoZGxYpUwJg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvNTEw/MzUxODYzL3Bob3Rv/L2hvc3BpdGFsLWJ1/aWxkaW5nLmpwZz9z/PTYxMng2MTImdz0w/Jms9MjAmYz1DWlp2/bHFCSWJWQ1g3aDJY/a2VnTE5xaXU4R0Jq/aE5yRFYwd0pHeHBL/aXpvPQ" alt="Hospital">
                    <span class="rating-badge">Govt.</span>

                </div>
                <div class="hospital-content">
                    <h3><a href="hospital-detail.html"><i class="fas fa-hospital"></i> City General Hospital</a></h3>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Healthcare Ave, Downtown</span>
                    </div>
                    <div class="specialties">
                        <h4>Top Specialties:</h4>
                        <div class="specialties-list">
                            <span class="specialty-tag">X-Ray</span>
                            <span class="specialty-tag">Neurology</span>
                            <span class="specialty-tag">OPD</span>
                        </div>
                    </div>
                    <div class="hospital-cta">
                        <div class="emergency-number">
                            <i class="fas fa-phone-alt"></i>
                            <span>555-1234</span>
                        </div>
                    </div>

                    <div class="hospital-cta">
                        <a href="{{ route('hospitals.view') }}"
                            class="view-profile" id="profile">
                            View Profile
                        </a>
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
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

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search hospitals, treatments, or doctors...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <!-- Search Results -->
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
        <div class="pagination-wrapper">
            {{ $doctors->links('vendor.pagination.custom') }}
        </div>

    </div>
</main>

@endsection

@section('js-content')

@endsection
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
                <a href="index.html">Home</a>
                <span>/</span>
                <a href="doctors.html">Doctors</a>
            </div>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search hospitals, treatments, or doctors...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <!-- Search Results -->
        <div class="doctor-grid" id="doctorResults">
            <!-- Doctor cards will be loaded here -->
            @foreach ($doctors as $doctor)

            <!-- Doctor Card 1 -->
            <div class="doctor-card">
                <div class="doctor-image">
                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="Dr. Sarah Johnson">
                </div>
                <div class="doctor-content">
                    <h3><a href="{{ route('doctor-details', ['id' => $doctor->doctor_id]) }}"
                            id="profile"
                            data-id="{{ $doctor->doctor_id }}">Dr. {{ $doctor->first_name.' '.$doctor->last_name }}</a></h3>
                    <p class=" specialty">{{ $doctor->specialization }}</p>
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

            <!-- Additional doctor cards would be loaded here -->
        </div>
        <div class="pagination-wrapper">
            {{ $doctors->links('vendor.pagination.custom') }}
        </div>

    </div>
</main>


@endsection

@section('js-content')
<script>
    $(document).ready(function() {
        $(document).on("click", '#profile', function(e) {
            e.preventDefault(); // prevent the default link behavior

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            const doctorId = $(this).data('id'); // fetch from data attribute if available

            $.ajax({
                type: 'POST',
                url: '/doctors/' + doctorId + '/comment', // use a proper route
                data: {
                    doctor_id: doctorId
                },
                dataType: 'json',
                success: function(response) {
                    console.log("Success:", response);
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                }

            });
        });
    });
</script>
@endsection
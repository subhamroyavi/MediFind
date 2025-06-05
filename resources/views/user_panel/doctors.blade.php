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
                    <input type="text" class="search-input" name="search" placeholder="Search doctors..."
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
            <div class="doctor-card">
                <div class="doctor-image">
                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="Dr. Sarah Johnson">
                </div>
                <div class="doctor-content">
                    <h3>
                        <i class="fas fa-user-md"></i>
                        <a href="{{ route('doctor-details', ['id' => $doctor->doctor_id]) }}"
                            id="profile"
                            data-id="{{ $doctor->doctor_id }}"> Dr. {{ $doctor->first_name.' '.$doctor->last_name }}</a>
                    </h3>
                    <p class=" specialty"><i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i> {{ $doctor->specialization }}</p>
                    <div class="hospital">
                        <i class="fas fa-hospital"></i>
                        <div class="doctor-hospital">
                            @if($doctor->experiences->isNotEmpty())
                            <span class="badge bg-primary">
                                {{ $doctor->experiences->first()->hospital_name }}
                            </span>
                            @else
                            <span class="text-muted">Hospital not specified</span>
                            @endif
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
            <!-- Doctor Card 1 -->
            <div class="doctor-card">
                <div class="doctor-image">
                    <img src="https://imgs.search.brave.com/ngA-0Nd5G8L0e8YmiBiiizFmzI5aLDT05NP-UpDrQ-4/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTgw/NjYwODU0NC9waG90/by9wb3J0cmFpdC1v/Zi1hLWZlbWFsZS1k/b2N0b3ItYXQtdGhl/LXdvcmtwbGFjZS5q/cGc_cz02MTJ4NjEy/Jnc9MCZrPTIwJmM9/TUFSa3R0bGZKMUpv/QXhLZmZybVh4Yklf/cklQSlRLV2FLVHJG/djFxd0NaYz0" alt="Dr. Ronita Roy">
                </div>
                <div class="doctor-content">
                    <h3>
                        <i class="fas fa-user-md"></i>
                        <a href="" id="profile"> Dr. Ronita Roy</a>
                    </h3>
                    <p class=" specialty"><i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i> {{ $doctor->specialization }}</p>
                    <div class="hospital">
                        <i class="fas fa-hospital"></i>
                        <div class="doctor-hospital">
                            <span class="text-muted"> Bosco, Prosacco and Nitzsche Hospital</span>
                        </div>
                    </div>

                    <div class="doctor-cta">
                        <a class="view-profile" id="profile">
                            View Profile
                        </a>
                        <!-- <button class="book-appointment">Book Appointment</button> -->
                    </div>
                </div>
            </div>

            <!-- Doctor Card 2 -->
            <div class="doctor-card">
                <div class="doctor-image">
                    <img src="https://imgs.search.brave.com/U7F5YMVEGZ2c0XSYh4qzFb8WGlcoq-L-x_KkUJ3J9ks/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTE0/OTUxMTIzNi9waG90/by95b3Utd29udC1u/ZWVkLWEtc2Vjb25k/LW9waW5pb24td2l0/aC1oZXItZXhwZXJ0/aXNlLmpwZz9zPTYx/Mng2MTImdz0wJms9/MjAmYz1DMUVEaEtk/bm5neWdnYXZLemNK/U1Qwa0ZheGFwc3hm/RlBxOWVIZUpJZ0tN/PQ" alt="Dr.  Sita sen">
                </div>
                <div class="doctor-content">
                    <h3>
                        <i class="fas fa-user-md"></i>
                        <a href="" id="profile"> Dr.  Sita sen</a>
                    </h3>
                    <p class=" specialty"><i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i> Hematologist</p>
                    <div class="hospital">
                        <i class="fas fa-hospital"></i>
                        <div class="doctor-hospital">
                            <span class="text-muted"> Bosco, Prosacco and Nitzsche Hospital</span>
                        </div>
                    </div>

                    <div class="doctor-cta">
                        <a class="view-profile" id="profile">
                            View Profile
                        </a>
                        <!-- <button class="book-appointment">Book Appointment</button> -->
                    </div>
                </div>
            </div>

             <!-- Doctor Card 2 -->
            <div class="doctor-card">
                <div class="doctor-image">
                    <img src="https://imgs.search.brave.com/RNAiD7PhplALoOf961wVCcPnCJKKTyBd8eOeTaAkM4c/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTQ2/ODY3ODYyOS9waG90/by9wb3J0cmFpdC1o/ZWFsdGhjYXJlLWFu/ZC10YWJsZXQtd2l0/aC1hLWRvY3Rvci13/b21hbi1hdC13b3Jr/LWluLWEtaG9zcGl0/YWwtZm9yLXJlc2Vh/cmNoLW9yLmpwZz9z/PTYxMng2MTImdz0w/Jms9MjAmYz04bVNN/WXM3YTZlSElaMkVG/bS05eDZaMldRSFcz/dU9ydVlYWHpUN0p1/Z1lJPQ" alt="Dr.  Samu Naidu">
                </div>
                <div class="doctor-content">
                    <h3>
                        <i class="fas fa-user-md"></i>
                        <a href="" id="profile"> Dr.  Samu Naidu</a>
                    </h3>
                    <p class=" specialty"><i class="fas fa-stethoscope" style="color: var(--primary-color); margin-right: 0.5rem;"></i> Pediatrician</p>
                    <div class="hospital">
                        <i class="fas fa-hospital"></i>
                        <div class="doctor-hospital">
                            <span class="text-muted"> Mosciski Inc Hospital</span>
                        </div>
                    </div>

                    <div class="doctor-cta">
                        <a class="view-profile" id="profile">
                            View Profile
                        </a>
                        <!-- <button class="book-appointment">Book Appointment</button> -->
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
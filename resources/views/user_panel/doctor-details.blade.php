@extends('layouts.app')

@section('main-content')

<!-- Main Content -->
<main class="section">
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span>/</span>
            <a href="doctors.html">Doctors</a>
            <span>/</span>
            <a href="">Dr. {{ $doctorData->first_name.' '.$doctorData->last_name }}</a>
        </div>

        <!-- Doctor Header -->
        <div class="detail-header">
            <div>
                <h1>Dr. {{ $doctorData->first_name.' '.$doctorData->last_name }}</h1>
                <p class="specialty"
                    style="font-size: 1.25rem; color: var(--primary-color); margin-bottom: 0.5rem;">{{ $doctorData->specialization }}</p>
                <div class="meta-info">
                    <div class="meta-item">
                        <i class="fas fa-hospital"></i>
                        @isset($doctor->hospital)
                        <span class="badge bg-primary">
                            {{ $doctor->hospital->name  }}
                        </span>
                        @else
                        <span class="text-muted">Hospital not specified</span>
                        @endisset
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $doctorData->locations->city.','. $doctorData->locations->district.','. $doctorData->locations->state }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-star"></i>
                        <span>4.7 (128 reviews)</span>
                    </div>
                </div>
            </div>
            <!-- <div class="detail-actions">
                <button class="btn btn-primary">
                    <i class="fas fa-calendar-alt"></i> Book Appointment
                </button>
                <button class="btn btn-secondary">
                    <i class="fas fa-directions"></i> Directions
                </button>
            </div> -->
        </div>

        <!-- Doctor Profile -->
        <div class="content-section">
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
                <div>
                    <div class="doctor-image" style="border-radius: var(--border-radius); overflow: hidden;">
                        <img src="{{ asset('storage/' . $doctorData->image) }}" alt="Dr. Sarah Johnson"
                            style="width: 100%;">
                    </div>
                    <div style="margin-top: 1.5rem;">
                        <h3>Contact Information</h3>
                        <div style="margin-top: 1rem;">
                            <p><i class="fas fa-phone-alt"
                                    style="color: var(--primary-color); margin-right: 0.5rem;"></i> {{ $doctorData->phone }}
                            </p>
                            <p><i class="fas fa-envelope"
                                    style="color: var(--primary-color); margin-right: 0.5rem;"></i>
                                {{ $doctorData->email }}
                            </p>
                            <p><i class="fas fa-hospital"
                                    style="color: var(--primary-color); margin-right: 0.5rem;"></i> @isset($doctor->hospital)
                                <span class="badge bg-primary">
                                    {{ $doctor->hospital->name  }}
                                </span>
                                @else
                                <span class="text-muted">Hospital not specified</span>
                                @endisset
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>About Dr. {{ $doctorData->first_name }}</h2>
                    <p>{{ $doctorData->small_description }}</p>

                    <h3 style="margin-top: 1.5rem;">Education</h3>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem;">
                        @foreach ($doctorData->educations as $education)

                        <li>{{ $education->course_name.'-'.$education->university  }}</li>
                        @endforeach

                    </ul>

                    <h3>Specialties</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <span class="specialty-tag">{{ $doctorData->specialization }}</span>

                    </div>

                    <h3>Languages Spoken</h3>
                    <p>English, Spanish, French</p>
                </div>
            </div>
        </div>

        <!-- Doctor Details Tabs -->
        <div class="content-section">
            <div class="tabs"
                style="display: flex; border-bottom: 1px solid var(--border-color); margin-bottom: 1.5rem;">
                <!-- <button class="tab-link active" data-tab="availability" style="padding: 0.75rem 1.5rem; background: none; border: none; border-bottom: 3px solid var(--primary-color); font-weight: 500; cursor: pointer;">Availability</button> -->
                <button class="tab-link active" data-tab="experience"
                    style="padding: 0.75rem 1.5rem; background: none; border: none; font-weight: 500; cursor: pointer;">Experience</button>
                <button class="tab-link" data-tab="reviews"
                    style="padding: 0.75rem 1.5rem; background: none; border: none; font-weight: 500; cursor: pointer;">Reviews</button>
            </div>

            <!-- Experience Tab -->

            <div id="experience" class="tab-content active">
                <h2>Professional Experience</h2>

                <div style="margin-top: 2rem;">
                    <h3>Positions</h3>
                    @foreach ($doctorData->experiences as $experience)

                    <div
                        style="background-color: var(--primary-light); padding: 1.5rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                        <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">{{ $experience->position }}</h4>
                        <p style="font-weight: 500;">{{ $experience->hospital_name }}</p>
                        <p>{{ $experience->start_date.'-'.$experience->end_date }}</p>
                    </div>

                    @endforeach


                    <!-- <h3>Certifications</h3>
                    <ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem;">
                        <li>American Board of Internal Medicine - Cardiovascular Disease</li>
                        <li>American Board of Internal Medicine - Interventional Cardiology</li>
                        <li>National Board of Echocardiography</li>
                    </ul>

                    <h3>Professional Memberships</h3>
                    <ul style="list-style-type: disc; padding-left: 1.5rem;">
                        <li>American College of Cardiology (Fellow)</li>
                        <li>American Heart Association</li>
                        <li>Society for Cardiovascular Angiography and Interventions</li>
                    </ul> -->
                </div>
            </div>

            <!-- Experience Tab -->
            <!-- <div id="experience" class="tab-content active" style="display: none;">
                    <h2>Professional Experience</h2>
                    
                    <div style="margin-top: 2rem;">
                        <h3>Current Position</h3>
                        <div style="background-color: var(--primary-light); padding: 1.5rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Chief of Cardiology</h4>
                            <p style="font-weight: 500;">City General Hospital</p>
                            <p>2015 - Present</p>
                        </div>
                        
                        <h3>Previous Positions</h3>
                        <div style="background-color: var(--primary-light); padding: 1.5rem; border-radius: var(--border-radius); margin-bottom: 1rem;">
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Cardiologist</h4>
                            <p style="font-weight: 500;">Regional Heart Center</p>
                            <p>2010 - 2015</p>
                        </div>
                        
                        <div style="background-color: var(--primary-light); padding: 1.5rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
                            <h4 style="color: var(--primary-color); margin-bottom: 0.5rem;">Cardiology Fellow</h4>
                            <p style="font-weight: 500;">Johns Hopkins Hospital</p>
                            <p>2007 - 2010</p>
                        </div>
                        
                        <h3>Certifications</h3>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem;">
                            <li>American Board of Internal Medicine - Cardiovascular Disease</li>
                            <li>American Board of Internal Medicine - Interventional Cardiology</li>
                            <li>National Board of Echocardiography</li>
                        </ul>
                        
                        <h3>Professional Memberships</h3>
                        <ul style="list-style-type: disc; padding-left: 1.5rem;">
                            <li>American College of Cardiology (Fellow)</li>
                            <li>American Heart Association</li>
                            <li>Society for Cardiovascular Angiography and Interventions</li>
                        </ul>
                    </div>
                </div> -->

            <!-- Reviews Tab -->
            <div id="reviews" class="tab-content" style="display: none;">
                <h2>Patient Reviews</h2>
                <p>What patients say about their experience with Dr. Johnson:</p>

                <div style="margin-top: 2rem;">
                    <!-- Review Card 1 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer">
                                <div class="reviewer-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Robert T.">
                                </div>
                                <div class="reviewer-info">
                                    <h4>Robert T.</h4>
                                    <div class="review-date">May 10, 2023</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <p>Dr. Johnson is an exceptional cardiologist. She took the time to explain my condition
                                in detail and answered all my questions. Her bedside manner is excellent, and I felt
                                completely at ease during my procedure. The results have been life-changing!</p>
                        </div>
                    </div>

                    <!-- Review Card 2 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer">
                                <div class="reviewer-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Jennifer L.">
                                </div>
                                <div class="reviewer-info">
                                    <h4>Jennifer L.</h4>
                                    <div class="review-date">April 22, 2023</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <p>I've been seeing Dr. Johnson for my heart condition for 3 years now, and I couldn't
                                be happier with the care I've received. She's knowledgeable, compassionate, and
                                always up-to-date with the latest treatments. The office staff is also very
                                professional and helpful.</p>
                        </div>
                    </div>

                    <!-- Review Card 3 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer">
                                <div class="reviewer-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Michael T.">
                                </div>
                                <div class="reviewer-info">
                                    <h4>Michael T.</h4>
                                    <div class="review-date">March 15, 2023</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <p>Dr. Johnson diagnosed my heart condition accurately and recommended an effective
                                treatment plan. The only reason I'm not giving 5 stars is because it can sometimes
                                be difficult to get a quick appointment, but once you're in, the care is excellent.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Add Review Button -->
                <div class="text-center" style="margin-top: 2rem;">
                    <button class="btn btn-primary">Add Your Review</button>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
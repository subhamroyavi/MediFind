@extends('layouts.app')

@section('main-content')

<!-- Main Content -->
<main class="section">
    <div class="container">
        <div class="section-title">


            <h2>About Us</h2>

            <!-- Breadcrumb Navigation -->
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>/</span>
                <a href="doctors.html">About Us</a>
            </div>
            <!-- Our Story -->
            <div class="content-section">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                    <div>
                        <p>Founded in 2015, MediFind began as a simple idea to make healthcare more accessible to
                            everyone. Our founders, a team of healthcare professionals and technologists, recognized the
                            challenges people face when trying to find quality medical care.</p>
                        <p>After witnessing friends and family struggle to navigate complex healthcare systems, we set
                            out to create a solution that would empower patients with information and simplify the
                            process of finding the right care at the right time.</p>
                        <p>Today, MediFind serves millions of users across the country, helping them connect with
                            top-rated hospitals, specialists, and emergency services in their area.</p>
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            alt="Our Team" style="width: 100%; border-radius: var(--border-radius);">
                    </div>
                </div>
            </div>

            <!-- Our Mission -->
            <div class="content-section" style="background-color: var(--primary-light);">
                <div class="section-title">
                    <h2>Our Mission</h2>
                </div>

                <div style="text-align: center; max-width: 800px; margin: 0 auto;">
                    <p style="font-size: 1.25rem; line-height: 1.7;">To empower individuals with comprehensive,
                        accurate, and accessible healthcare information, enabling them to make informed decisions about
                        their medical care and connect with the best healthcare providers in their community.</p>

                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 3rem;">
                        <div>
                            <div style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3>Compassion</h3>
                            <p>We approach healthcare with empathy and understanding, recognizing the personal nature of
                                medical decisions.</p>
                        </div>
                        <div>
                            <div style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3>Innovation</h3>
                            <p>We continuously improve our platform to provide the most relevant and up-to-date
                                healthcare information.</p>
                        </div>
                        <div>
                            <div style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3>Integrity</h3>
                            <p>We maintain the highest standards of accuracy and transparency in all the information we
                                provide.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Team -->
            <div class="content-section">
                <div class="section-title">
                    <h2>Our Team</h2>
                    <p>The dedicated professionals behind MediFind</p>
                </div>

                <div class="team-grid">
                    <!-- Team Member 1 -->
                    <div class="team-member">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Dr. Emily Parker">
                        <div class="team-info">
                            <h3>Dr. Emily Parker</h3>
                            <p>Chief Medical Officer</p>
                            <p>Board-certified physician with 15 years of clinical experience and healthcare
                                administration.</p>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Team Member 2 -->
                    <div class="team-member">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen">
                        <div class="team-info">
                            <h3>Michael Chen</h3>
                            <p>Chief Technology Officer</p>
                            <p>Technology leader with expertise in healthcare systems and patient-centered design.</p>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Team Member 3 -->
                    <div class="team-member">
                        <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Sarah Johnson">
                        <div class="team-info">
                            <h3>Sarah Johnson</h3>
                            <p>Director of Patient Experience</p>
                            <p>Patient advocate with a background in healthcare navigation and customer service.</p>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Team Member 4 -->
                    <div class="team-member">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="David Wilson">
                        <div class="team-info">
                            <h3>David Wilson</h3>
                            <p>Head of Data Analytics</p>
                            <p>Data scientist specializing in healthcare metrics and provider performance analysis.</p>
                            <div class="team-social">
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Partners -->
            <div class="content-section" style="background-color: var(--light-bg);">
                <div class="section-title">
                    <h2>Our Partners</h2>
                    <p>Trusted organizations we work with to improve healthcare access</p>
                </div>

                <div
                    style="display: flex; flex-wrap: wrap; justify-content: center; gap: 3rem; align-items: center; margin-top: 2rem;">
                    <img src="https://via.placeholder.com/150x80?text=Hospital+Network" alt="Hospital Network"
                        style="height: 60px; width: auto; filter: grayscale(100%); opacity: 0.7; transition: var(--transition);">
                    <img src="https://via.placeholder.com/150x80?text=Medical+Association" alt="Medical Association"
                        style="height: 60px; width: auto; filter: grayscale(100%); opacity: 0.7; transition: var(--transition);">
                    <img src="https://via.placeholder.com/150x80?text=Health+System" alt="Health System"
                        style="height: 60px; width: auto; filter: grayscale(100%); opacity: 0.7; transition: var(--transition);">
                    <img src="https://via.placeholder.com/150x80?text=Research+Center" alt="Research Center"
                        style="height: 60px; width: auto; filter: grayscale(100%); opacity: 0.7; transition: var(--transition);">
                </div>
            </div>
        </div>
    </div>
</main>

<!-- CTA Section -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Find Quality Healthcare?</h2>
            <p>Start your search for top-rated hospitals and doctors in your area today.</p>
            <div class="cta-buttons">
                <a href="{{ route('hospitals.view') }}" class="cta-btn primary">Find Hospitals</a>
                <a href="{{ route('doctors') }}" class="cta-btn secondary">Find Doctors</a>
            </div>
        </div>
    </div>
</section>


@endsection
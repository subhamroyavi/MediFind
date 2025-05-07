@extends('layouts.app')

@section('main-content')

 <!-- Hero Section -->
 <section class="hero"
        style="min-height: 60vh; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1581595219315-a187dd40c322?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover no-repeat;">
        <div class="hero-content">
            <h1>Emergency Medical Services</h1>
            <p>Immediate access to emergency contacts, ambulance services, and urgent care facilities when you need them
                most.</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="section">
        <div class="container">
            <!-- Emergency Contacts -->
            <div class="section-title">
                <h2>Emergency Contacts</h2>
                <p>Immediate help when you need it</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon" style="background-color: rgba(244, 67, 54, 0.1);">
                        <i class="fas fa-ambulance" style="color: var(--accent-color);"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Ambulance Services</h3>
                        <p>Immediate emergency medical transportation to the nearest hospital.</p>
                        <div class="emergency-number"
                            style="font-size: 1.5rem; font-weight: bold; color: var(--accent-color); margin: 1rem 0;">
                            <i class="fas fa-phone-alt"></i> 911
                        </div>
                        <button class="btn btn-primary" style="width: 100%;">Request Ambulance</button>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon" style="background-color: rgba(244, 67, 54, 0.1);">
                        <i class="fas fa-hospital" style="color: var(--accent-color);"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Emergency Departments</h3>
                        <p>24/7 emergency medical care at hospitals near you.</p>
                        <div class="emergency-number"
                            style="font-size: 1.5rem; font-weight: bold; color: var(--accent-color); margin: 1rem 0;">
                            <i class="fas fa-phone-alt"></i> 911
                        </div>
                        <a href="hospitals.html" class="btn btn-secondary" style="width: 100%; text-align: center;">Find
                            Hospitals</a>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon" style="background-color: rgba(244, 67, 54, 0.1);">
                        <i class="fas fa-first-aid" style="color: var(--accent-color);"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Poison Control</h3>
                        <p>Expert help for poison emergencies and information.</p>
                        <div class="emergency-number"
                            style="font-size: 1.5rem; font-weight: bold; color: var(--accent-color); margin: 1rem 0;">
                            <i class="fas fa-phone-alt"></i> 1-800-222-1222
                        </div>
                        <button class="btn btn-primary" style="width: 100%;">Call Now</button>
                    </div>
                </div>
            </div>

            <!-- Emergency Information -->
            <div class="section" style="padding: 2rem 0;">
                <div class="section-title">
                    <h2>Emergency Information</h2>
                </div>

                <div class="content-section">
                    <h3>What to Do in a Medical Emergency</h3>
                    <p>In case of a medical emergency, follow these steps:</p>
                    <ol style="margin: 1rem 0 1.5rem 1.5rem;">
                        <li style="margin-bottom: 0.5rem;"><strong>Stay calm</strong> and assess the situation.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Call 911</strong> or your local emergency number
                            immediately if the situation is life-threatening.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Provide clear information</strong> about the location
                            and nature of the emergency.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Follow instructions</strong> from the emergency
                            operator.</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Administer first aid</strong> if trained and if it's
                            safe to do so.</li>
                        <li><strong>Stay with the person</strong> until help arrives.</li>
                    </ol>

                    <h3>Emergency Preparedness</h3>
                    <p>Being prepared can save lives in an emergency:</p>
                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                        <div class="emergency-card">
                            <h3>First Aid Kit</h3>
                            <p>Keep a well-stocked first aid kit at home, in your car, and at work. Include bandages,
                                antiseptic, pain relievers, and any personal medications.</p>
                        </div>
                        <div class="emergency-card">
                            <h3>Emergency Contacts</h3>
                            <p>Keep a list of emergency contacts, including your doctor, local hospitals, and poison
                                control, in an easily accessible place.</p>
                        </div>
                        <div class="emergency-card">
                            <h3>Medical Information</h3>
                            <p>Have a list of medical conditions, allergies, and medications for each family member
                                readily available for emergency responders.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Urgent Care Centers -->
            <div class="section" style="padding: 2rem 0;">
                <div class="section-title">
                    <h2>Urgent Care Centers</h2>
                    <p>For non-life-threatening conditions that require immediate attention</p>
                </div>

                <div class="hospital-grid">
                    <!-- Urgent Care Center 1 -->
                    <div class="hospital-card">
                        <div class="hospital-image"
                            style="background-image: url('https://images.unsplash.com/photo-1584267385494-9fdd9a71ad75?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                        </div>
                        <div class="hospital-content">
                            <h3><a href="#">Downtown Urgent Care</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>456 Health St, Downtown</span>
                            </div>
                            <div class="specialties">
                                <h4>Services:</h4>
                                <div class="specialties-list">
                                    <span class="specialty-tag">Minor Injuries</span>
                                    <span class="specialty-tag">Illnesses</span>
                                    <span class="specialty-tag">X-rays</span>
                                </div>
                            </div>
                            <div class="hospital-cta">
                                <div class="emergency-number">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>(555) 123-7890</span>
                                </div>
                                <button class="view-details">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Urgent Care Center 2 -->
                    <div class="hospital-card">
                        <div class="hospital-image"
                            style="background-image: url('https://images.unsplash.com/photo-1581595219315-a187dd40c322?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                        </div>
                        <div class="hospital-content">
                            <h3><a href="#">City Urgent Care</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>789 Wellness Ave, Midtown</span>
                            </div>
                            <div class="specialties">
                                <h4>Services:</h4>
                                <div class="specialties-list">
                                    <span class="specialty-tag">Pediatrics</span>
                                    <span class="specialty-tag">Lab Tests</span>
                                    <span class="specialty-tag">Vaccinations</span>
                                </div>
                            </div>
                            <div class="hospital-cta">
                                <div class="emergency-number">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>(555) 456-7890</span>
                                </div>
                                <button class="view-details">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Urgent Care Center 3 -->
                    <div class="hospital-card">
                        <div class="hospital-image"
                            style="background-image: url('https://images.unsplash.com/photo-1579684453423-f84349ef60b0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                        </div>
                        <div class="hospital-content">
                            <h3><a href="#">24/7 Urgent Care</a></h3>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>123 Care Dr, Uptown</span>
                            </div>
                            <div class="specialties">
                                <h4>Services:</h4>
                                <div class="specialties-list">
                                    <span class="specialty-tag">24/7 Care</span>
                                    <span class="specialty-tag">Minor Surgery</span>
                                    <span class="specialty-tag">Physicals</span>
                                </div>
                            </div>
                            <div class="hospital-cta">
                                <div class="emergency-number">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>(555) 789-1234</span>
                                </div>
                                <button class="view-details">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
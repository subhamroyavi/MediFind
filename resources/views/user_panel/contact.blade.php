@extends('layouts.app')

@section('main-content')

<!-- Main Content -->
<main class="section">
    <div class="container">

        <div class="section-title">
            <h2>Contacts</h2>

            <!-- Breadcrumb Navigation -->
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>/</span>
                <a href="doctors.html">Contact</a>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                <!-- Contact Form -->
                <div class="contact-form">
                    <h2>Send Us a Message</h2>
                    <p>Have questions or feedback? Fill out the form below and we'll get back to you as soon as possible.</p>

                    <form style="margin-top: 2rem;">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number (Optional)</label>
                            <input type="tel" id="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" class="form-control" required>
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="feedback">Feedback</option>
                                <option value="technical">Technical Support</option>
                                <option value="partnership">Partnership Opportunities</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem;">Send Message</button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="contact-info">
                    <h2>Contact Information</h2>
                    <p>Reach out to us through any of these channels:</p>

                    <div style="margin-top: 2rem;">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h3>Our Office</h3>
                                <p>123 Healthcare Plaza<br>Suite 500<br>Cityville, ST 12345</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h3>Phone</h3>
                                <p>Main: (555) 123-4567<br>
                                    Support: (555) 123-4568<br>
                                    Fax: (555) 123-4569</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h3>Email</h3>
                                <p>General Inquiries: info@medifind.com<br>
                                    Support: support@medifind.com<br>
                                    Partnerships: partners@medifind.com</p>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 3rem;">
                        <h3>Business Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 10:00 AM - 4:00 PM<br>
                            Sunday: Closed</p>
                    </div>

                    <div style="margin-top: 2rem;">
                        <h3>Follow Us</h3>
                        <div class="social-links" style="justify-content: flex-start;">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="content-section" style="margin-top: 3rem;">
                <h2>Our Location</h2>
                <div class="map-container">
                    <!-- In a real application, this would be an embedded Google Map -->
                    <div style="width: 100%; height: 100%; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                        <p>Map would be displayed here</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="content-section" style="margin-top: 3rem;">
                <h2>Frequently Asked Questions</h2>

                <div style="margin-top: 2rem;">
                    <div class="faq-item" style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
                        <h3 style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                            How do I add my hospital or practice to MediFind?
                            <i class="fas fa-plus" style="color: var(--primary-color);"></i>
                        </h3>
                        <div class="faq-answer" style="display: none; margin-top: 1rem;">
                            <p>Healthcare providers can join our directory by completing the provider registration form on our website. After submission, our team will verify your credentials and contact you to complete the onboarding process. There may be a verification process to ensure the accuracy of the information.</p>
                        </div>
                    </div>

                    <div class="faq-item" style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
                        <h3 style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                            How often is the information on MediFind updated?
                            <i class="fas fa-plus" style="color: var(--primary-color);"></i>
                        </h3>
                        <div class="faq-answer" style="display: none; margin-top: 1rem;">
                            <p>We update our database continuously. Healthcare providers can update their information at any time through their provider portal. Our team also conducts regular audits to ensure information accuracy. If you notice any outdated information, please report it through our contact form.</p>
                        </div>
                    </div>

                    <div class="faq-item" style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
                        <h3 style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                            Is there a cost to use MediFind's services?
                            <i class="fas fa-plus" style="color: var(--primary-color);"></i>
                        </h3>
                        <div class="faq-answer" style="display: none; margin-top: 1rem;">
                            <p>MediFind is completely free for patients to use. Healthcare providers may have subscription options for enhanced listing features, but basic listings are free. We never charge patients for accessing information about healthcare providers or facilities.</p>
                        </div>
                    </div>

                    <div class="faq-item" style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
                        <h3 style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                            How can I leave a review for a healthcare provider?
                            <i class="fas fa-plus" style="color: var(--primary-color);"></i>
                        </h3>
                        <div class="faq-answer" style="display: none; margin-top: 1rem;">
                            <p>You can leave a review by visiting the provider's profile page and clicking on the "Write a Review" button. You'll need to create a free account to submit a review. All reviews are moderated to ensure they meet our community guidelines before being published.</p>
                        </div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="#" class="btn btn-secondary">View All FAQs</a>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
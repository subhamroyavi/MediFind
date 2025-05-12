@extends('layouts.app')

@section('main-content')

 <!-- Main Content -->
 <main class="section">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>/</span>
                <a href="profile.html">My Profile</a>
            </div>

            <div class="profile-header">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Profile Photo" class="profile-avatar" id="profileAvatar">
                <div>
                    <h1 id="profileName">Sarah Johnson</h1>
                    <p>Member since <span id="memberSince">January 2023</span></p>
                    <div class="profile-actions">
                        <button class="btn btn-primary" id="editProfileBtn">Edit Profile</button>
                        <button class="btn btn-secondary" id="cancelEditBtn" style="display: none;">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="profile-section">
                <h2>Personal Information</h2>
                
                <div class="profile-details" id="personalInfoView">
                    <div class="detail-item">
                        <label>Full Name</label>
                        <div class="value" id="viewFullName">Sarah Marie Johnson</div>
                    </div>
                    <div class="detail-item">
                        <label>Date of Birth</label>
                        <div class="value" id="viewDob">May 15, 1985</div>
                    </div>
                    <div class="detail-item">
                        <label>Gender</label>
                        <div class="value" id="viewGender">Female</div>
                    </div>
                    <div class="detail-item">
                        <label>Email</label>
                        <div class="value" id="viewEmail">sarah.johnson@example.com</div>
                    </div>
                    <div class="detail-item">
                        <label>Phone</label>
                        <div class="value" id="viewPhone">(555) 123-4567</div>
                    </div>
                    <div class="detail-item">
                        <label>Address</label>
                        <div class="value" id="viewAddress">123 Main St, Apt 4B<br>Cityville, ST 12345</div>
                    </div>
                </div>
                
                <form class="edit-form" id="personalInfoForm">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" class="form-control" value="Sarah Marie Johnson" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" class="form-control" value="1985-05-15" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" class="form-control" required>
                            <option value="female" selected>Female</option>
                            <option value="male">Male</option>
                            <option value="other">Other</option>
                            <option value="prefer-not-to-say">Prefer not to say</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" value="sarah.johnson@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" class="form-control" value="5551234567" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" class="form-control" rows="3" required>123 Main St, Apt 4B
Cityville, ST 12345</textarea>
                    </div>
                    <div class="upload-avatar">
                        <div>
                            <label for="avatarUpload">Profile Photo</label>
                            <input type="file" id="avatarUpload" accept="image/*" style="display: none;">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('avatarUpload').click()">Choose Image</button>
                        </div>
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Preview" class="avatar-preview" id="avatarPreview">
                    </div>
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" id="cancelPersonalEdit">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Medical Information Section -->
            <div class="profile-section">
                <h2>Medical Information</h2>
                
                <div id="medicalInfoView">
                    <div class="profile-details">
                        <div class="detail-item">
                            <label>Blood Type</label>
                            <div class="value" id="viewBloodType">A+</div>
                        </div>
                        <div class="detail-item">
                            <label>Allergies</label>
                            <div class="value" id="viewAllergies">Penicillin, Peanuts</div>
                        </div>
                        <div class="detail-item">
                            <label>Current Medications</label>
                            <div class="value" id="viewMedications">Lisinopril 10mg daily</div>
                        </div>
                    </div>
                    
                    <h3 style="margin-top: 2rem;">Medical History</h3>
                    <div id="medicalHistoryList">
                        <div class="medical-history-item">
                            <strong>Hypertension</strong> - Diagnosed 2018, controlled with medication
                        </div>
                        <div class="medical-history-item">
                            <strong>Appendectomy</strong> - 2002, no complications
                        </div>
                    </div>
                </div>
                
                <form class="edit-form" id="medicalInfoForm">
                    <div class="form-group">
                        <label for="bloodType">Blood Type</label>
                        <select id="bloodType" class="form-control" required>
                            <option value="">Select blood type</option>
                            <option value="A+" selected>A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="allergies">Allergies</label>
                        <textarea id="allergies" class="form-control" rows="2">Penicillin, Peanuts</textarea>
                    </div>
                    <div class="form-group">
                        <label for="medications">Current Medications</label>
                        <textarea id="medications" class="form-control" rows="2">Lisinopril 10mg daily</textarea>
                    </div>
                    
                    <h3 style="margin-top: 2rem;">Medical History</h3>
                    <div id="editMedicalHistory">
                        <div class="medical-history-item">
                            <div class="form-group">
                                <label>Condition</label>
                                <input type="text" class="form-control" value="Hypertension" required>
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" rows="2">Diagnosed 2018, controlled with medication</textarea>
                            </div>
                            <button type="button" class="btn btn-secondary" style="margin-top: 0.5rem;">Remove</button>
                        </div>
                        <div class="medical-history-item">
                            <div class="form-group">
                                <label>Condition</label>
                                <input type="text" class="form-control" value="Appendectomy" required>
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" rows="2">2002, no complications</textarea>
                            </div>
                            <button type="button" class="btn btn-secondary" style="margin-top: 0.5rem;">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addHistoryItem" style="margin-top: 1rem;">
                        <i class="fas fa-plus"></i> Add Medical History
                    </button>
                    
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" id="cancelMedicalEdit">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Emergency Contacts Section -->
            <div class="profile-section">
                <h2>Emergency Contacts</h2>
                
                <div id="emergencyContactsView">
                    <div class="profile-details">
                        <div class="detail-item">
                            <label>Primary Contact</label>
                            <div class="value">
                                <strong>Michael Johnson</strong> (Spouse)<br>
                                (555) 987-6543<br>
                                michael.johnson@example.com
                            </div>
                        </div>
                        <div class="detail-item">
                            <label>Secondary Contact</label>
                            <div class="value">
                                <strong>Emily Parker</strong> (Sister)<br>
                                (555) 456-7890<br>
                                emily.parker@example.com
                            </div>
                        </div>
                    </div>
                </div>
                
                <form class="edit-form" id="emergencyContactsForm">
                    <h3>Primary Emergency Contact</h3>
                    <div class="form-group">
                        <label for="primaryContactName">Name</label>
                        <input type="text" id="primaryContactName" class="form-control" value="Michael Johnson" required>
                    </div>
                    <div class="form-group">
                        <label for="primaryContactRelation">Relationship</label>
                        <input type="text" id="primaryContactRelation" class="form-control" value="Spouse" required>
                    </div>
                    <div class="form-group">
                        <label for="primaryContactPhone">Phone</label>
                        <input type="tel" id="primaryContactPhone" class="form-control" value="5559876543" required>
                    </div>
                    <div class="form-group">
                        <label for="primaryContactEmail">Email</label>
                        <input type="email" id="primaryContactEmail" class="form-control" value="michael.johnson@example.com">
                    </div>
                    
                    <h3 style="margin-top: 2rem;">Secondary Emergency Contact</h3>
                    <div class="form-group">
                        <label for="secondaryContactName">Name</label>
                        <input type="text" id="secondaryContactName" class="form-control" value="Emily Parker">
                    </div>
                    <div class="form-group">
                        <label for="secondaryContactRelation">Relationship</label>
                        <input type="text" id="secondaryContactRelation" class="form-control" value="Sister">
                    </div>
                    <div class="form-group">
                        <label for="secondaryContactPhone">Phone</label>
                        <input type="tel" id="secondaryContactPhone" class="form-control" value="5554567890">
                    </div>
                    <div class="form-group">
                        <label for="secondaryContactEmail">Email</label>
                        <input type="email" id="secondaryContactEmail" class="form-control" value="emily.parker@example.com">
                    </div>
                    
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" id="cancelEmergencyEdit">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Account Settings Section -->
            <div class="profile-section">
                <h2>Account Settings</h2>
                
                <div id="accountSettingsView">
                    <div class="profile-details">
                        <div class="detail-item">
                            <label>Password</label>
                            <div class="value">********</div>
                        </div>
                        <div class="detail-item">
                            <label>Account Status</label>
                            <div class="value">Active</div>
                        </div>
                        <div class="detail-item">
                            <label>Two-Factor Authentication</label>
                            <div class="value">Disabled</div>
                        </div>
                    </div>
                    
                    <div class="profile-actions" style="margin-top: 2rem;">
                        <button class="btn btn-secondary" id="changePasswordBtn">Change Password</button>
                        <button class="btn btn-secondary" id="enable2FABtn">Enable 2FA</button>
                        <button class="btn btn-danger" id="deleteAccountBtn">Delete Account</button>
                    </div>
                </div>
                
                <form class="edit-form" id="changePasswordForm">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                        <button type="button" class="btn btn-secondary" id="cancelPasswordChange">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Delete Account Modal -->
    <div id="deleteAccountModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>Delete Your Account</h2>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <p>All your data, including medical records and appointment history, will be permanently deleted.</p>
            
            <div class="form-group" style="margin-top: 1.5rem;">
                <label for="confirmDelete">Type "DELETE" to confirm</label>
                <input type="text" id="confirmDelete" class="form-control" required>
            </div>
            
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button class="btn btn-danger" id="confirmDeleteBtn">Delete Account</button>
                <button class="btn btn-secondary" id="cancelDeleteBtn">Cancel</button>
            </div>
        </div>
    </div>


@endsection
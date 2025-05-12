        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const mobileToggle = document.getElementById('mobile-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('main-content');
        const addHospitalBtn = document.getElementById('addHospitalBtn');
        const addHospitalModal = document.getElementById('addHospitalModal');
        const closeModal = document.getElementById('closeModal');
        const cancelHospital = document.getElementById('cancelHospital');
        const saveHospital = document.getElementById('saveHospital');
        const viewHospitalModal = document.getElementById('viewHospitalModal');
        const closeViewModal = document.getElementById('closeViewModal');
        const closeViewModalBtn = document.getElementById('closeViewModalBtn');
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notificationMessage');
        const closeNotification = document.getElementById('closeNotification');
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        // Mobile Sidebar Toggle
        mobileToggle.addEventListener('click', () => {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        // Close Sidebar
        const closeSidebar = () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        };

        sidebarClose.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        // Window Resize Handler
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });

        // Add Hospital Modal
        addHospitalBtn.addEventListener('click', () => {
            addHospitalModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        // Close Add Hospital Modal
        const closeAddModal = () => {
            addHospitalModal.classList.remove('active');
            document.body.style.overflow = '';
        };

        closeModal.addEventListener('click', closeAddModal);
        cancelHospital.addEventListener('click', closeAddModal);

        // Save Hospital
        saveHospital.addEventListener('click', () => {
            // Here you would normally validate and save the form data
            closeAddModal();
            showNotification('Hospital added successfully', 'success');
        });

        // View Hospital Modal
        document.querySelectorAll('.action-icon.view').forEach(icon => {
            icon.addEventListener('click', () => {
                viewHospitalModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        // Close View Hospital Modal
        const closeViewModalFunc = () => {
            viewHospitalModal.classList.remove('active');
            document.body.style.overflow = '';
        };

        closeViewModal.addEventListener('click', closeViewModalFunc);
        closeViewModalBtn.addEventListener('click', closeViewModalFunc);

        // Tab Switching
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');

                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Show Notification
        function showNotification(message, type = 'success') {
            notificationMessage.textContent = message;
            notification.className = 'notification';
            notification.classList.add(type, 'active');

            // Change icon based on type
            const icon = notification.querySelector('i');
            if (type === 'success') {
                icon.className = 'fas fa-check-circle';
            } else if (type === 'error') {
                icon.className = 'fas fa-exclamation-circle';
            } else if (type === 'warning') {
                icon.className = 'fas fa-exclamation-triangle';
            }

            // Auto hide after 4 seconds
            setTimeout(() => {
                notification.classList.remove('active');
            }, 4000);
        }

        // Close Notification
        closeNotification.addEventListener('click', () => {
            notification.classList.remove('active');
        });

        // Edit and Delete Actions
        document.querySelectorAll('.action-icon.edit').forEach(icon => {
            icon.addEventListener('click', function () {
                showNotification('Edit hospital functionality would open here', 'success');
            });
        });

        document.querySelectorAll('.action-icon.delete').forEach(icon => {
            icon.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this hospital?')) {
                    showNotification('Hospital deleted successfully', 'success');
                }
            });
        });

        // Initialize Chart (if needed on this page)
        document.addEventListener('DOMContentLoaded', function () {
            // You can initialize charts here if needed
        });

        // Sample data for hospitals (could be fetched from API in real app)
        const hospitals = [
            {
                id: 'HSP-001',
                name: 'City General Hospital',
                address: '123 Main St, New York, NY 10001',
                contact: '+1 (555) 123-4567',
                services: ['Emergency', 'ICU', 'Surgery', 'Radiology'],
                status: 'active'
            },
            {
                id: 'HSP-002',
                name: 'Metro Medical Center',
                address: '456 Oak Ave, Los Angeles, CA 90001',
                contact: '+1 (555) 987-6543',
                services: ['Emergency', 'ICU', 'Pediatrics', 'Orthopedics'],
                status: 'active'
            },
            {
                id: 'HSP-003',
                name: 'Central Health Institute',
                address: '789 Elm St, Chicago, IL 60007',
                contact: '+1 (555) 456-7890',
                services: ['Emergency', 'Cardiology', 'Neurology'],
                status: 'pending'
            },
            {
                id: 'HSP-004',
                name: 'Bay Area Medical',
                address: '321 Pine St, San Francisco, CA 94101',
                contact: '+1 (555) 789-0123',
                services: ['Emergency', 'Oncology', 'Maternity', 'Dental'],
                status: 'active'
            },
            {
                id: 'HSP-005',
                name: 'Sunshine Children\'s Hospital',
                address: '654 Beach Blvd, Miami, FL 33101',
                contact: '+1 (555) 234-5678',
                services: ['Pediatrics', 'Neonatology'],
                status: 'inactive'
            }
        ];

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            // In a real app, you would filter the hospitals array and update the table
            console.log('Searching for:', searchTerm);
        });
// DOM Elements
const sidebar = document.getElementById('sidebar');
const mobileToggle = document.getElementById('mobile-toggle');
const sidebarClose = document.getElementById('sidebar-close');
const overlay = document.getElementById('overlay');
const mainContent = document.getElementById('main-content');

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

// Initialize Chart
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.createElement('canvas');
    document.getElementById('registrationChart').appendChild(ctx);

    const data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
                label: 'Hospitals',
                data: [18, 25, 30, 22, 17, 20, 25, 30, 35, 28, 20, 15],
                backgroundColor: 'rgba(21, 101, 192, 0.2)',
                borderColor: '#1565c0',
                borderWidth: 2,
                tension: 0.4,
                pointBackgroundColor: '#1565c0'
            },
            {
                label: 'Doctors',
                data: [25, 32, 40, 35, 30, 45, 40, 50, 55, 45, 35, 28],
                backgroundColor: 'rgba(46, 125, 50, 0.2)',
                borderColor: '#2e7d32',
                borderWidth: 2,
                tension: 0.4,
                pointBackgroundColor: '#2e7d32'
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        boxWidth: 12,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#263238',
                    bodyColor: '#263238',
                    titleFont: {
                        size: 13,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 12,
                    borderColor: '#e0e0e0',
                    borderWidth: 1,
                    displayColors: true,
                    boxWidth: 8,
                    boxHeight: 8,
                    usePointStyle: true,
                    callbacks: {
                        labelPointStyle: function (context) {
                            return {
                                pointStyle: 'circle',
                                rotation: 0
                            };
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [2, 2]
                    }
                }
            }
        }
    };

    new Chart(ctx, config);
});

// Sample data for ambulance tracking (can be expanded)
const ambulanceData = [
    { id: 'AMB-001', driver: 'John Smith', status: 'Available', location: 'Downtown' },
    { id: 'AMB-002', driver: 'Maria Garcia', status: 'On Call', location: 'North District' },
    { id: 'AMB-003', driver: 'Robert Johnson', status: 'Maintenance', location: 'Central Garage' },
    { id: 'AMB-004', driver: 'Sarah Williams', status: 'Available', location: 'East Side' },
    { id: 'AMB-005', driver: 'Michael Brown', status: 'On Call', location: 'South District' }
];

// Sample data for hospitals
const hospitalData = [
    {
        id: 'HSP-001',
        name: 'City General Hospital',
        address: '123 Main St, New York, NY 10001',
        contact: '+1 (555) 123-4567',
        facilities: ['Emergency', 'ICU', 'Surgery', 'Radiology'],
        doctors: 45
    },
    {
        id: 'HSP-002',
        name: 'Metro Medical Center',
        address: '456 Oak Ave, Los Angeles, CA 90001',
        contact: '+1 (555) 987-6543',
        facilities: ['Emergency', 'ICU', 'Pediatrics', 'Orthopedics'],
        doctors: 62
    },
    {
        id: 'HSP-003',
        name: 'Central Health Institute',
        address: '789 Elm St, Chicago, IL 60007',
        contact: '+1 (555) 456-7890',
        facilities: ['Emergency', 'Cardiology', 'Neurology'],
        doctors: 38
    },
    {
        id: 'HSP-004',
        name: 'Bay Area Medical',
        address: '321 Pine St, San Francisco, CA 94101',
        contact: '+1 (555) 789-0123',
        facilities: ['Emergency', 'Oncology', 'Maternity', 'Dental'],
        doctors: 53
    }
];

// Sample data for doctors
const doctorData = [
    {
        id: 'DOC-001',
        name: 'Dr. James Wilson',
        specialization: 'Cardiology',
        hospital: 'City General Hospital',
        experience: '15 years',
        contact: '+1 (555) 111-2222'
    },
    {
        id: 'DOC-002',
        name: 'Dr. Emily Rodriguez',
        specialization: 'Neurology',
        hospital: 'Metro Medical Center',
        experience: '12 years',
        contact: '+1 (555) 222-3333'
    },
    {
        id: 'DOC-003',
        name: 'Dr. David Chen',
        specialization: 'Orthopedics',
        hospital: 'Central Health Institute',
        experience: '8 years',
        contact: '+1 (555) 333-4444'
    },
    {
        id: 'DOC-004',
        name: 'Dr. Sarah Johnson',
        specialization: 'Pediatrics',
        hospital: 'Bay Area Medical',
        experience: '10 years',
        contact: '+1 (555) 444-5555'
    }
];

// Function to show notifications
function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
        <span>${message}</span>
        <button class="close-notification"><i class="fas fa-times"></i></button>
    `;

    // Style the notification
    notification.style.position = 'fixed';
    notification.style.bottom = '20px';
    notification.style.right = '20px';
    notification.style.backgroundColor = type === 'success' ? '#4caf50' : '#f44336';
    notification.style.color = 'white';
    notification.style.padding = '12px 20px';
    notification.style.borderRadius = '4px';
    notification.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
    notification.style.display = 'flex';
    notification.style.alignItems = 'center';
    notification.style.gap = '10px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';

    // Add to DOM
    document.body.appendChild(notification);

    // Close button
    const closeButton = notification.querySelector('.close-notification');
    closeButton.style.background = 'none';
    closeButton.style.border = 'none';
    closeButton.style.color = 'white';
    closeButton.style.cursor = 'pointer';
    closeButton.style.marginLeft = 'auto';

    closeButton.addEventListener('click', () => {
        document.body.removeChild(notification);
    });

    // Auto remove after 4 seconds
    setTimeout(() => {
        if (document.body.contains(notification)) {
            document.body.removeChild(notification);
        }
    }, 4000);
}

// Example of showing notification on action
document.querySelectorAll('.action-icon.edit').forEach(icon => {
    icon.addEventListener('click', function () {
        // Here you would normally open an edit form
        showNotification('Editing hospital details', 'success');
    });
});

document.querySelectorAll('.action-icon.delete').forEach(icon => {
    icon.addEventListener('click', function () {
        // Here you would normally show a confirmation dialog
        showNotification('Please confirm deletion in the dialog', 'error');

        // Sample confirmation dialog could be implemented here
    });
});

// Toggle functionality for showing more hospital details
document.querySelectorAll('.hospital-name').forEach(hospital => {
    hospital.style.cursor = 'pointer';
    hospital.addEventListener('click', function () {
        // This would normally fetch detail data and show in a modal or expanded row
        showNotification('Loading hospital details...', 'success');
    });
});
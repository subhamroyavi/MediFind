// Tab functionality
document.querySelectorAll('.tab-link').forEach(tab => {
    tab.addEventListener('click', () => {
        // Remove active class from all tabs and content
        document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');
        
        // Add active class to clicked tab
        tab.classList.add('active');
        
        // Show corresponding content
        const tabId = tab.getAttribute('data-tab');
        document.getElementById(tabId).style.display = 'block';
    });
});

// Image gallery functionality
document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
    thumb.addEventListener('click', () => {
        // Remove active class from all thumbnails
        document.querySelectorAll('.gallery-thumbnail').forEach(t => t.classList.remove('active'));
        
        // Add active class to clicked thumbnail
        thumb.classList.add('active');
        
        // Update main image
        const mainImage = document.querySelector('.main-image');
        mainImage.src = thumb.getAttribute('data-full');
        mainImage.alt = thumb.alt;
    });
});

// Modal functionality
const modal = document.getElementById('bookingModal');
const modalBtns = document.querySelectorAll('.book-appointment');
const closeModal = document.querySelector('.modal-close');

modalBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        modal.style.display = 'flex';
    });
});

closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});
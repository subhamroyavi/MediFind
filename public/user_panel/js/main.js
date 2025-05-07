/**
 * MediFind - Main JavaScript File
 * Contains functionality for all pages
 */

document.addEventListener('DOMContentLoaded', function() {
   // Mobile menu toggle functionality
   const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const navMenu = document.getElementById('navMenu');

            if (mobileMenuToggle && navMenu) {
                mobileMenuToggle.addEventListener('click', function () {
                    navMenu.classList.toggle('active');
                    this.classList.toggle('active');

                    const icon = this.querySelector('i');
                    if (navMenu.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });

                // Close when clicking outside
                document.addEventListener('click', function (event) {
                    const isClickInsideNav = navMenu.contains(event.target);
                    const isClickOnToggle = mobileMenuToggle.contains(event.target);

                    if (!isClickInsideNav && !isClickOnToggle && navMenu.classList.contains('active')) {
                        navMenu.classList.remove('active');
                        mobileMenuToggle.classList.remove('active');
                        mobileMenuToggle.querySelector('i').classList.remove('fa-times');
                        mobileMenuToggle.querySelector('i').classList.add('fa-bars');
                    }
                });

                // Close when clicking a link
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', function () {
                        if (window.innerWidth <= 1024) {
                            navMenu.classList.remove('active');
                            mobileMenuToggle.classList.remove('active');
                            mobileMenuToggle.querySelector('i').classList.remove('fa-times');
                            mobileMenuToggle.querySelector('i').classList.add('fa-bars');
                        }
                    });
                });
            }

    
    // Set current year in footer
    const currentYear = document.getElementById('currentYear');
    if (currentYear) {
        currentYear.textContent = new Date().getFullYear();
    }
    
    // Initialize filter functionality on listing pages
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('active');
            // Here you would typically filter the results
            // For demo purposes, we'll just toggle the active class
        });
    });
    
    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    
    if (searchInput && searchBtn) {
        searchBtn.addEventListener('click', function() {
            performSearch(searchInput.value);
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch(this.value);
            }
        });
    }
    
    // Initialize interactive elements on detail pages
    initDetailPages();
    
    // Initialize form validation
    initForms();
});

/**
 * Perform search functionality
 */
function performSearch(query) {
    if (query.trim() !== '') {
        // In a real application, this would redirect to search results
        alert(`Searching for: ${query}`);
        // window.location.href = `search.html?q=${encodeURIComponent(query)}`;
    }
}

/**
 * Initialize detail page functionality
 */
function initDetailPages() {
    // Tabs functionality for detail pages
    const tabs = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
    
    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                this.classList.add('active');
                const target = this.getAttribute('data-tab');
                document.getElementById(target).classList.add('active');
            });
        });
    }
    
    // Gallery/image viewer functionality
    const galleryImages = document.querySelectorAll('.gallery-thumbnail');
    const mainImage = document.querySelector('.main-image');
    
    if (galleryImages.length > 0 && mainImage) {
        galleryImages.forEach(img => {
            img.addEventListener('click', function() {
                // Update main image source
                const newSrc = this.getAttribute('data-full');
                mainImage.src = newSrc;
                
                // Update active thumbnail
                galleryImages.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
    
    // Booking modal functionality
    const bookButtons = document.querySelectorAll('.book-appointment, .view-details');
    const bookingModal = document.getElementById('bookingModal');
    const closeModal = document.querySelector('.modal-close');
    
    if (bookButtons.length > 0 && bookingModal) {
        bookButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                bookingModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });
        
        closeModal.addEventListener('click', function() {
            bookingModal.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close modal when clicking outside
        bookingModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
}

/**
 * Initialize form validation
 */
function initForms() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = this.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    
                    // Add error message if not already present
                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('error-message')) {
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'error-message';
                        errorMsg.textContent = 'This field is required';
                        errorMsg.style.color = 'var(--accent-color)';
                        errorMsg.style.fontSize = '0.8rem';
                        errorMsg.style.marginTop = '0.25rem';
                        field.parentNode.insertBefore(errorMsg, field.nextSibling);
                    }
                } else {
                    field.classList.remove('error');
                    if (field.nextElementSibling && field.nextElementSibling.classList.contains('error-message')) {
                        field.nextElementSibling.remove();
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    
    // Remove error class when user starts typing
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        });
    });
}

/**
 * Helper function to load more content (for infinite scroll or pagination)
 */
function loadMoreContent(containerSelector, itemsToLoad = 6) {
    const container = document.querySelector(containerSelector);
    if (!container) return;
    
    // In a real app, this would fetch more data from an API
    // For demo, we'll just clone existing items
    const items = container.querySelectorAll('.hospital-card, .doctor-card');
    const initialCount = items.length;
    
    for (let i = 0; i < Math.min(itemsToLoad, initialCount); i++) {
        const clone = items[i].cloneNode(true);
        container.appendChild(clone);
    }
}

// Export functions for use in other modules if needed
export { performSearch, initDetailPages, initForms, loadMoreContent };


// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------



// ---------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------

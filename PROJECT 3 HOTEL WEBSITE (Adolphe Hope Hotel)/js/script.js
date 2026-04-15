// Adolphe HOPE Hotel - JavaScript

// Initialize hotel data in localStorage
function initHotelData() {
    const hotelData = {
        name: "Adolphe HOPE Hotel",
        tagline: "Fine Relax Place",
        location: "Huye District, Next to International Football Stadium, Rwanda",
        phone: "+250 728 390 015",
        email: "www.nayituriki.com@gmail.com",
        website: "www.nayituriki.com",
        services: ["Fine Dining", "Luxury Rooms", "Online Ordering", "Event Hosting", "24/7 Service", "Free WiFi"],
        currency: { usd: 1, frw: 1300 },
        year: "2024"
    };
    
    if (!localStorage.getItem('hotelData')) {
        localStorage.setItem('hotelData', JSON.stringify(hotelData));
    }
}

// Get hotel data helper
function getHotelData() {
    const data = localStorage.getItem('hotelData');
    return data ? JSON.parse(data) : null;
}

// Initialize on load
initHotelData();

document.addEventListener('DOMContentLoaded', function() {
    
    // Header scroll effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navWrapper = document.querySelector('.nav-wrapper');
    
    if (menuToggle && navWrapper) {
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.toggle('active');
            navWrapper.classList.toggle('active');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !navWrapper.contains(e.target)) {
                menuToggle.classList.remove('active');
                navWrapper.classList.remove('active');
            }
        });
    }
    
    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredInputs = form.querySelectorAll('[required]');
            
            requiredInputs.forEach(function(input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = 'var(--error)';
                } else {
                    input.style.borderColor = '';
                }
            });
            
            // Email validation
            const emailInput = form.querySelector('input[type="email"]');
            if (emailInput && emailInput.value) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailInput.value)) {
                    isValid = false;
                    emailInput.style.borderColor = 'var(--error)';
                }
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        // Clear error on input
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                this.style.borderColor = '';
            });
        });
    });
    
    // Order date - set minimum to today
    const dateInput = document.getElementById('order_date');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
    
    // Gallery item selection from URL
    const urlParams = new URLSearchParams(window.location.search);
    const item = urlParams.get('item');
    if (item && document.getElementById('menu_item')) {
        const select = document.getElementById('menu_item');
        const options = select.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].text.includes(item)) {
                select.selectedIndex = i;
                break;
            }
        }
    }
    
    // Language switcher
    const langLinks = document.querySelectorAll('.lang-dropdown a');
    langLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            const currentUrl = new URL(window.location.href);
            
            // Store language preference
            localStorage.setItem('preferred_lang', lang);
            
            // Here you would normally redirect to the translated page
            // For demo, we'll reload with language param
            if (currentUrl.searchParams.get('lang') !== lang) {
                currentUrl.searchParams.set('lang', lang);
                window.location.href = currentUrl.toString();
            }
        });
    });
    
    // Set active language in dropdown
    const preferredLang = localStorage.getItem('preferred_lang') || 'en';
    langLinks.forEach(function(link) {
        if (link.getAttribute('data-lang') === preferredLang) {
            link.classList.add('active');
        }
    });
});

// Smooth fade-in animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.feature-card, .gallery-item, .about-image').forEach(function(el) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.6s ease';
    observer.observe(el);
});
// Order Page Functionality

document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const dateInput = document.getElementById('order_date');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
    
    // Auto-select menu item from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const item = urlParams.get('item');
    if (item) {
        const select = document.getElementById('menu_item');
        if (select) {
            const options = select.options;
            for (let i = 0; i < options.length; i++) {
                if (options[i].text.includes(item) || options[i].value.includes(item)) {
                    select.selectedIndex = i;
                    break;
                }
            }
        }
    }
});

// Handle form submission
const orderForm = document.getElementById('orderForm');
if (orderForm) {
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Store in localStorage (for demo purposes)
        const orders = JSON.parse(localStorage.getItem('orders') || '[]');
        orders.push({
            full_name: formData.get('full_name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            menu_item: formData.get('menu_item'),
            address: formData.get('address'),
            order_date: formData.get('order_date'),
            created_at: new Date().toISOString()
        });
        localStorage.setItem('orders', JSON.stringify(orders));
        
        // Show success message
        const existingMsg = document.querySelector('.form-message');
        if (existingMsg) {
            existingMsg.remove();
        }
        
        const msg = document.createElement('div');
        msg.className = 'form-message success';
        msg.innerHTML = '<i class="fas fa-check-circle"></i> Order placed successfully! We will contact you shortly.';
        msg.style.display = 'block';
        
        this.insertBefore(msg, this.firstChild);
        
        // Reset form
        this.reset();
        
        // Scroll to message
        msg.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
}

// Auth Modal Functions
function openAuthModal(tab) {
    document.getElementById('authModal').classList.add('active');
    switchAuthTab(tab);
}

function closeAuthModal() {
    document.getElementById('authModal').classList.remove('active');
}

function switchAuthTab(tab) {
    if (tab === 'signup') {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('signupForm').style.display = 'block';
        document.getElementById('signupTab').classList.add('active');
        document.getElementById('loginTab').classList.remove('active');
    } else {
        document.getElementById('signupForm').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
        document.getElementById('loginTab').classList.add('active');
        document.getElementById('signupTab').classList.remove('active');
    }
}

// Close modal when clicking outside
const authModal = document.getElementById('authModal');
if (authModal) {
    authModal.addEventListener('click', function(e) {
        if (e.target === this) closeAuthModal();
    });
}
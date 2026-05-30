import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
    });
});

// Toast Notifications
window.showToast = function(message, type = 'info') {
    window.dispatchEvent(new CustomEvent('toast', { 
        detail: { message, type } 
    }));
};

// Dark Mode Toggle
window.toggleDarkMode = function() {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
};

// Initialize Dark Mode from localStorage
if (localStorage.getItem('darkMode') === 'true') {
    document.documentElement.classList.add('dark');
}

// Form Validation
window.validateForm = function(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;
    
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('ring-2', 'ring-red-500');
            isValid = false;
        } else {
            input.classList.remove('ring-2', 'ring-red-500');
        }
    });
    
    return isValid;
};

// AJAX Helper
window.makeRequest = async function(url, method = 'GET', data = null) {
    try {
        const options = {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            },
        };
        
        if (data && method !== 'GET') {
            options.body = JSON.stringify(data);
        }
        
        const response = await fetch(url, options);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('Request failed:', error);
        showToast('An error occurred. Please try again.', 'error');
        throw error;
    }
};

// Resume Editor
window.resumeEditor = {
    currentResume: null,
    
    init(resumeId) {
        this.currentResume = resumeId;
        this.setupEventListeners();
    },
    
    setupEventListeners() {
        // Add event listeners for resume editor
    },
    
    async saveResume() {
        showToast('Resume saved successfully!', 'success');
    },
};

// Portfolio Editor
window.portfolioEditor = {
    currentPortfolio: null,
    
    init(portfolioId) {
        this.currentPortfolio = portfolioId;
    },
    
    async savePortfolio() {
        showToast('Portfolio saved successfully!', 'success');
    },
};

console.log('Resume AI Builder initialized');

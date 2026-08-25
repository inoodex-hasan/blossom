// Global Modal Controls
function openInquiryModal() {
    var modal = document.getElementById('inquiry-modal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeInquiryModal() {
    var modal = document.getElementById('inquiry-modal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

// Global Mobile Menu Controls
var isMobileMenuOpen = false;
function toggleMobileMenu() {
    var mobileMenu = document.getElementById('mobile-menu');
    var bar1 = document.getElementById('bar1');
    var bar2 = document.getElementById('bar2');
    var bar3 = document.getElementById('bar3');

    isMobileMenuOpen = !isMobileMenuOpen;

    if (mobileMenu) {
        if (isMobileMenuOpen) {
            mobileMenu.classList.remove('hidden');
            if (bar1) bar1.style.transform = 'translateY(8px) rotate(45deg)';
            if (bar2) bar2.style.opacity = '0';
            if (bar3) bar3.style.transform = 'translateY(-8px) rotate(-45deg)';
        } else {
            mobileMenu.classList.add('hidden');
            if (bar1) bar1.style.transform = '';
            if (bar2) bar2.style.opacity = '1';
            if (bar3) bar3.style.transform = '';
        }
    }
}

function toggleProductsSubmenu(e) {
    if (e && e.stopPropagation) e.stopPropagation();
    var submenu = document.getElementById('products-submenu');
    var arrow = document.getElementById('products-arrow');
    if (submenu) submenu.classList.toggle('hidden');
    if (arrow) arrow.classList.toggle('rotate-180');
}

function scrollToTop(e) {
    if (e && e.preventDefault) e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Attach global aliases
window.openInquiryModal = openInquiryModal;
window.closeInquiryModal = closeInquiryModal;
window.toggleMobileMenu = toggleMobileMenu;
window.toggleProductsSubmenu = toggleProductsSubmenu;
window.scrollToTop = scrollToTop;
window.openModal = openInquiryModal;
window.closeModalFunc = closeInquiryModal;

document.addEventListener('DOMContentLoaded', function() {
    var inquiryForm = document.getElementById('inquiry-form');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var name = (document.getElementById('inquiry-name').value || '').trim();
            var company = (document.getElementById('inquiry-company').value || '').trim();
            var email = (document.getElementById('inquiry-email').value || '').trim();
            var phone = (document.getElementById('inquiry-phone').value || '').trim();
            var address = (document.getElementById('inquiry-address').value || '').trim();
            var companyDetails = (document.getElementById('inquiry-company-details').value || '').trim();
            var message = (document.getElementById('inquiry-message').value || '').trim();

            if (!name || !email || !phone || !message) {
                alert('Please fill in all required fields.');
                return;
            }

            var subject = encodeURIComponent('Inquiry from ' + name + (company ? ' - ' + company : ''));
            var body = encodeURIComponent(
                'Name: ' + name + '\n' +
                (company ? 'Company: ' + company + '\n' : '') +
                'Email: ' + email + '\n' +
                'Phone: ' + phone + '\n' +
                (address ? 'Address: ' + address + '\n' : '') +
                (companyDetails ? 'Company Details: ' + companyDetails + '\n' : '') +
                '\nMessage:\n' + message
            );

            window.location.href = 'mailto:sundryblossom@gmail.com?subject=' + subject + '&body=' + body;
        });
    }

    var contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var nameInput = document.getElementById('name');
            var name = nameInput && nameInput.value ? nameInput.value : 'there';
            alert('Thank you, ' + name + '! Your message has been sent successfully.');
            contactForm.reset();
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeInquiryModal();
    });

    var inquiryModal = document.getElementById('inquiry-modal');
    if (inquiryModal) {
        inquiryModal.addEventListener('click', function(e) {
            if (e.target === inquiryModal) closeInquiryModal();
        });
    }
});

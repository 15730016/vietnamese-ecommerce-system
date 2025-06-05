document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            // Toggle the menu visibility
            const isHidden = mobileMenu.style.display === 'none';
            mobileMenu.style.display = isHidden ? 'block' : 'none';
            
            // Update aria-expanded attribute
            mobileMenuButton.setAttribute('aria-expanded', isHidden);
        });
    }
});

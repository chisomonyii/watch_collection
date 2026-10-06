document.addEventListener('DOMContentLoaded', () => {
    // 1. Highlight hearts already saved in wishlist on page load
    let wishlist = JSON.parse(localStorage.getItem('wishlist_ids')) || [];
    
    document.querySelectorAll('.arrivals').forEach(card => {
        const id = card.getAttribute('data-id');
        const heart = card.querySelector('.wishlist-heart');
        
        if (wishlist.includes(id) && heart) {
            heart.classList.add('active');
            heart.style.background = '#f68b1e';
            heart.style.color = '#ffffff';
        }
    });

    // 2. Click handler for heart icons
    document.querySelectorAll('.wishlist-heart').forEach(heart => {
        heart.addEventListener('click', function (e) {
            e.stopPropagation();
            const card = this.closest('.arrivals');
            const watchId = card.getAttribute('data-id');

            let wishlist = JSON.parse(localStorage.getItem('wishlist_ids')) || [];

            if (wishlist.includes(watchId)) {
                // Remove from wishlist
                wishlist = wishlist.filter(id => id !== watchId);
                this.classList.remove('active');
                this.style.background = '#ffffff';
                this.style.color = '#f68b1e';
            } else {
                // Add to wishlist
                wishlist.push(watchId);
                this.classList.add('active');
                this.style.background = '#f68b1e';
                this.style.color = '#ffffff';
            }

            localStorage.setItem('wishlist_ids', JSON.stringify(wishlist));
        });
    });
});
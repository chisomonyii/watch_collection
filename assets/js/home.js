document.addEventListener('DOMContentLoaded', () => {
    // 1. Sync header badge on load
    updateWishlistBadge();

    // 2. Highlight saved hearts on load
    const saved = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
    document.querySelectorAll('.arrivals, .watch-card').forEach(card => {
        const id = String(card.getAttribute('data-id'));
        const heart = card.querySelector('.wishlist-heart');
        if (id && saved.includes(id) && heart) {
            heart.classList.add('active');
            heart.style.color = '#e74c3c';
        }
    });

    // 3. Attach click handler for heart icons
    document.querySelectorAll('.wishlist-heart').forEach(heart => {
        heart.addEventListener('click', function (e) {
            e.stopPropagation();
            const card = this.closest('.arrivals') || this.closest('.watch-card');
            if (!card) return;

            const watchId = String(card.getAttribute('data-id'));
            let wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];

            if (wishlist.includes(watchId)) {
                wishlist = wishlist.filter(id => id !== watchId);
                this.classList.remove('active');
                this.style.color = '#f68b1e';
            } else {
                wishlist.push(watchId);
                this.classList.add('active');
                this.style.color = '#e74c3c';
            }

            localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
            updateWishlistBadge();
        });
    });
});

function updateWishlistBadge() {
    const badge = document.getElementById('wishlist-count');
    if (badge) {
        const wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
        badge.textContent = wishlist.length;
        badge.style.display = wishlist.length > 0 ? 'inline-block' : 'none';
    }
}
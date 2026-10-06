// Get existing wishlist array from localStorage
function getWishlist() {
    return JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
}

// Add or remove watch ID from local storage
function toggleWishlist(watchId) {
    let wishlist = getWishlist();
    const index = wishlist.indexOf(watchId);

    if (index === -1) {
        wishlist.push(watchId);
    } else {
        wishlist.splice(index, 1);
    }

    localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
    updateWishlistBadge();
}

// Update the counter badge in header.php
function updateWishlistBadge() {
    const badge = document.getElementById('wishlist-count');
    if (badge) {
        const count = getWishlist().length;
        badge.textContent = count;
        badge.style.display = count > 0 ? 'inline-block' : 'none';
    }
}

const response = await fetch('/Watch_Collection/api/watches/batch', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ ids: watchIds })
});

document.addEventListener('DOMContentLoaded', updateWishlistBadge);
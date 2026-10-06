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

document.addEventListener('DOMContentLoaded', () => {
    // Target all wishlist heart icons across products
    const wishlistHearts = document.querySelectorAll('.wishlist-heart');

    wishlistHearts.forEach(heart => {
        heart.addEventListener('click', async (event) => {
            const heartBtn = event.currentTarget;
            const productContainer = heartBtn.closest('.arrivals') || heartBtn.closest('.product-card');

            // Extract product identifier (assuming data-id attribute on container or extracted details)
            const productId = productContainer ? productContainer.dataset.id : null;
            
            // Toggle active state locally
            const isLiked = heartBtn.classList.toggle('active');

            // Visual feedback update
            if (isLiked) {
                heartBtn.style.color = '#e74c3c'; // Liked state color
                heartBtn.setAttribute('title', 'Remove from wishlist');
            } else {
                heartBtn.style.color = '#f68b1e'; // Default state color
                heartBtn.setAttribute('title', 'Add to wishlist');
            }

            // Send request to backend (PHP/API Endpoint)
            try {
                const response = await fetch('/api/wishlist-toggle.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        action: isLiked ? 'add' : 'remove'
                    }),
                });

                const result = await response.json();

                if (!result.success) {
                    // Revert UI changes if backend request fails
                    heartBtn.classList.toggle('active');
                    heartBtn.style.color = isLiked ? '#f68b1e' : '#e74c3c';
                    console.error('Wishlist update failed:', result.message);
                }
            } catch (error) {
                console.error('Network or server error:', error);
                // Revert UI state on error
                heartBtn.classList.toggle('active');
                heartBtn.style.color = isLiked ? '#f68b1e' : '#e74c3c';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', async () => {
    const grid = document.getElementById('wishlist-grid');
    const emptyMsg = document.getElementById('empty-wishlist-msg');
    
    // Check if PHP already rendered cards on server-side
    const hasPhpItems = grid && grid.querySelectorAll('.watch-card').length > 0;
    if (hasPhpItems) return;

    // Fetch saved product IDs from localStorage
    const savedIds = JSON.parse(localStorage.getItem('wishlist_ids')) || [];

    if (savedIds.length === 0) {
        if (emptyMsg) emptyMsg.style.display = 'block';
        return;
    }

    try {
        // Send saved IDs to backend API to retrieve watch details
        const response = await fetch('/Watch_Collection/api/wishlist-items', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ids: savedIds })
        });

        const result = await response.json();

        if (result.success && result.data && result.data.length > 0) {
            if (emptyMsg) emptyMsg.style.display = 'none';

            grid.innerHTML = result.data.map(item => `
                <div class="watch-card" data-id="${item.id}">
                    <div class="wishlist-heart" title="Remove from wishlist" onclick="removeFromWishlist('${item.id}')">
                        ♥
                    </div>
                    <div class="watch-image">
                        <img src="/Watch_Collection/public/assets/Images/${item.image}" alt="${item.name}">
                    </div>
                    <h2 class="watch-name">${item.brand || ''}</h2>
                    <p class="watch-description">${item.name || ''}</p>
                    <div class="watch-price">₦${Number(item.price).toLocaleString()}</div>
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-number">${item.rating || '5.0'}</span>
                    </div>
                    ${item.tag ? `<span class="badge">${item.tag}</span>` : ''}
                    <button class="add-button">Add</button>
                </div>
            `).join('');
        } else {
            if (emptyMsg) emptyMsg.style.display = 'block';
        }
    } catch (err) {
        console.error('Error fetching wishlist products:', err);
        if (emptyMsg) emptyMsg.style.display = 'block';
    }
});

/**
 * Removes an item from localStorage and updates the DOM immediately
 * @param {string|number} id 
 */
function removeFromWishlist(id) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist_ids')) || [];
    
    // Filter out removed ID
    wishlist = wishlist.filter(item => String(item) !== String(id));
    localStorage.setItem('wishlist_ids', JSON.stringify(wishlist));

    // Remove item card directly from DOM
    const card = document.querySelector(`.watch-card[data-id="${id}"]`);
    if (card) {
        card.remove();
    }

    // Display empty message if no items remain
    const remainingCards = document.querySelectorAll('.watch-card');
    if (remainingCards.length === 0) {
        const grid = document.getElementById('wishlist-grid');
        if (grid) {
            grid.innerHTML = `
                <div class="empty-wishlist" id="empty-wishlist-msg">
                    <p>Your wishlist is currently empty.</p>
                </div>
            `;
        }
    }
}
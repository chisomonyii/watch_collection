// ==========================================
// WISHLIST HELPER FUNCTIONS
// ==========================================

// 1. Retrieve saved IDs array from localStorage using a single uniform key
function getWishlist() {
    return JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
}

// 2. Add or remove watch ID from local storage & sync badge
function toggleWishlist(watchId) {
    if (!watchId) return false;
    
    let wishlist = getWishlist();
    const stringId = String(watchId);
    const index = wishlist.indexOf(stringId);
    let isLiked = false;

    if (index === -1) {
        wishlist.push(stringId);
        isLiked = true;
    } else {
        wishlist.splice(index, 1);
        isLiked = false;
    }

    localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
    updateWishlistBadge();
    return isLiked;
}

// 3. Update the counter badge in header.php
function updateWishlistBadge() {
    const badge = document.getElementById('wishlist-count');
    if (badge) {
        const count = getWishlist().length;
        badge.textContent = count;
        badge.style.display = count > 0 ? 'inline-block' : 'none';
    }
}

// ==========================================
// HOME PAGE HEART CLICK & UI HIGHLIGHTING
// ==========================================

document.addEventListener('DOMContentLoaded', () => {
    // Sync badge count on load
    updateWishlistBadge();

    const wishlist = getWishlist();
    const wishlistHearts = document.querySelectorAll('.wishlist-heart');

    // Highlight hearts on page load based on localStorage
    document.querySelectorAll('.arrivals, .watch-card').forEach(card => {
        const id = card.getAttribute('data-id');
        const heart = card.querySelector('.wishlist-heart');
        if (id && wishlist.includes(String(id)) && heart) {
            heart.classList.add('active');
            heart.style.color = '#e74c3c';
            heart.setAttribute('title', 'Remove from wishlist');
        }
    });

    // Attach click listener to heart icons
    wishlistHearts.forEach(heart => {
        heart.addEventListener('click', (event) => {
            event.stopPropagation();
            const heartBtn = event.currentTarget;
            const productContainer = heartBtn.closest('.arrivals') || heartBtn.closest('.watch-card');

            const productId = productContainer ? productContainer.dataset.id : null;
            if (!productId) return;

            // Save/remove directly in LocalStorage
            const isLiked = toggleWishlist(productId);

            // Update UI visuals
            heartBtn.classList.toggle('active', isLiked);
            heartBtn.style.color = isLiked ? '#e74c3c' : '#f68b1e';
            heartBtn.setAttribute('title', isLiked ? 'Remove from wishlist' : 'Add to wishlist');
        });
    });
});

// ==========================================
// WISHLIST PAGE RENDERING & DELETION
// ==========================================

document.addEventListener('DOMContentLoaded', async () => {
    const grid = document.getElementById('wishlist-grid');
    const emptyMsg = document.getElementById('empty-wishlist-msg');

    // Skip API request if PHP already rendered wishlist items server-side
    const hasPhpItems = grid && grid.querySelectorAll('.watch-card').length > 0;
    if (hasPhpItems) return;

    const savedIds = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];

    if (!grid || savedIds.length === 0) {
        if (emptyMsg) emptyMsg.style.display = 'block';
        return;
    }

    try {
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
                    <div class="wishlist-heart active" title="Remove from wishlist" onclick="removeFromWishlist('${item.id}')" style="color: #e74c3c;">
                        ♥
                    </div>
                    <div class="watch-image">
                        <img src="/Watch_Collection/assets/Images/${item.image || item.image_url}" alt="${item.name}">
                    </div>
                    <h2 class="watch-name">${item.brand || item.collection_name || ''}</h2>
                    <p class="watch-description">${item.name || ''}</p>
                    <div class="watch-price">₦${Number(item.price || 0).toLocaleString()}</div>
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

function removeFromWishlist(id) {
    let wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
    wishlist = wishlist.filter(item => String(item) !== String(id));
    localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));

    const card = document.querySelector(`.watch-card[data-id="${id}"]`);
    if (card) card.remove();

    const remainingCards = document.querySelectorAll('.watch-card');
    if (remainingCards.length === 0) {
        const emptyMsg = document.getElementById('empty-wishlist-msg');
        if (emptyMsg) emptyMsg.style.display = 'block';
    }
}
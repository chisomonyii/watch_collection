<?php
?>

<button type="button" class="floating-cart" id="open-cart" title="Shopping Cart" aria-label="Open shopping cart" aria-controls="cart-drawer" aria-expanded="false">
    <i class="fa-solid fa-cart-shopping"></i>
    <span class="cart-count" id="cart-count">0</span>
</button>

<div class="cart-overlay" id="cart-overlay"></div>

<aside class="cart-drawer" id="cart-drawer" aria-hidden="true" aria-label="Shopping cart" inert>
    <div class="cart-drawer-header">
        <div class="cart-heading">
            <small class="brand-tag">THE ZEITH EXPERIENCE</small>
            <h2>Shopping Bag <span id="drawer-item-count">(0)</span></h2>
        </div>
        <button type="button" id="close-cart" class="cart-close" aria-label="Close cart">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="cart-content">
        <div class="cart-items" id="cart-items"></div>
        <div class="cart-empty-state" id="cart-empty-state">
            <div class="empty-cart-icon">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <h3>Your bag is waiting</h3>
            <p>Add a luxury timepiece to get started.</p>
        </div>
    </div>

    <div class="cart-drawer-footer">
        <div class="cart-subtotal-row">
            <span>Subtotal</span>
            <strong id="cart-subtotal">₦0.00</strong>
        </div>
        <p class="footer-note">Shipping and applicable fees are calculated at checkout.</p>
        <button type="button" id="checkout-button" class="checkout-button" disabled>
            Proceed to Checkout
            <i class="fa-solid fa-arrow-right"></i>
        </button>
        <button type="button" id="continue-shopping" class="continue-shopping">Continue Shopping</button>
    </div>
</aside>

<style>
:root {
    --zeith-orange: #f68b1e;
    --zeith-green: #003b2f;
    --zeith-light-green: #b8dfc5;
    --zeith-dark: #1f2937;
    --zeith-grey: #888888;
    --zeith-border: #eeeeee;
    --zeith-white: #ffffff;
}

#cart-drawer,
#cart-drawer *,
#cart-overlay,
#open-cart,
#open-cart * {
    box-sizing: border-box;
}

#open-cart.floating-cart {
    position: fixed;
    right: 30px;
    bottom: 30px;
    width: 65px;
    height: 65px;
    border: none;
    border-radius: 50%;
    background: var(--zeith-orange);
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 25px;
    cursor: pointer;
    z-index: 9997;
    box-shadow: 0 5px 20px rgba(0,0,0,.18);
    transition: .3s ease;
}

#open-cart.floating-cart:hover {
    background: var(--zeith-green);
    transform: translateY(-4px);
}

#open-cart .cart-count {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 23px;  /* Set explicit equal width */
    height: 23px; /* Set explicit equal height */
    padding: 0;   /* Remove padding so it stays a true square/circle */
    border-radius: 50%; /* Fully round */
    background: white;
    color: var(--zeith-orange);
    border: 1px solid var(--zeith-orange);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    pointer-events: none;
}

#cart-overlay.cart-overlay {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.48);
    z-index: 99998;
    opacity: 0;
    visibility: hidden;
    transition: opacity .35s ease, visibility .35s ease;
}

#cart-overlay.cart-overlay.active {
    opacity: 1;
    visibility: visible;
}

#cart-drawer.cart-drawer {
    position: fixed;
    top: 0;
    right: 0;
    width: 35.5%;
    min-width: 480px;
    max-width: 700px;
    height: 100vh;
    height: 100dvh;
    margin: 0;
    padding: 0;
    background: white;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: -8px 0 35px rgba(0,0,0,.08);
    transform: translateX(105%);
    visibility: hidden;
    transition: transform .4s cubic-bezier(.77,0,.175,1), visibility .4s ease;
}

#cart-drawer.cart-drawer.active {
    transform: translateX(0);
    visibility: visible;
}

#cart-drawer .cart-drawer-header {
    width: 100%;
    min-height: 135px;
    flex: 0 0 135px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    border-bottom: 1px solid var(--zeith-border);
    background: white;
}

#cart-drawer .cart-heading {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

#cart-drawer .brand-tag {
    color: var(--zeith-orange);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 1.5px;
    line-height: 1.3;
}

#cart-drawer .cart-drawer-header h2 {
    margin: 0;
    padding: 0;
    color: var(--zeith-green);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 25px;
    font-weight: 700;
    line-height: 1.2;
}

#cart-drawer .cart-drawer-header h2 span {
    color: #999999;
    font-size: 14px;
    font-weight: 600;
}

#cart-drawer .cart-close {
    width: 53px;
    height: 53px;
    flex-shrink: 0;
    border: none;
    border-radius: 50%;
    background: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #000000;
    font-size: 25px;
    cursor: pointer;
    transition: .3s ease;
}

#cart-drawer .cart-close:hover {
    background: var(--zeith-orange);
    color: white;
    transform: rotate(90deg);
}

#cart-drawer .cart-content {
    position: relative;
    flex: 1 1 auto;
    min-height: 0;
    width: 100%;
    padding: 0 30px;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #dddddd transparent;
}

#cart-drawer .cart-content::-webkit-scrollbar {
    width: 5px;
}

#cart-drawer .cart-content::-webkit-scrollbar-thumb {
    background: #dddddd;
    border-radius: 10px;
}

#cart-drawer .cart-empty-state {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

#cart-drawer .empty-cart-icon {
    color: #888888;
    font-size: 21px;
    margin-bottom: 23px;
}

#cart-drawer .cart-empty-state h3 {
    margin: 0 0 20px;
    color: var(--zeith-green);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 22px;
    font-weight: 700;
}

#cart-drawer .cart-empty-state p {
    margin: 0;
    color: #888888;
    font-family: Georgia, "Times New Roman", serif;
    font-size: 18px;
    line-height: 1.5;
}

#cart-drawer.has-items .cart-empty-state {
    display: none;
}

#cart-drawer .cart-items {
    display: flex;
    flex-direction: column;
    width: 100%;
}

#cart-drawer .cart-item {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    padding: 22px 4px;
    border-bottom: 1px solid var(--zeith-border);
}

#cart-drawer .cart-item-image {
    width: 110px;
    height: 140px;
    flex-shrink: 0;
    overflow: hidden;
    border-radius: 5px;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
}

#cart-drawer .cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

#cart-drawer .cart-item-image i {
    font-size: 32px;
    color: #aaa;
}

#cart-drawer .cart-item-details {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 7px;
}

#cart-drawer .cart-item-brand {
    color: #999999;
    font-family: Georgia, "Times New Roman", serif;
    font-size: 12px;
}

#cart-drawer .cart-item-name {
    margin: 0;
    color: var(--zeith-green);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 16px;
    font-weight: 700;
}

#cart-drawer .cart-item-price {
    color: var(--zeith-orange);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 17px;
    font-weight: 700;
}

#cart-drawer .cart-item-bottom {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-top: 8px;
}

#cart-drawer .quantity-control {
    height: 38px;
    display: flex;
    align-items: center;
    border: 1px solid #dddddd;
    border-radius: 7px;
    overflow: hidden;
}

#cart-drawer .quantity-control button {
    width: 35px;
    height: 100%;
    border: none;
    background: #f8f8f8;
    font-size: 15px;
    cursor: pointer;
    transition: .2s ease;
}

#cart-drawer .quantity-control button:hover {
    background: var(--zeith-orange);
    color: white;
}

#cart-drawer .quantity-control span {
    min-width: 36px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--zeith-dark);
    font-size: 13px;
    background: white;
}

#cart-drawer .remove-cart-item {
    border: none;
    background: transparent;
    color: #888888;
    font-size: 14px;
    text-decoration: underline;
    cursor: pointer;
    transition: .2s ease;
}

#cart-drawer .remove-cart-item:hover {
    color: var(--zeith-orange);
}

#cart-drawer .cart-drawer-footer {
    width: 100%;
    flex: 0 0 auto;
    padding: 25px 30px 22px;
    border-top: 1px solid var(--zeith-border);
    background: white;
}

#cart-drawer .cart-subtotal-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

#cart-drawer .cart-subtotal-row span {
    color: var(--zeith-dark);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 19px;
}

#cart-drawer .cart-subtotal-row strong {
    color: var(--zeith-green);
    font-family: Georgia, "Times New Roman", serif;
    font-size: 24px;
    font-weight: 700;
}

#cart-drawer .footer-note {
    margin: 0 0 16px;
    color: #888888;
    font-family: Georgia, "Times New Roman", serif;
    font-size: 13px;
    line-height: 1.5;
}

#cart-drawer .checkout-button {
    width: 100%;
    min-height: 62px;
    padding: 12px;
    border: none;
    border-radius: 7px;
    background: var(--zeith-orange);
    color: white;
    font-size: 17px;
    font-weight: 700;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    transition: background-color .3s ease, color .3s ease;
}

#cart-drawer .checkout-button:hover:not(:disabled) {
    background: var(--zeith-light-green);
    color: var(--zeith-green);
}

#cart-drawer .checkout-button:disabled {
    opacity: .5;
    cursor: not-allowed;
}

#cart-drawer .checkout-button i {
    font-size: 17px;
}

#cart-drawer .continue-shopping {
    display: block;
    margin: 16px auto 0;
    padding: 0;
    border: none;
    background: transparent;
    color: #111111;
    font-size: 15px;
    cursor: pointer;
    transition: .2s ease;
}

#cart-drawer .continue-shopping:hover {
    color: var(--zeith-orange);
}

@media screen and (min-width: 601px) and (max-width: 1024px) {
    #cart-drawer.cart-drawer {
        width: 58%;
        min-width: 0;
        max-width: 650px;
    }

    #cart-drawer .cart-drawer-header {
        padding: 25px;
    }

    #cart-drawer .cart-content {
        padding: 0 25px;
    }

    #cart-drawer .cart-drawer-footer {
        padding: 24px 25px;
    }

    #cart-drawer .cart-item {
        gap: 15px;
    }

    #cart-drawer .cart-item-image {
        width: 100px;
        height: 125px;
    }
}

@media screen and (max-width: 600px) {
    html,
    body {
        overflow-x: hidden;
    }

    #cart-drawer.cart-drawer,
    #cart-drawer.cart-drawer.active {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
        height: 100vh !important;
        height: 100dvh !important;
        margin: 0 !important;
        padding: 0 !important;
        border-radius: 0 !important;
        transform: translateX(100%);
        box-sizing: border-box !important;
        z-index: 99999 !important;
    }

    #cart-drawer.cart-drawer.active {
        transform: translateX(0) !important;
    }

    #cart-overlay.cart-overlay {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        height: 100dvh !important;
        z-index: 99998 !important;
    }

    #cart-drawer .cart-drawer-header,
    #cart-drawer .cart-content,
    #cart-drawer .cart-drawer-footer {
        width: 100% !important;
        box-sizing: border-box !important;
    }

}

@media screen and (max-width: 375px) {
    #cart-drawer .cart-drawer-header {
        padding: 20px;
    }

    #cart-drawer .brand-tag {
        font-size: 14px;
    }

    #cart-drawer .cart-drawer-header h2 {
        font-size: 24px;
    }

    #cart-drawer .cart-close {
        width: 48px;
        height: 48px;
    }

    #cart-drawer .cart-empty-state h3 {
        font-size: 24px;
    }

    #cart-drawer .cart-empty-state p {
        font-size: 18px;
    }

    #cart-drawer .cart-content {
        padding: 0 15px;
    }

    #cart-drawer .cart-item-image {
        width: 82px;
        height: 105px;
    }

    #cart-drawer .cart-drawer-footer {
        padding-left: 20px;
        padding-right: 20px;
    }

    #cart-drawer .checkout-button {
        min-height: 62px;
        font-size: 16px;
    }
    
}

@media screen and (max-width: 600px) and (max-height: 700px) {
    #cart-drawer .cart-drawer-header {
        flex-basis: 105px;
        min-height: 105px;
        padding: 15px 20px;
    }

    #cart-drawer .brand-tag {
        font-size: 13px;
    }

    #cart-drawer .cart-drawer-header h2 {
        font-size: 22px;
    }

    #cart-drawer .cart-empty-state h3 {
        font-size: 21px;
        margin-bottom: 15px;
    }

    #cart-drawer .cart-empty-state p {
        font-size: 16px;
    }

    #cart-drawer .cart-drawer-footer {
        padding: 13px 20px;
    }

    #cart-drawer .cart-subtotal-row {
        margin-bottom: 9px;
    }

    #cart-drawer .footer-note {
        margin-bottom: 9px;
    }

    #cart-drawer .checkout-button {
        min-height: 48px;
        font-size: 15px;
    }

    #cart-drawer .continue-shopping {
        margin-top: 10px;
        font-size: 14px;
    }
}

@media (prefers-reduced-motion: reduce) {
    #cart-drawer,
    #cart-overlay,
    #open-cart,
    #cart-drawer .cart-close {
        transition: none !important;
    }

}

</style>

<script>
(function () {
    if (window.zeithCartDrawerInitialized) return;
    window.zeithCartDrawerInitialized = true;

    function initializeZeithCart() {
        const openCart = document.getElementById("open-cart");
        const closeCart = document.getElementById("close-cart");
        const cartDrawer = document.getElementById("cart-drawer");
        const cartOverlay = document.getElementById("cart-overlay");
        const continueShopping = document.getElementById("continue-shopping");
        const cartCount = document.getElementById("cart-count");
        const drawerItemCount = document.getElementById("drawer-item-count");
        const checkoutButton = document.getElementById("checkout-button");
        const itemsContainer = document.getElementById("cart-items");
        const subtotalElement = document.getElementById("cart-subtotal");

        if (!openCart || !cartDrawer || !cartOverlay) return;

        function readStorage(key) {
            try {
                const value = JSON.parse(localStorage.getItem(key) || '[]');
                return Array.isArray(value) ? value : [];
            } catch {
                return [];
            }
        }

        function readCart() {
            return readStorage('zeith_cart').map(item => {
                if (item && typeof item === 'object') {
                    return {
                        ...item,
                        id: String(item.id ?? ''),
                        name: item.name || 'Luxury Watch',
                        brand: item.brand || 'ZEITH',
                        price: Number(item.price) || 0,
                        quantity: Math.max(1, Number(item.quantity) || 1),
                        stock: Number(item.stock) || 10,
                        image: item.image || ''
                    };
                }
                return {
                    id: String(item ?? ''),
                    name: 'Watch details unavailable',
                    brand: 'ZEITH',
                    price: 0,
                    image: '',
                    quantity: 1,
                    stock: 10
                };
            });
        }

        function saveCart(cart) {
            localStorage.setItem('zeith_cart', JSON.stringify(cart));
            renderCart();
            window.dispatchEvent(new Event('storage'));
        }

        function money(value) {
            return '₦' + Number(value || 0).toLocaleString('en-NG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function escapeHTML(value) {
            return String(value ?? '').replace(/[&<>"']/g, character => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            })[character]);
        }

        function renderCart() {
            if (!itemsContainer || !subtotalElement) return;

            const cart = readCart();
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            updateCartBadge(cart);

            if (cart.length === 0) {
                itemsContainer.innerHTML = '';
                cartDrawer.classList.remove("has-items");
                if (checkoutButton) checkoutButton.disabled = true;
            } else {
                cartDrawer.classList.add("has-items");
                if (checkoutButton) checkoutButton.disabled = false;

                itemsContainer.innerHTML = cart.map((item, index) => `
                    <article class="cart-item" data-index="${index}">
                        <div class="cart-item-image">
                            ${item.image
                                ? `<img src="${escapeHTML(item.image)}" alt="${escapeHTML(item.name)}">`
                                : '<i class="fa-regular fa-clock"></i>'}
                        </div>
                        <div class="cart-item-details">
                            <span class="cart-item-brand">${escapeHTML(item.brand || 'ZEITH')}</span>
                            <h3 class="cart-item-name">${escapeHTML(item.name)}</h3>
                            <div class="cart-item-price">${money(item.price)}</div>
                            <div class="cart-item-bottom">
                                <div class="quantity-control">
                                    <button type="button" data-action="decrease" aria-label="Decrease quantity">&minus;</button>
                                    <span>${item.quantity}</span>
                                    <button type="button" data-action="increase" aria-label="Increase quantity">+</button>
                                </div>
                                <button type="button" class="remove-cart-item" data-action="remove">Remove</button>
                            </div>
                        </div>
                    </article>
                `).join('');
            }

            subtotalElement.textContent = money(subtotal);
            if (drawerItemCount) drawerItemCount.textContent = `(${count})`;
        }

        function updateCartBadge(cart = readCart()) {
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);

            if (cartCount) {
                cartCount.textContent = count;
                cartCount.style.display = count > 0 ? 'flex' : 'none';
            }

            if (drawerItemCount) {
                drawerItemCount.textContent = `(${count})`;
            }
        }

        function showCart() {
            cartDrawer.classList.add("active");
            cartOverlay.classList.add("active");
            cartDrawer.removeAttribute("inert");
            cartDrawer.setAttribute("aria-hidden", "false");
            openCart.setAttribute("aria-expanded", "true");
            document.body.style.overflow = "hidden";

            renderCart();
            if (closeCart) closeCart.focus();
        }

        function hideCart() {
            if (!cartDrawer.classList.contains("active")) return;

            cartDrawer.classList.remove("active");
            cartOverlay.classList.remove("active");
            cartDrawer.setAttribute("inert", "");
            cartDrawer.setAttribute("aria-hidden", "true");
            openCart.setAttribute("aria-expanded", "false");
            document.body.style.overflow = "";
            openCart.focus();
        }

        openCart.addEventListener("click", showCart);
        if (closeCart) closeCart.addEventListener("click", hideCart);
        cartOverlay.addEventListener("click", hideCart);
        if (continueShopping) continueShopping.addEventListener("click", hideCart);

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape" && cartDrawer.classList.contains("active")) {
                hideCart();
            }
        });

        itemsContainer?.addEventListener('click', event => {
            const button = event.target.closest('[data-action]');
            if (!button) return;

            const row = button.closest('.cart-item');
            if (!row) return;

            const index = Number(row.dataset.index);
            const cart = readCart();
            const item = cart[index];

            if (!item) return;

            switch (button.dataset.action) {
                case 'increase': {
                    const stockLimit = Number(item.stock) || 10;
                    if (item.quantity + 1 > stockLimit) {
                        alert(`Sorry, we only have ${stockLimit} of this item in stock.`);
                        return;
                    }
                    item.quantity++;
                    break;
                }
                case 'decrease':
                    item.quantity--;
                    if (item.quantity <= 0) cart.splice(index, 1);
                    break;
                case 'remove':
                    cart.splice(index, 1);
                    break;
            }

            saveCart(cart);
        });

        checkoutButton?.addEventListener('click', () => {
            if (readCart().length === 0) return;
            window.location.href = '/Zeith/checkout';
        });

        window.addEventListener('storage', event => {
            if (!event.key || event.key === 'zeith_cart') {
                renderCart();
            }
        });

        renderCart();
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initializeZeithCart, { once: true });
    } else {
        initializeZeithCart();
    }
})();
</script>
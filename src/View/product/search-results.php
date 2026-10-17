<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Search Results for "<?= htmlspecialchars($keyword ?? '') ?>"</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-obsidian: #0b0f19;
            --card-obsidian: #131b2e;
            --accent-gold: #f68b1e;
            --text-light: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #1e293b;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-obsidian);
            color: var(--text-light);
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .search-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .search-header h1 {
            font-size: 2rem;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .search-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* PRODUCTS GRID */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        .product-card {
            background: var(--card-obsidian);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, border-color 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent-gold);
        }

        .product-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            background: #1e293b;
        }

        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .product-brand {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--accent-gold);
            margin-bottom: 6px;
            font-weight: 700;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 12px;
            text-decoration: none;
        }

        .product-title:hover {
            color: var(--accent-gold);
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-light);
            margin-top: auto;
            margin-bottom: 16px;
        }

        .btn-view {
            background: transparent;
            color: var(--text-light);
            border: 1px solid var(--border-color);
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-view:hover {
            background: var(--accent-gold);
            border-color: var(--accent-gold);
            color: #0b0f19;
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="search-header">
        <h1>Search Results</h1>
        <p>Showing watches matching &ldquo;<strong><?= htmlspecialchars($keyword ?? '') ?></strong>&rdquo;</p>
    </div>

    <div class="products-grid">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image'] ?? 'assets/images/placeholder.jpg') ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
                    <div class="product-info">
                        <span class="product-brand"><?= htmlspecialchars($product['brand'] ?? 'ZEITH') ?></span>
                        <a href="/Watch_Collection/product?id=<?= $product['id'] ?>" class="product-title"><?= htmlspecialchars($product['name']) ?></a>
                        <div class="product-price">₦<?= number_format($product['price'], 2) ?></div>
                        <a href="/Watch_Collection/product?id=<?= $product['id'] ?>" class="btn-view">View Timepiece</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                <i class="fa-solid fa-clock-rotate-left" style="font-size: 3rem; margin-bottom: 16px; color: var(--text-muted);"></i>
                <h3>No timepieces found</h3>
                <p>Try searching for a different brand, model name, or description keyword.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
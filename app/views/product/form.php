<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); $editing = !empty($product['id']); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $editing ? 'Edit' : 'Add'; ?> product | Product Desk</title>
    <style>
        :root { --ink: #17212b; --muted: #65727e; --paper: #f4f0e8; --panel: #fffdf8; --line: #ded7cb; --accent: #d97706; }
        * { box-sizing: border-box; } body { margin: 0; min-height: 100vh; padding: 44px 20px; background: linear-gradient(135deg, #fffaf0, var(--paper)); color: var(--ink); font: 16px/1.5 Georgia, serif; } main { width: min(100%, 680px); margin: auto; } h1 { margin: 0 0 26px; font-size: clamp(2rem, 6vw, 3.2rem); } .back { color: var(--accent); font: 700 .9rem Arial, sans-serif; text-decoration: none; } form { padding: 28px; border: 1px solid var(--line); border-radius: 10px; background: var(--panel); box-shadow: 0 12px 28px rgba(70, 55, 35, .08); } label { display: block; margin: 18px 0 7px; font-weight: 700; } label:first-child { margin-top: 0; } input, textarea { width: 100%; padding: 12px 14px; border: 1px solid var(--line); border-radius: 6px; background: #fff; color: var(--ink); font: inherit; } textarea { min-height: 130px; resize: vertical; } .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; } .error { margin-bottom: 18px; padding: 11px 13px; border-left: 4px solid #b42318; background: #fff0ed; color: #8a1c13; } .actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 26px; } .button { padding: 11px 16px; border: 0; border-radius: 6px; background: var(--accent); color: #fff; cursor: pointer; font: 700 .9rem Arial, sans-serif; text-decoration: none; } .cancel { background: transparent; border: 1px solid var(--line); color: var(--ink); } @media (max-width: 560px) { .grid { grid-template-columns: 1fr; gap: 0; } }
    </style>
</head>
<body>
<main><a class="back" href="<?= site_url('products'); ?>">&larr; Back to products</a><h1><?= $editing ? 'Edit product' : 'Add product'; ?></h1>
<?php if (!empty($error)): ?><div class="error" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>
<form method="post" action="<?= site_url($editing ? 'products/edit/' . (int) $product['id'] : 'products'); ?>">
    <label for="product_name">Product name</label><input id="product_name" name="product_name" maxlength="100" required value="<?= htmlspecialchars($product['product_name'] ?? ''); ?>">
    <label for="description">Description</label><textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? ''); ?></textarea>
    <div class="grid"><div><label for="price">Price</label><input id="price" name="price" type="number" min="0" step="0.01" required value="<?= htmlspecialchars($product['price'] ?? ''); ?>"></div><div><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" step="1" required value="<?= htmlspecialchars($product['quantity'] ?? ''); ?>"></div></div>
    <div class="actions"><a class="button cancel" href="<?= site_url('products'); ?>">Cancel</a><button class="button" type="submit"><?= $editing ? 'Save changes' : 'Create product'; ?></button></div>
</form></main>
</body>
</html>
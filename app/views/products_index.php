<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_admin = (($_SESSION['role'] ?? null) === 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Product Manager</title>
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #101d30;
            --panel: rgba(15, 23, 42, 0.9);
            --panel-strong: #0f172a;
            --line: rgba(148, 163, 184, 0.18);
            --primary: #7c3aed;
            --primary-strong: #5b21b6;
            --success: #22c55e;
            --danger: #ef4444;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --chip: rgba(148, 163, 184, 0.08);
            --row: rgba(15, 23, 42, 0.72);
            --row-alt: rgba(15, 23, 42, 0.54);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            padding: 32px 20px 48px;
            background:
                radial-gradient(circle at top left, rgba(124, 58, 237, 0.17), transparent 30%),
                linear-gradient(135deg, var(--bg) 0%, #0d1a2b 100%);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .wrap {
            max-width: 1200px;
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .title-wrap {
            display: grid;
            gap: 8px;
        }

        .eyebrow {
            font-size: 12px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
            color: #c4b5fd;
        }

        h1 {
            font-size: clamp(2rem, 2.5vw, 3rem);
            letter-spacing: -0.05em;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .user-pill {
            padding: 10px 12px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.76);
            border: 1px solid var(--line);
            color: var(--muted);
            font-size: 0.85rem;
        }

        .user-pill strong {
            color: var(--text);
        }

        .role-badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 999px;
            background: rgba(124, 58, 237, 0.18);
            border: 1px solid rgba(124, 58, 237, 0.4);
            color: #ddd6fe;
            font-size: 0.72rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 12px;
            padding: 11px 16px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.15s ease, opacity 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: white;
            box-shadow: 0 12px 26px rgba(124, 58, 237, 0.28);
        }

        .btn-muted {
            background: rgba(148, 163, 184, 0.08);
            color: var(--text);
            border: 1px solid var(--line);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.12);
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 0.8rem;
        }

        .msg {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            font-size: 0.9rem;
        }

        .msg.success {
            background: rgba(34, 197, 94, 0.12);
            border-color: rgba(74, 222, 128, 0.35);
            color: #bbf7d0;
        }

        .msg.error {
            background: rgba(239, 68, 68, 0.12);
            border-color: rgba(239, 68, 68, 0.35);
            color: #fecaca;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .stat {
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 18px 20px;
        }

        .stat-label {
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .stat-value {
            margin-top: 12px;
            font-size: clamp(1.4rem, 2vw, 2.2rem);
            font-weight: 700;
            letter-spacing: -0.05em;
        }

        .panel {
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid var(--line);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(2, 6, 23, 0.28);
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 820px;
        }

        th, td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid var(--line);
        }

        th {
            background: rgba(124, 58, 237, 0.12);
            color: #ddd6fe;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        tbody tr {
            background: var(--row);
        }

        tbody tr:nth-child(even) {
            background: var(--row-alt);
        }

        tbody tr:hover {
            background: rgba(124, 58, 237, 0.06);
        }

        td {
            color: var(--text);
            font-size: 0.96rem;
        }

        td.desc {
            color: #cbd5e1;
            max-width: 260px;
        }

        td.numeric {
            text-align: right;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .row-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        form.inline {
            display: inline;
        }

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 42px 18px;
            font-size: 1rem;
        }

        @media (max-width: 720px) {
            .stats {
                grid-template-columns: 1fr;
            }

            body {
                padding: 20px 14px 40px;
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div class="title-wrap">
                <span class="eyebrow">Inventory</span>
                <h1>Products</h1>
            </div>

            <div class="actions">
                <div class="user-pill">Signed in as <strong><?= htmlspecialchars($_SESSION['username'] ?? ''); ?></strong></div>
                <?php if (!$is_admin): ?>
                    <span class="role-badge">View only</span>
                <?php endif; ?>
                <?php if ($is_admin): ?>
                    <a class="btn btn-primary" href="<?= base_url('products/create'); ?>">+ Add Product</a>
                <?php endif; ?>
                <a class="btn btn-muted" href="<?= base_url('logout'); ?>">Logout</a>
            </div>
        </div>

        <?php if (!empty($success)): ?>
            <div class="msg success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="msg error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="stats">
            <div class="stat">
                <div class="stat-label">Total Products</div>
                <div class="stat-value"><?= count($products ?? []); ?></div>
            </div>
            <div class="stat">
                <div class="stat-label">Stock Value</div>
                <div class="stat-value">
                    ₱<?= number_format(array_sum(array_map(fn($p) => ((float)($p['price'] ?? 0) * (int)($p['quantity'] ?? 0)), $products ?? [])), 2); ?>
                </div>
            </div>
            <div class="stat">
                <div class="stat-label">Access</div>
                <div class="stat-value"><?= $is_admin ? 'Admin' : 'User'; ?></div>
            </div>
        </div>

        <div class="panel">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created</th>
                            <?php if ($is_admin): ?><th>Actions</th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($product['id']); ?></td>
                                    <td><?= htmlspecialchars($product['product_name']); ?></td>
                                    <td class="desc"><?= htmlspecialchars($product['description']); ?></td>
                                    <td class="numeric">₱<?= number_format((float) $product['price'], 2); ?></td>
                                    <td class="numeric"><?= htmlspecialchars($product['quantity']); ?></td>
                                    <td><?= htmlspecialchars($product['created_at'] ?? ''); ?></td>
                                    <?php if ($is_admin): ?>
                                        <td>
                                            <div class="row-actions">
                                                <a class="btn btn-muted btn-sm" href="<?= base_url('products/edit/' . $product['id']); ?>">Edit</a>
                                                <form class="inline" method="post" action="<?= base_url('products/delete/' . $product['id']); ?>" onsubmit="return confirm('Delete this product?');">
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= $is_admin ? 7 : 6; ?>" class="empty">
                                    <?= $is_admin ? 'No products yet. Click "Add Product" to create one.' : 'No products yet.'; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

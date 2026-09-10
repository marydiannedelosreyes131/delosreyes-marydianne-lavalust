<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_edit = ($mode === 'edit');
$form_action = $is_edit ? base_url('products/edit/' . $product['id']) : base_url('products/create');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? 'Edit Product' : 'Add Product'; ?> | Product Manager</title>
    <style>
        :root {
            --bg: #07111f;
            --panel: rgba(15, 23, 42, 0.9);
            --panel-border: rgba(148, 163, 184, 0.22);
            --primary: #7c3aed;
            --primary-strong: #5b21b6;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --input: rgba(15, 23, 42, 0.8);
            --danger: #f87171;
            --success: #4ade80;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 28px 20px;
            background:
                radial-gradient(circle at top left, rgba(124, 58, 237, 0.22), transparent 30%),
                linear-gradient(135deg, var(--bg) 0%, #0d1a2b 100%);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .card {
            width: min(100%, 620px);
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid var(--panel-border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 28px 80px rgba(2, 6, 23, 0.45);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 26px 28px 18px;
            border-bottom: 1px solid var(--panel-border);
        }

        .header h1 {
            font-size: clamp(1.6rem, 2vw, 2.2rem);
            letter-spacing: -0.04em;
        }

        .back-link {
            color: #c4b5fd;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
        }

        .body {
            padding: 26px 28px 28px;
        }

        .message {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }

        .message.error {
            background: rgba(248, 113, 113, 0.12);
            border-color: rgba(248, 113, 113, 0.35);
            color: #fecaca;
        }

        .message.success {
            background: rgba(34, 197, 94, 0.12);
            border-color: rgba(74, 222, 128, 0.35);
            color: #bbf7d0;
        }

        form {
            display: grid;
            gap: 16px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #dbeafe;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        input, textarea {
            width: 100%;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            color: var(--text);
            padding: 13px 14px;
            font-size: 0.97rem;
            resize: vertical;
            font-family: inherit;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        textarea {
            min-height: 120px;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: rgba(124, 58, 237, 0.9);
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.18);
        }

        .row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        button {
            margin-top: 6px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: white;
            font-weight: 700;
            padding: 14px 18px;
            font-size: 0.98rem;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.2s ease;
            box-shadow: 0 12px 28px rgba(124, 58, 237, 0.35);
        }

        button:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 640px) {
            .row {
                grid-template-columns: 1fr;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1><?= $is_edit ? 'Edit Product' : 'Add Product'; ?></h1>
            <a class="back-link" href="<?= base_url('products'); ?>">&larr; Back to list</a>
        </div>

        <div class="body">
            <?php if (!empty($error)): ?>
                <div class="message error"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="message success"><?= htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form method="post" action="<?= $form_action; ?>">
                <div class="field">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" maxlength="100" required value="<?= htmlspecialchars($product['product_name'] ?? ''); ?>" autofocus>
                </div>

                <div class="field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? ''); ?></textarea>
                </div>

                <div class="row">
                    <div class="field">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" required value="<?= htmlspecialchars($product['price'] ?? ''); ?>">
                    </div>

                    <div class="field">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" step="1" min="0" required value="<?= htmlspecialchars($product['quantity'] ?? ''); ?>">
                    </div>
                </div>

                <button type="submit"><?= $is_edit ? 'Save Changes' : 'Add Product'; ?></button>
            </form>
        </div>
    </div>
</body>
</html>

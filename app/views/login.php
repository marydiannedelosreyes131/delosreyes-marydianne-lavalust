<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | Product Desk</title>
    <style>
        :root { color-scheme: dark; --bg: #111827; --panel: #1f2937; --line: #374151; --accent: #f59e0b; --text: #f9fafb; --muted: #9ca3af; }
        * { box-sizing: border-box; } body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 24px; font: 16px/1.5 Georgia, serif; background: linear-gradient(135deg, #111827, #243447); color: var(--text); }
        main { width: min(100%, 420px); padding: 36px; background: var(--panel); border: 1px solid var(--line); border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,.3); }
        h1 { margin: 0 0 8px; font: 700 2rem/1.1 Georgia, serif; } p { color: var(--muted); margin: 0 0 28px; }
        label { display: block; margin: 18px 0 7px; font-weight: 700; } input { width: 100%; padding: 12px 14px; border: 1px solid var(--line); border-radius: 6px; background: #111827; color: var(--text); font: inherit; }
        button { width: 100%; margin-top: 24px; padding: 12px 16px; border: 0; border-radius: 6px; background: var(--accent); color: #111827; cursor: pointer; font-weight: 700; font: inherit; }
        .error { padding: 10px 12px; border-left: 3px solid #ef4444; background: rgba(239,68,68,.12); color: #fecaca; }
    </style>
</head>
<body>
<main>
    <h1>Product Desk</h1>
    <p>Sign in to manage the product inventory.</p>
    <?php if (!empty($error)): ?><div class="error" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" action="<?= site_url('login'); ?>">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required autocomplete="username">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        <button type="submit">Sign in</button>
    </form>
</main>
</body>
</html>
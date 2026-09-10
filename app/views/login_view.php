<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Product Manager</title>
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #0f1d2d;
            --panel: rgba(11, 22, 35, 0.9);
            --panel-border: rgba(148, 163, 184, 0.2);
            --primary: #7c3aed;
            --primary-strong: #5b21b6;
            --accent: #22c55e;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --input: rgba(15, 23, 42, 0.8);
            --danger: #f87171;
            --success: #4ade80;
            --warning: #fbbf24;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(circle at top left, rgba(124, 58, 237, 0.25), transparent 26%),
                radial-gradient(circle at bottom right, rgba(34, 197, 94, 0.16), transparent 22%),
                linear-gradient(135deg, var(--bg) 0%, #0b1727 100%);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .shell {
            width: min(100%, 960px);
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid var(--panel-border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(2, 6, 23, 0.55);
        }

        .brand-panel {
            padding: 48px 40px;
            background: linear-gradient(160deg, rgba(124, 58, 237, 0.18), rgba(15, 23, 42, 0.84));
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 18px;
        }

        .brand-tag {
            display: inline-flex;
            width: fit-content;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(124, 58, 237, 0.18);
            border: 1px solid rgba(124, 58, 237, 0.5);
            color: #ddd6fe;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
        }

        h1 {
            font-size: clamp(2rem, 3vw, 3rem);
            line-height: 1.05;
            letter-spacing: -0.05em;
        }

        .lead {
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 440px;
        }

        .badge-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.08);
            border: 1px solid rgba(148, 163, 184, 0.18);
            color: var(--text);
            font-size: 12px;
        }

        .form-panel {
            padding: 42px 32px;
            background: rgba(11, 22, 35, 0.88);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: min(100%, 360px);
        }

        .card-header {
            margin-bottom: 18px;
        }

        .card-header h2 {
            font-size: 1.8rem;
            letter-spacing: -0.04em;
        }

        .card-header p {
            margin-top: 8px;
            color: var(--muted);
            font-size: 0.94rem;
        }

        .message {
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 0.88rem;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .message.error {
            background: rgba(248, 113, 113, 0.12);
            border-color: rgba(248, 113, 113, 0.35);
            color: #fecaca;
        }

        .message.info {
            background: rgba(59, 130, 246, 0.12);
            border-color: rgba(59, 130, 246, 0.35);
            color: #bfdbfe;
        }

        .message.success {
            background: rgba(34, 197, 94, 0.12);
            border-color: rgba(74, 222, 128, 0.35);
            color: #bbf7d0;
        }

        form {
            display: grid;
            gap: 14px;
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

        input {
            width: 100%;
            background: var(--input);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            color: var(--text);
            padding: 13px 14px;
            font-size: 0.98rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: rgba(124, 58, 237, 0.9);
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.18);
        }

        button {
            margin-top: 8px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: white;
            font-weight: 700;
            padding: 14px 16px;
            font-size: 0.98rem;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.2s ease;
            box-shadow: 0 12px 28px rgba(124, 58, 237, 0.35);
        }

        button:hover {
            transform: translateY(-1px);
        }

        .footer-link {
            margin-top: 18px;
            color: var(--muted);
            text-align: center;
            font-size: 0.92rem;
        }

        .footer-link a {
            color: #c4b5fd;
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 760px) {
            .shell {
                grid-template-columns: 1fr;
            }

            .brand-panel {
                padding: 32px 24px 20px;
            }

            .form-panel {
                padding: 24px 20px 32px;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="brand-panel">
            <span class="brand-tag">Product Manager</span>
            <h1>Keep your inventory moving.</h1>
            <p class="lead">Manage your stock, monitor records, and keep your daily operations organized from one clean dashboard.</p>
            <div class="badge-row">
                <span class="badge">Fast workflow</span>
                <span class="badge">Secure access</span>
                <span class="badge">Track products</span>
            </div>
        </div>

        <div class="form-panel">
            <div class="card">
                <div class="card-header">
                    <h2>Welcome back</h2>
                    <p>Sign in to manage your products.</p>
                </div>

                <?php if (!empty($denied)): ?>
                    <div class="message info">Please log in to continue.</div>
                <?php endif; ?>
                <?php if (!empty($registered)): ?>
                    <div class="message success">Account created. You can now log in.</div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="message error"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('login'); ?>">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" autocomplete="username" required autofocus>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" autocomplete="current-password" required>
                    </div>

                    <button type="submit">Log In</button>
                </form>

                <div class="footer-link">
                    Don't have an account? <a href="<?= base_url('register'); ?>">Register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

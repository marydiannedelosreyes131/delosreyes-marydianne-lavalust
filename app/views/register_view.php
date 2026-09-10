<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Product Manager</title>
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #0f1d2d;
            --panel: rgba(11, 22, 35, 0.9);
            --panel-border: rgba(148, 163, 184, 0.2);
            --primary: #7c3aed;
            --primary-strong: #5b21b6;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --input: rgba(15, 23, 42, 0.8);
            --danger: #f87171;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(circle at top left, rgba(124, 58, 237, 0.25), transparent 26%),
                radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.17), transparent 20%),
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

        .feature-list {
            display: grid;
            gap: 10px;
            margin-top: 8px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            color: #dfe7f3;
        }

        .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a78bfa, #34d399);
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
            <h1>Build your next launch.</h1>
            <p class="lead">Create secure access, keep your inventory organized, and track everything that matters for your business.</p>

            <div class="feature-list">
                <div class="feature"><span class="dot"></span> Manage products in one place</div>
                <div class="feature"><span class="dot"></span> Keep teams organized and efficient</div>
                <div class="feature"><span class="dot"></span> Fast onboarding with secure login</div>
            </div>
        </div>

        <div class="form-panel">
            <div class="card">
                <div class="card-header">
                    <h2>Create an account</h2>
                    <p>Register to manage products.</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="message error"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('register'); ?>">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" autocomplete="username" required autofocus>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" autocomplete="email" required>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" minlength="6" required>
                    </div>

                    <button type="submit">Register</button>
                </form>

                <div class="footer-link">
                    Already have an account? <a href="<?= base_url('login'); ?>">Log in</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

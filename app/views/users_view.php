<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$user_count = count($users ?? []);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | LavaLust</title>
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ember: #ed5b2a;
            --ember-soft: #ff8a56;
            --ink: #f5f1eb;
            --muted: #92908d;
            --page: #101112;
            --panel: #17191a;
            --panel-raised: #1d2021;
            --line: rgba(255, 255, 255, .09);
            --mono: 'DM Mono', monospace;
            --sans: 'Manrope', sans-serif;
        }

        * { box-sizing: border-box; }
        html { background: var(--page); }
        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            background: radial-gradient(circle at 100% 0, rgba(237, 91, 42, .12), transparent 28rem), var(--page);
            font-family: var(--sans);
        }
        body::before {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image: linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 56px 56px;
            content: '';
            mask-image: linear-gradient(to bottom, black, transparent 78%);
            pointer-events: none;
        }
        .layout { display: grid; grid-template-columns: 228px minmax(0, 1fr); min-height: 100vh; }
        aside { display: flex; flex-direction: column; padding: 30px 18px; border-right: 1px solid var(--line); background: rgba(16, 17, 18, .82); }
        .brand { display: flex; align-items: center; gap: 10px; margin: 0 10px 58px; color: var(--ink); text-decoration: none; font-size: 14px; font-weight: 800; letter-spacing: .02em; }
        .brand-mark { display: grid; width: 32px; height: 32px; place-items: center; color: #17110e; background: var(--ember); border-radius: 8px; font-size: 17px; }
        .eyebrow { margin: 0 12px 12px; color: #646463; font-family: var(--mono); font-size: 10px; letter-spacing: .14em; text-transform: uppercase; }
        nav { display: grid; gap: 5px; }
        nav a { display: flex; align-items: center; gap: 12px; padding: 11px 12px; border-left: 2px solid transparent; color: var(--muted); font-size: 13px; text-decoration: none; transition: .2s ease; }
        nav a:hover, nav a.active { border-left-color: var(--ember); color: var(--ink); background: rgba(237, 91, 42, .1); }
        .nav-icon { width: 18px; color: currentColor; font-size: 16px; text-align: center; }
        .aside-foot { margin-top: auto; padding: 15px 12px 0; border-top: 1px solid var(--line); color: #666665; font-family: var(--mono); font-size: 10px; line-height: 1.6; }
        main { width: min(1180px, 100%); padding: 56px clamp(24px, 5vw, 72px) 72px; }
        .topbar { display: flex; align-items: flex-start; justify-content: space-between; gap: 24px; margin-bottom: 42px; }
        .kicker { margin: 0 0 10px; color: var(--ember-soft); font-family: var(--mono); font-size: 11px; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(2rem, 4vw, 3.3rem); font-weight: 800; letter-spacing: -.055em; line-height: 1; }
        .intro { max-width: 460px; margin: 13px 0 0; color: var(--muted); font-size: 14px; line-height: 1.65; }
        .status { display: inline-flex; align-items: center; gap: 8px; padding: 9px 12px; border: 1px solid var(--line); color: var(--muted); font-family: var(--mono); font-size: 11px; white-space: nowrap; }
        .status::before { width: 6px; height: 6px; border-radius: 50%; background: #72c59a; box-shadow: 0 0 12px #72c59a; content: ''; }
        .stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; margin-bottom: 30px; }
        .stat { padding: 18px 20px; border: 1px solid var(--line); background: rgba(23, 25, 26, .75); }
        .stat-label { color: var(--muted); font-size: 11px; text-transform: uppercase; letter-spacing: .08em; }
        .stat-value { margin-top: 8px; color: var(--ink); font-family: var(--mono); font-size: 25px; }
        .directory { overflow: hidden; border: 1px solid var(--line); background: var(--panel); box-shadow: 0 25px 70px rgba(0,0,0,.18); }
        .directory-head { display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 20px 22px; border-bottom: 1px solid var(--line); }
        .directory-title { margin: 0; font-size: 15px; font-weight: 700; }
        .directory-count { margin-left: 8px; color: var(--muted); font-family: var(--mono); font-size: 11px; font-weight: 400; }
        .search { display: flex; align-items: center; gap: 9px; width: min(250px, 42%); padding: 9px 11px; border: 1px solid var(--line); background: var(--panel-raised); color: var(--muted); }
        .search svg { flex: 0 0 auto; }
        .search input { width: 100%; border: 0; outline: 0; color: var(--ink); background: transparent; font: 12px var(--sans); }
        .search input::placeholder { color: #6f706e; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; min-width: 650px; border-collapse: collapse; }
        th { padding: 14px 22px; color: #777876; font-family: var(--mono); font-size: 10px; font-weight: 400; letter-spacing: .1em; text-align: left; text-transform: uppercase; }
        td { padding: 16px 22px; border-top: 1px solid var(--line); color: #c5c3be; font-size: 13px; }
        tbody tr { transition: background .18s ease; }
        tbody tr:hover { background: rgba(255,255,255,.035); }
        .person { display: flex; align-items: center; gap: 12px; min-width: 190px; }
        .avatar { display: grid; width: 34px; height: 34px; flex: 0 0 34px; place-items: center; border: 1px solid rgba(237,91,42,.35); border-radius: 50%; color: var(--ember-soft); background: rgba(237,91,42,.1); font-family: var(--mono); font-size: 11px; }
        .name { color: var(--ink); font-weight: 700; }
        .email { color: #aaa9a5; }
        .username, .id { color: var(--muted); font-family: var(--mono); font-size: 12px; }
        .id { color: #777876; }
        .empty { padding: 48px 22px; color: var(--muted); text-align: center; }
        .no-results { display: none; padding: 28px; color: var(--muted); font-size: 13px; text-align: center; }
        @media (max-width: 720px) {
            .layout { display: block; }
            aside { display: block; padding: 18px 16px; border-right: 0; border-bottom: 1px solid var(--line); }
            .brand { margin: 0 0 18px; }
            .eyebrow, .aside-foot { display: none; }
            nav { display: flex; gap: 4px; overflow-x: auto; }
            nav a { flex: 0 0 auto; padding: 9px 11px; border-left: 0; border-bottom: 2px solid transparent; }
            nav a:hover, nav a.active { border-bottom-color: var(--ember); }
            main { padding: 36px 18px 48px; }
            .topbar { display: block; margin-bottom: 30px; }
            .status { margin-top: 20px; }
            .stats { gap: 8px; }
            .stat { padding: 14px 12px; }
            .stat-label { font-size: 9px; }
            .stat-value { font-size: 20px; }
            .directory-head { align-items: flex-start; flex-direction: column; }
            .search { width: 100%; }
            th, td { padding-right: 16px; padding-left: 16px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside>
        <a class="brand" href="<?= htmlspecialchars(base_url()); ?>">
            <span class="brand-mark">L</span>
            <span>LavaLust</span>
        </a>
        <p class="eyebrow">Workspace</p>
        <nav aria-label="Main navigation">
            <a href="<?= htmlspecialchars(base_url()); ?>"><span class="nav-icon">⌂</span>Overview</a>
            <a class="active" href="<?= htmlspecialchars(base_url('users')); ?>" aria-current="page"><span class="nav-icon">◎</span>Users</a>
        </nav>
        <div class="aside-foot">LAVALUST / ADMIN<br>DIRECTORY 01</div>
    </aside>

    <main>
        <header class="topbar">
            <div>
                <p class="kicker">Workspace / People</p>
                <h1>Users</h1>
                <p class="intro">A clear view of everyone with a place in this application.</p>
            </div>
            <span class="status">SYSTEM ONLINE</span>
        </header>

        <section class="stats" aria-label="User summary">
            <div class="stat"><div class="stat-label">Total members</div><div class="stat-value"><?= $user_count; ?></div></div>
            <div class="stat"><div class="stat-label">Directory state</div><div class="stat-value">OPEN</div></div>
            <div class="stat"><div class="stat-label">Last synced</div><div class="stat-value">NOW</div></div>
        </section>

        <section class="directory" aria-label="Users list">
            <div class="directory-head">
                <h2 class="directory-title">All members <span class="directory-count"><?= $user_count; ?> records</span></h2>
                <label class="search" for="user-search">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg>
                    <input id="user-search" type="search" placeholder="Search directory" autocomplete="off">
                </label>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr><th scope="col">Member</th><th scope="col">Email</th><th scope="col">Username</th><th scope="col">Member ID</th></tr>
                    </thead>
                    <tbody id="user-rows">
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <?php $initials = strtoupper(substr($user['firstname'], 0, 1) . substr($user['lastname'], 0, 1)); ?>
                            <tr data-search="<?= htmlspecialchars(strtolower($user['firstname'] . ' ' . $user['lastname'] . ' ' . $user['email'] . ' ' . $user['username'])); ?>">
                                <td><div class="person"><span class="avatar"><?= htmlspecialchars($initials); ?></span><span class="name"><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></span></div></td>
                                <td class="email"><?= htmlspecialchars($user['email']); ?></td>
                                <td class="username">@<?= htmlspecialchars($user['username']); ?></td>
                                <td class="id">#<?= htmlspecialchars($user['id']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="empty">No users found in the directory.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="no-results" id="no-results">No members match that search.</div>
        </section>
    </main>
</div>
<script>
    const search = document.getElementById('user-search');
    const rows = document.querySelectorAll('#user-rows tr[data-search]');
    const noResults = document.getElementById('no-results');

    search.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();
        let visibleRows = 0;
        rows.forEach(function (row) {
            const isVisible = row.dataset.search.includes(query);
            row.style.display = isVisible ? '' : 'none';
            visibleRows += isVisible ? 1 : 0;
        });
        noResults.style.display = rows.length && !visibleRows ? 'block' : 'none';
    });
</script>
</body>
</html>

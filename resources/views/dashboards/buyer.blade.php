<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard — AnoKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink:     #1a1209;
            --paper:   #f5f0e8;
            --cream:   #ede8dc;
            --amber:   #c8862a;
            --amber-light: #e8a84a;
            --muted:   #7a6e5f;
            --danger:  #b94040;
            --success: #3a7d44;
            --border:  #d4cdc0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
        }

        .layout { display: flex; min-height: 100vh; }

        .sidebar {
            width: 240px;
            background: var(--ink);
            color: var(--paper);
            padding: 2rem 0;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--amber-light);
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid #333;
            letter-spacing: -0.5px;
        }

        .sidebar-brand span { display: block; font-size: 0.7rem; font-family: 'DM Sans', sans-serif; color: var(--muted); font-weight: 300; letter-spacing: 2px; text-transform: uppercase; margin-top: 2px; }

        .sidebar-nav { padding: 1.5rem 0; flex: 1; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: #a09585;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            transition: all 0.2s;
        }

        .nav-item:hover, .nav-item.active {
            color: var(--paper);
            background: rgba(200, 134, 42, 0.15);
            border-right: 3px solid var(--amber);
        }

        .nav-icon { font-size: 1rem; width: 1.2rem; text-align: center; }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid #333;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .sidebar-footer strong { display: block; color: var(--paper); margin-bottom: 0.25rem; }
        .sidebar-footer a { color: var(--amber-light); text-decoration: none; }

        .main { flex: 1; padding: 2.5rem; overflow-x: hidden; }

        .page-header { margin-bottom: 2.5rem; }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 900;
            color: var(--ink);
            line-height: 1.1;
        }

        .page-header p { color: var(--muted); margin-top: 0.4rem; font-size: 0.9rem; }

        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .alert-success { background: #e8f5eb; color: var(--success); border: 1px solid #b8dfc0; }

        .stats-row { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            flex: 1;
            min-width: 140px;
        }

        .stat-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--muted); }
        .stat-value { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--ink); margin-top: 0.25rem; }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .card-header h2 { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; }

        .card-body { padding: 1.25rem 1.5rem; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary  { background: var(--amber); color: white; }
        .btn-primary:hover { background: #b07020; }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--muted);
        }

        .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.4; }
        .empty-state h3 { font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--ink); }
        .empty-state p { margin-bottom: 1.5rem; }

        @media (max-width: 768px) {
            .sidebar { width: 60px; }
            .sidebar-brand, .nav-item span, .sidebar-footer { display: none; }
            .main { padding: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="sidebar-brand">
            AnoKind
            <span>Buyer</span>
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-item active">
                <span class="nav-icon">📊</span>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">🛍️</span>
                <span>Belanja</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">📦</span>
                <span>Pesanan Saya</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">❤️</span>
                <span>Favorit</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">💳</span>
                <span>Metode Pembayaran</span>
            </a>
        </nav>
        <div class="sidebar-footer">
            <strong>{{ Auth::user()->name }}</strong>
            {{ Auth::user()->email }}<br>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>

    <main class="main">
        <div class="page-header">
            <h1>🛒 Buyer Dashboard</h1>
            <p>Belanja dan kelola koleksi buku berkualitas Anda</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total Buku</div>
                <div class="stat-value">0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Pesanan Aktif</div>
                <div class="stat-value">0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Belanja</div>
                <div class="stat-value">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Poin Reward</div>
                <div class="stat-value">0</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Pesanan Terbaru</h2>
            </div>
            <div class="card-body">
                <div class="empty-state">
                    <div class="icon">📦</div>
                    <h3>Belum ada pesanan</h3>
                    <p>Mulai berbelanja buku-buku pilihan kami sekarang</p>
                    <a href="#" class="btn btn-primary">Jelajahi Toko</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Buku Favorit Anda</h2>
            </div>
            <div class="card-body">
                <div class="empty-state">
                    <div class="icon">❤️</div>
                    <h3>Belum ada favorit</h3>
                    <p>Tambahkan buku favorit Anda untuk akses cepat</p>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>

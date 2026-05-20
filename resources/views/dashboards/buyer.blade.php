<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard — AnoKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #020617; --surface: #0f172a; --border: rgba(255,255,255,0.1);
            --text: #f1f5f9; --muted: #94a3b8; --muted2: #64748b;
            --amber: #f59e0b; --amber-dim: rgba(245,158,11,0.15);
            --amber-ring: rgba(245,158,11,0.2); --amber-text: #fcd34d;
            --danger: #f87171; --success: #4ade80;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 240px; background: var(--surface); border-right: 1px solid var(--border); padding: 1.5rem 0; position: sticky; top: 0; height: 100vh; display: flex; flex-direction: column; flex-shrink: 0; }
        .sb-brand { padding: 0 1.5rem 1.5rem; border-bottom: 1px solid var(--border); margin-bottom: 0.5rem; }
        .sb-logo { font-size: 1.4rem; font-weight: 700; color: #fff; }
        .sb-logo span { color: var(--amber-text); }
        .sb-role { display: inline-block; margin-top: 0.4rem; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--amber-text); background: var(--amber-dim); padding: 0.15rem 0.5rem; border-radius: 999px; }
        .sb-nav { flex: 1; padding: 0.5rem 0; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 1.5rem; color: var(--muted); text-decoration: none; font-size: 0.875rem; border-right: 3px solid transparent; transition: all 0.15s; }
        .nav-item:hover, .nav-item.active { color: var(--text); background: var(--amber-dim); border-right-color: var(--amber); }
        .nav-icon { font-size: 1rem; width: 1.1rem; text-align: center; flex-shrink: 0; }
        .sb-footer { padding: 1rem 1.5rem; border-top: 1px solid var(--border); font-size: 0.8rem; color: var(--muted2); }
        .sb-footer strong { display: block; color: var(--text); margin-bottom: 0.15rem; }
        .sb-footer a { color: var(--danger); text-decoration: none; font-size: 0.8rem; }
        .main { flex: 1; padding: 2.5rem; overflow-x: hidden; }
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.75rem; font-weight: 700; color: #fff; }
        .page-header p { color: var(--muted); margin-top: 0.35rem; font-size: 0.9rem; }
        .alert-success { background: rgba(74,222,128,0.1); border: 1px solid rgba(74,222,128,0.25); color: var(--success); border-radius: 0.75rem; padding: 0.75rem 1rem; margin-bottom: 1.5rem; font-size: 0.875rem; font-weight: 500; }
        .stats-row { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .stat-card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; padding: 1.25rem 1.5rem; flex: 1; min-width: 130px; }
        .stat-label { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted2); }
        .stat-value { font-size: 2rem; font-weight: 700; color: #fff; margin-top: 0.25rem; }
        .card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; overflow: hidden; margin-bottom: 2rem; }
        .card-header { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); }
        .card-header h2 { font-size: 1rem; font-weight: 600; color: #fff; }
        .card-body { padding: 1.25rem 1.5rem; }
        .empty-state { text-align: center; padding: 3rem 2rem; color: var(--muted2); }
        .empty-state .icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.5; }
        .empty-state h3 { font-size: 1rem; color: var(--muted); margin-bottom: 0.4rem; }
        .empty-state p { font-size: 0.875rem; margin-bottom: 1.25rem; }
        .btn { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.5rem 1.25rem; border-radius: 0.75rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; }
        .btn-amber { background: var(--amber); color: #020617; }
        .btn-amber:hover { background: #fbbf24; }
        @media (max-width: 768px) { .sidebar { width: 60px; } .sb-brand, .nav-item span:not(.nav-icon), .sb-footer { display: none; } .main { padding: 1.5rem; } }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="sb-brand">
            <div class="sb-logo">Ano<span>Kind</span></div>
            <span class="sb-role">Buyer</span>
        </div>
        <nav class="sb-nav">
            <a href="#" class="nav-item active"><span class="nav-icon">📊</span><span>Dashboard</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">🛍️</span><span>Belanja</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">📦</span><span>Pesanan Saya</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">❤️</span><span>Favorit</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">💳</span><span>Metode Pembayaran</span></a>
        </nav>
        <div class="sb-footer">
            <strong>{{ Auth::user()->name }}</strong>
            {{ Auth::user()->email }}<br><br>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </div>
    </aside>

    <main class="main">
        <div class="page-header">
            <h1>🛒 Buyer Dashboard</h1>
            <p>Belanja dan kelola koleksi buku berkualitas Anda</p>
        </div>

        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        <div class="stats-row">
            <div class="stat-card"><div class="stat-label">Total Buku</div><div class="stat-value">0</div></div>
            <div class="stat-card"><div class="stat-label">Pesanan Aktif</div><div class="stat-value">0</div></div>
            <div class="stat-card"><div class="stat-label">Total Belanja</div><div class="stat-value">Rp 0</div></div>
            <div class="stat-card"><div class="stat-label">Poin Reward</div><div class="stat-value">0</div></div>
        </div>

        <div class="card">
            <div class="card-header"><h2>Pesanan Terbaru</h2></div>
            <div class="card-body">
                <div class="empty-state">
                    <div class="icon">📦</div>
                    <h3>Belum ada pesanan</h3>
                    <p>Mulai berbelanja buku-buku pilihan kami sekarang</p>
                    <a href="#" class="btn btn-amber">Jelajahi Toko</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2>Buku Favorit Anda</h2></div>
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

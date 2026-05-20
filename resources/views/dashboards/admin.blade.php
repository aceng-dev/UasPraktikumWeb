<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — AnoKind</title>
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
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 240px; background: var(--surface); border-right: 1px solid var(--border); padding: 1.5rem 0; position: sticky; top: 0; height: 100vh; display: flex; flex-direction: column; flex-shrink: 0; }
        .sb-brand { padding: 0 1.5rem 1.5rem; border-bottom: 1px solid var(--border); margin-bottom: 0.5rem; }
        .sb-logo { font-size: 1.4rem; font-weight: 700; color: #fff; letter-spacing: -0.5px; }
        .sb-logo span { color: var(--amber-text); }
        .sb-role { display: inline-block; margin-top: 0.4rem; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--amber-text); background: var(--amber-dim); padding: 0.15rem 0.5rem; border-radius: 999px; }
        .sb-nav { flex: 1; padding: 0.5rem 0; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 1.5rem; color: var(--muted); text-decoration: none; font-size: 0.875rem; border-right: 3px solid transparent; transition: all 0.15s; }
        .nav-item:hover, .nav-item.active { color: var(--text); background: var(--amber-dim); border-right-color: var(--amber); }
        .nav-icon { font-size: 1rem; width: 1.1rem; text-align: center; flex-shrink: 0; }
        .sb-footer { padding: 1rem 1.5rem; border-top: 1px solid var(--border); font-size: 0.8rem; color: var(--muted2); }
        .sb-footer strong { display: block; color: var(--text); margin-bottom: 0.15rem; font-size: 0.85rem; }
        .sb-footer a { color: var(--danger); text-decoration: none; font-size: 0.8rem; }
        .main { flex: 1; padding: 2.5rem; overflow-x: hidden; }
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.75rem; font-weight: 700; color: #fff; }
        .page-header p { color: var(--muted); margin-top: 0.35rem; font-size: 0.9rem; }
        .alert { border-radius: 0.75rem; padding: 0.75rem 1rem; margin-bottom: 1.5rem; font-size: 0.875rem; font-weight: 500; }
        .alert-success { background: rgba(74,222,128,0.1); border: 1px solid rgba(74,222,128,0.25); color: var(--success); }
        .alert-error { background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.25); color: var(--danger); }
        .stats-row { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .stat-card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; padding: 1.25rem 1.5rem; flex: 1; min-width: 130px; }
        .stat-label { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted2); }
        .stat-value { font-size: 2rem; font-weight: 700; color: #fff; margin-top: 0.25rem; }
        .card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; overflow: hidden; margin-bottom: 2rem; }
        .card-header { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); }
        .card-header h2 { font-size: 1rem; font-weight: 600; color: #fff; }
        .filter-bar { display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end; padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); }
        .filter-group { flex: 1; min-width: 150px; }
        .filter-label { display: block; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted2); margin-bottom: 0.4rem; }
        .form-control { width: 100%; padding: 0.6rem 0.9rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); border-radius: 0.625rem; color: var(--text); font-family: 'Inter', sans-serif; font-size: 0.875rem; }
        .form-control:focus { outline: none; border-color: var(--amber); box-shadow: 0 0 0 3px var(--amber-ring); }
        .btn { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.5rem 1rem; border-radius: 0.625rem; font-size: 0.8rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; }
        .btn-amber { background: var(--amber); color: #020617; }
        .btn-amber:hover { background: #fbbf24; }
        .btn-outline { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-outline:hover { border-color: var(--amber-text); color: var(--amber-text); }
        .btn-danger { background: transparent; color: var(--danger); border: 1px solid rgba(248,113,113,0.25); }
        .btn-danger:hover { background: rgba(248,113,113,0.15); }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.75rem; }
        table { width: 100%; border-collapse: collapse; }
        th { background: rgba(255,255,255,0.04); text-align: left; padding: 0.65rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted2); font-weight: 600; }
        td { padding: 0.9rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.875rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,0.025); }
        .badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600; text-transform: capitalize; }
        .badge-admin { background: rgba(99,102,241,0.15); color: #a5b4fc; }
        .badge-reader { background: rgba(167,139,250,0.15); color: #c4b5fd; }
        .badge-author { background: rgba(251,191,36,0.15); color: var(--amber-text); }
        .badge-publisher { background: rgba(52,211,153,0.15); color: #6ee7b7; }
        .badge-buyer { background: rgba(251,113,133,0.15); color: #fda4af; }
        .empty-state { text-align: center; padding: 3rem 2rem; color: var(--muted2); }
        .empty-state .icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.5; }
        .empty-state h3 { font-size: 1rem; color: var(--muted); }
        @media (max-width: 768px) { .sidebar { width: 60px; } .sb-brand span, .nav-item span:not(.nav-icon), .sb-footer { display: none; } .main { padding: 1.5rem; } }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="sb-brand">
            <div class="sb-logo">Ano<span>Kind</span></div>
            <span class="sb-role">Admin</span>
        </div>
        <nav class="sb-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                <span class="nav-icon">📊</span><span>Dashboard</span>
            </a>
            <a href="#" class="nav-item"><span class="nav-icon">👥</span><span>Manajemen User</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">📚</span><span>Naskah</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">📋</span><span>Laporan</span></a>
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
            <h1>📊 Admin Dashboard</h1>
            <p>Kelola pengguna dan sistem AnoKind</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">✗ {{ session('error') }}</div>
        @endif

        <div class="stats-row">
            <div class="stat-card"><div class="stat-label">Total User</div><div class="stat-value">{{ $totalUsers ?? 0 }}</div></div>
            <div class="stat-card"><div class="stat-label">Admin</div><div class="stat-value">{{ $totalAdmins ?? 0 }}</div></div>
            <div class="stat-card"><div class="stat-label">Reader</div><div class="stat-value">{{ $totalReaders ?? 0 }}</div></div>
            <div class="stat-card"><div class="stat-label">Author</div><div class="stat-value">{{ $totalAuthors ?? 0 }}</div></div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>👥 Manajemen User</h2>
            </div>

            <div class="filter-bar">
                <form method="GET" action="{{ route('admin.dashboard') }}" style="display:flex; gap:1rem; flex-wrap:wrap; width:100%; align-items:flex-end;">
                    <div class="filter-group">
                        <label class="filter-label">Cari Nama/Email</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="form-control">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Role</label>
                        <select name="role" class="form-control">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="reader" {{ request('role') === 'reader' ? 'selected' : '' }}>Reader</option>
                            <option value="author" {{ request('role') === 'author' ? 'selected' : '' }}>Author</option>
                            <option value="publisher" {{ request('role') === 'publisher' ? 'selected' : '' }}>Publisher</option>
                            <option value="buyer" {{ request('role') === 'buyer' ? 'selected' : '' }}>Buyer</option>
                        </select>
                    </div>
                    <div style="display:flex; gap:0.5rem;">
                        <button type="submit" class="btn btn-amber">Filter</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Reset</a>
                    </div>
                </form>
            </div>

            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td style="color:var(--muted2);">#{{ $user->id }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td style="color:var(--muted);">{{ $user->email }}</td>
                            <td><span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                            <td style="text-align:center;">
                                @if($user->role != 'admin' || auth()->id() != $user->id)
                                    <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @else
                                    <span style="color:var(--muted2);">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5"><div class="empty-state"><div class="icon">👤</div><h3>Tidak ada user</h3></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(isset($users) && method_exists($users, 'links'))
            <div style="margin-top: 1.5rem;">{{ $users->withQueryString()->links() }}</div>
        @endif
    </main>
</div>

</body>
</html>

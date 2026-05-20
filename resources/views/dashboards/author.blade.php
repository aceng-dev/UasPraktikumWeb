{{-- resources/views/dashboards/author.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard — AnoKind</title>
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
        .alert { border-radius: 0.75rem; padding: 0.75rem 1rem; margin-bottom: 1.5rem; font-size: 0.875rem; font-weight: 500; }
        .alert-success { background: rgba(74,222,128,0.1); border: 1px solid rgba(74,222,128,0.25); color: var(--success); }
        .alert-error { background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.25); color: var(--danger); }
        .error-list { background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.25); border-radius: 0.75rem; padding: 0.75rem 1rem; margin-bottom: 1.5rem; }
        .error-list ul { padding-left: 1.2rem; }
        .error-list li { font-size: 0.85rem; color: var(--danger); margin-bottom: 0.2rem; }
        .stats-row { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .stat-card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; padding: 1.25rem 1.5rem; flex: 1; min-width: 130px; }
        .stat-label { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted2); }
        .stat-value { font-size: 2rem; font-weight: 700; color: #fff; margin-top: 0.25rem; }
        .card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; overflow: hidden; margin-bottom: 2rem; }
        .card-header { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); }
        .card-header h2 { font-size: 1rem; font-weight: 600; color: #fff; }
        table { width: 100%; border-collapse: collapse; }
        th { background: rgba(255,255,255,0.04); text-align: left; padding: 0.65rem 1.25rem; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted2); font-weight: 600; }
        td { padding: 0.9rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.875rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,0.025); }
        .book-title { font-weight: 600; color: var(--text); }
        .book-excerpt { font-size: 0.75rem; color: var(--muted2); margin-top: 2px; }
        .badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600; }
        .badge-published { background: rgba(74,222,128,0.15); color: var(--success); }
        .badge-draft { background: rgba(148,163,184,0.1); color: var(--muted); }
        .btn { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.5rem 1rem; border-radius: 0.625rem; font-size: 0.8rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; }
        .btn-amber { background: var(--amber); color: #020617; }
        .btn-amber:hover { background: #fbbf24; }
        .btn-outline { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-outline:hover { border-color: var(--amber-text); color: var(--amber-text); }
        .btn-danger { background: transparent; color: var(--danger); border: 1px solid rgba(248,113,113,0.25); }
        .btn-danger:hover { background: rgba(248,113,113,0.15); }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.75rem; }
        .actions { display: flex; gap: 0.5rem; }
        .empty-state { text-align: center; padding: 3rem 2rem; color: var(--muted2); }
        .empty-state .icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.5; }
        .empty-state p { font-size: 0.875rem; margin-bottom: 1.25rem; }
        .form-card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; padding: 2rem; max-width: 720px; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted); margin-bottom: 0.4rem; }
        .form-label .req { color: var(--amber); margin-left: 2px; }
        .form-control { width: 100%; padding: 0.7rem 1rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); border-radius: 0.625rem; color: var(--text); font-family: 'Inter', sans-serif; font-size: 0.9rem; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-control:focus { outline: none; border-color: var(--amber); box-shadow: 0 0 0 3px var(--amber-ring); }
        textarea.form-control { resize: vertical; min-height: 200px; line-height: 1.6; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
        .form-hint { font-size: 0.75rem; color: var(--muted2); margin-top: 0.35rem; }
        .form-error { font-size: 0.75rem; color: var(--danger); margin-top: 0.35rem; }
        .form-actions { display: flex; gap: 0.75rem; margin-top: 1.75rem; padding-top: 1.5rem; border-top: 1px solid var(--border); }
        .stars { color: var(--muted2); font-size: 0.85rem; }
        .stars .on { color: var(--amber-text); }
        @media (max-width: 768px) { .sidebar { width: 60px; } .sb-brand, .nav-item span:not(.nav-icon), .sb-footer { display: none; } .main { padding: 1.5rem; } }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="sb-brand">
            <div class="sb-logo">Ano<span>Kind</span></div>
            <span class="sb-role">Author Studio</span>
        </div>
        <nav class="sb-nav">
            <a href="{{ route('author.dashboard') }}" class="nav-item {{ $page === 'dashboard' ? 'active' : '' }}">
                <span class="nav-icon">📚</span><span>Buku Saya</span>
            </a>
            <a href="{{ route('author.buku.create') }}" class="nav-item {{ in_array($page, ['create','edit']) ? 'active' : '' }}">
                <span class="nav-icon">✏️</span><span>Tulis Buku Baru</span>
            </a>
        </nav>
        <div class="sb-footer">
            <strong>{{ Auth::user()->name }}</strong>
            Author · {{ Auth::user()->email }}<br><br>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </div>
    </aside>

    <main class="main">
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="error-list">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        {{-- ── DASHBOARD ── --}}
        @if($page === 'dashboard')
            <div class="page-header">
                <h1>Buku Saya</h1>
                <p>Kelola semua karya yang telah kamu tulis</p>
            </div>
            <div class="stats-row">
                <div class="stat-card"><div class="stat-label">Total Buku</div><div class="stat-value">{{ $books->count() }}</div></div>
                <div class="stat-card"><div class="stat-label">Published</div><div class="stat-value">{{ $books->where('status','published')->count() }}</div></div>
                <div class="stat-card"><div class="stat-label">Draft</div><div class="stat-value">{{ $books->where('status','draft')->count() }}</div></div>
                <div class="stat-card"><div class="stat-label">Total Ulasan</div><div class="stat-value">{{ $books->sum('reviews_count') }}</div></div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Daftar Karya</h2>
                    <a href="{{ route('author.buku.create') }}" class="btn btn-amber">✏️ Tulis Buku Baru</a>
                </div>
                @if($books->isEmpty())
                    <div class="empty-state">
                        <div class="icon">📝</div>
                        <p>Kamu belum punya buku. Mulai tulis karya pertamamu!</p>
                        <a href="{{ route('author.buku.create') }}" class="btn btn-amber">Mulai Menulis</a>
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Judul</th><th>Status</th><th>Harga</th><th>Rating</th><th>Ulasan</th><th>Dibuat</th><th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>
                                    <div class="book-title">{{ $book->title }}</div>
                                    <div class="book-excerpt">{{ Str::limit($book->content, 60) }}</div>
                                </td>
                                <td><span class="badge badge-{{ $book->status }}">{{ $book->status }}</span></td>
                                <td>
                                    @if($book->price == 0)
                                        <span style="color:var(--success); font-weight:600;">Gratis</span>
                                    @else
                                        Rp {{ number_format($book->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    <span class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= round($book->reviews_avg_rating ?? 0) ? 'on' : '' }}">★</span>
                                        @endfor
                                    </span>
                                    <div style="font-size:0.72rem; color:var(--muted2); margin-top:2px;">
                                        {{ number_format($book->reviews_avg_rating ?? 0, 1) }}
                                    </div>
                                </td>
                                <td style="color:var(--muted2);">{{ $book->reviews_count }}</td>
                                <td style="color:var(--muted2); font-size:0.8rem;">{{ $book->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('author.buku.edit', $book->id) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form action="{{ route('author.buku.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        {{-- ── CREATE ── --}}
        @elseif($page === 'create')
            <div class="page-header">
                <h1>Tulis Buku Baru</h1>
                <p>Setiap kisah besar dimulai dari satu kata pertama</p>
            </div>
            <div class="form-card">
                <form action="{{ route('author.buku.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Judul Buku <span class="req">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul buku..." value="{{ old('title') }}" required>
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konten / Isi Buku <span class="req">*</span></label>
                        <textarea name="content" class="form-control" placeholder="Mulai tulis ceritamu di sini..." required>{{ old('content') }}</textarea>
                        @error('content')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Harga (Rp) <span class="req">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="0 = Gratis" value="{{ old('price', 0) }}" min="0" step="1000" required>
                            <div class="form-hint">Isi 0 untuk menjadikan buku gratis</div>
                            @error('price')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span class="req">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft — belum dipublikasikan</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published — tampil ke reader</option>
                            </select>
                            @error('status')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">URL Cover Buku</label>
                        <input type="url" name="coverUrl" class="form-control" placeholder="https://contoh.com/cover.jpg" value="{{ old('coverUrl') }}">
                        <div class="form-hint">Opsional — link gambar sampul buku</div>
                        @error('coverUrl')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-amber">✓ Simpan Buku</button>
                        <a href="{{ route('author.dashboard') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>

        {{-- ── EDIT ── --}}
        @elseif($page === 'edit')
            <div class="page-header">
                <h1>Edit Buku</h1>
                <p>Perbaiki dan sempurnakan karyamu</p>
            </div>
            <div class="form-card">
                <form action="{{ route('author.buku.update', $book->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Judul Buku <span class="req">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konten / Isi Buku <span class="req">*</span></label>
                        <textarea name="content" class="form-control" required>{{ old('content', $book->content) }}</textarea>
                        @error('content')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Harga (Rp) <span class="req">*</span></label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $book->price) }}" min="0" step="1000" required>
                            <div class="form-hint">Isi 0 untuk menjadikan buku gratis</div>
                            @error('price')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span class="req">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="draft" {{ old('status', $book->status) === 'draft' ? 'selected' : '' }}>Draft — belum dipublikasikan</option>
                                <option value="published" {{ old('status', $book->status) === 'published' ? 'selected' : '' }}>Published — tampil ke reader</option>
                            </select>
                            @error('status')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">URL Cover Buku</label>
                        <input type="url" name="coverUrl" class="form-control" value="{{ old('coverUrl', $book->coverUrl) }}" placeholder="https://contoh.com/cover.jpg">
                        @error('coverUrl')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-amber">✓ Simpan Perubahan</button>
                        <a href="{{ route('author.dashboard') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>
        @endif
    </main>
</div>

</body>
</html>

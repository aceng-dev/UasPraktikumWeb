{{-- resources/views/dashboards/author.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard — AnoKind</title>
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

        /* ── SIDEBAR ── */
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

        /* ── MAIN ── */
        .main { flex: 1; padding: 2.5rem; overflow-x: hidden; }

        /* ── HEADER ── */
        .page-header { margin-bottom: 2.5rem; }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 900;
            color: var(--ink);
            line-height: 1.1;
        }

        .page-header p { color: var(--muted); margin-top: 0.4rem; font-size: 0.9rem; }

        /* ── ALERT ── */
        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .alert-success { background: #e8f5eb; color: var(--success); border: 1px solid #b8dfc0; }
        .alert-error   { background: #fdecea; color: var(--danger);  border: 1px solid #f5c6c6; }

        /* ── STATS ROW ── */
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

        /* ── TABLE ── */
        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .card-header h2 { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; }

        table { width: 100%; border-collapse: collapse; }

        th {
            background: var(--cream);
            text-align: left;
            padding: 0.75rem 1.25rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            font-weight: 500;
        }

        td { padding: 1rem 1.25rem; border-bottom: 1px solid var(--cream); font-size: 0.875rem; vertical-align: middle; }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafaf8; }

        .book-title { font-weight: 500; color: var(--ink); }
        .book-excerpt { font-size: 0.78rem; color: var(--muted); margin-top: 2px; }

        /* ── BADGE ── */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .badge-published { background: #e8f5eb; color: var(--success); }
        .badge-draft     { background: #f0ede8; color: var(--muted);   }

        /* ── BUTTONS ── */
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

        .btn-outline  { background: transparent; color: var(--ink); border: 1px solid var(--border); }
        .btn-outline:hover { border-color: var(--amber); color: var(--amber); }

        .btn-danger   { background: transparent; color: var(--danger); border: 1px solid #f5c6c6; }
        .btn-danger:hover { background: var(--danger); color: white; }

        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.78rem; }

        .actions { display: flex; gap: 0.5rem; }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
        }

        .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.4; }
        .empty-state p { margin-bottom: 1.5rem; }

        /* ── FORM ── */
        .form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            max-width: 720px;
        }

        .form-group { margin-bottom: 1.5rem; }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--ink);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label .required { color: var(--amber); margin-left: 2px; }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--ink);
            background: var(--paper);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(200, 134, 42, 0.12);
            background: white;
        }

        textarea.form-control { resize: vertical; min-height: 200px; line-height: 1.6; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }

        .form-hint { font-size: 0.78rem; color: var(--muted); margin-top: 0.35rem; }

        .form-error { font-size: 0.78rem; color: var(--danger); margin-top: 0.35rem; }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--cream);
        }

        .rating-display { display: flex; gap: 2px; }
        .star { color: #e0d5c5; font-size: 0.9rem; }
        .star.filled { color: var(--amber); }

        /* ── VALIDATION ERRORS ── */
        .error-list {
            background: #fdecea;
            border: 1px solid #f5c6c6;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .error-list ul { padding-left: 1.2rem; }
        .error-list li { font-size: 0.85rem; color: var(--danger); margin-bottom: 0.25rem; }
    </style>
</head>
<body>

<div class="layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            Wetpad
            <span>Author Studio</span>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('author.dashboard') }}"
               class="nav-item {{ $page === 'dashboard' ? 'active' : '' }}">
                <span class="nav-icon">📚</span> Buku Saya
            </a>
            <a href="{{ route('author.buku.create') }}"
               class="nav-item {{ in_array($page, ['create','edit']) ? 'active' : '' }}">
                <span class="nav-icon">✏️</span> Tulis Buku Baru
            </a>
        </nav>

        <div class="sidebar-footer">
            <strong>{{ Auth::user()->name }}</strong>
            Author • {{ Auth::user()->email }}
            <br><br>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               style="color:var(--danger); text-decoration:none; font-size:0.8rem;">
               Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </aside>

    {{-- ── MAIN CONTENT ── --}}
    <main class="main">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
            <div class="error-list">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- ════════════════════════════════ --}}
        {{-- PAGE: DASHBOARD (daftar buku)    --}}
        {{-- ════════════════════════════════ --}}
        @if($page === 'dashboard')

            <div class="page-header">
                <h1>Buku Saya</h1>
                <p>Kelola semua karya yang telah kamu tulis</p>
            </div>

            {{-- Stats --}}
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-label">Total Buku</div>
                    <div class="stat-value">{{ $books->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Published</div>
                    <div class="stat-value">{{ $books->where('status','published')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Draft</div>
                    <div class="stat-value">{{ $books->where('status','draft')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Ulasan</div>
                    <div class="stat-value">{{ $books->sum('reviews_count') }}</div>
                </div>
            </div>

            {{-- Table --}}
            <div class="card">
                <div class="card-header">
                    <h2>Daftar Karya</h2>
                    <a href="{{ route('author.buku.create') }}" class="btn btn-primary">
                        ✏️ Tulis Buku Baru
                    </a>
                </div>

                @if($books->isEmpty())
                    <div class="empty-state">
                        <div class="icon">📝</div>
                        <p>Kamu belum punya buku. Mulai tulis karya pertamamu!</p>
                        <a href="{{ route('author.buku.create') }}" class="btn btn-primary">Mulai Menulis</a>
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Harga</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>
                                    <div class="book-title">{{ $book->title }}</div>
                                    <div class="book-excerpt">{{ Str::limit($book->content, 60) }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $book->status }}">{{ $book->status }}</span>
                                </td>
                                <td>
                                    @if($book->price == 0)
                                        <span style="color:var(--success); font-weight:500;">Gratis</span>
                                    @else
                                        Rp {{ number_format($book->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    <div class="rating-display">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="star {{ $i <= round($book->reviews_avg_rating ?? 0) ? 'filled' : '' }}">★</span>
                                        @endfor
                                    </div>
                                    <div style="font-size:0.75rem; color:var(--muted); margin-top:2px;">
                                        {{ number_format($book->reviews_avg_rating ?? 0, 1) }}
                                    </div>
                                </td>
                                <td style="color:var(--muted);">{{ $book->reviews_count }} ulasan</td>
                                <td style="color:var(--muted); font-size:0.8rem;">{{ $book->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('author.buku.edit', $book->id) }}"
                                           class="btn btn-outline btn-sm">Edit</a>

                                        <form action="{{ route('author.buku.destroy', $book->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus buku ini? Tindakan tidak dapat dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
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


        {{-- ════════════════ --}}
        {{-- PAGE: CREATE     --}}
        {{-- ════════════════ --}}
        @elseif($page === 'create')

            <div class="page-header">
                <h1>Tulis Buku Baru</h1>
                <p>Setiap kisah besar dimulai dari satu kata pertama</p>
            </div>

            <div class="form-card">
                <form action="{{ route('author.buku.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Judul Buku <span class="required">*</span></label>
                        <input type="text" name="title" class="form-control"
                               placeholder="Masukkan judul buku..."
                               value="{{ old('title') }}" required>
                        @error('title')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konten / Isi Buku <span class="required">*</span></label>
                        <textarea name="content" class="form-control"
                                  placeholder="Mulai tulis ceritamu di sini..."
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Harga (Rp) <span class="required">*</span></label>
                            <input type="number" name="price" class="form-control"
                                   placeholder="0 = Gratis"
                                   value="{{ old('price', 0) }}" min="0" step="1000" required>
                            <div class="form-hint">Isi 0 untuk menjadikan buku gratis</div>
                            @error('price')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status <span class="required">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="draft"     {{ old('status') === 'draft'     ? 'selected' : '' }}>Draft — belum dipublikasikan</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published — tampil ke reader</option>
                            </select>
                            @error('status')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">URL Cover Buku</label>
                        <input type="url" name="coverUrl" class="form-control"
                               placeholder="https://contoh.com/cover.jpg"
                               value="{{ old('coverUrl') }}">
                        <div class="form-hint">Opsional — link gambar sampul buku</div>
                        @error('coverUrl')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">✓ Simpan Buku</button>
                        <a href="{{ route('author.dashboard') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>


        {{-- ════════════════ --}}
        {{-- PAGE: EDIT       --}}
        {{-- ════════════════ --}}
        @elseif($page === 'edit')

            <div class="page-header">
                <h1>Edit Buku</h1>
                <p>Perbaiki dan sempurnakan karyamu</p>
            </div>

            <div class="form-card">
                <form action="{{ route('author.buku.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Judul Buku <span class="required">*</span></label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title', $book->title) }}" required>
                        @error('title')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konten / Isi Buku <span class="required">*</span></label>
                        <textarea name="content" class="form-control" required>{{ old('content', $book->content) }}</textarea>
                        @error('content')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Harga (Rp) <span class="required">*</span></label>
                            <input type="number" name="price" class="form-control"
                                   value="{{ old('price', $book->price) }}" min="0" step="1000" required>
                            <div class="form-hint">Isi 0 untuk menjadikan buku gratis</div>
                            @error('price')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status <span class="required">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="draft"     {{ old('status', $book->status) === 'draft'     ? 'selected' : '' }}>Draft — belum dipublikasikan</option>
                                <option value="published" {{ old('status', $book->status) === 'published' ? 'selected' : '' }}>Published — tampil ke reader</option>
                            </select>
                            @error('status')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">URL Cover Buku</label>
                        <input type="url" name="coverUrl" class="form-control"
                               value="{{ old('coverUrl', $book->coverUrl) }}"
                               placeholder="https://contoh.com/cover.jpg">
                        @error('coverUrl')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">✓ Simpan Perubahan</button>
                        <a href="{{ route('author.dashboard') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>

        @endif

    </main>
</div>

</body>
</html>
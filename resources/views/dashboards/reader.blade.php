<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reader Dashboard — AnoKind</title>
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

        /* Catalog */
        .catalog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
        .book-card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; overflow: hidden; display: flex; flex-direction: column; transition: all 0.25s; }
        .book-card:hover { border-color: rgba(245,158,11,0.4); transform: translateY(-3px); box-shadow: 0 12px 24px rgba(0,0,0,0.4); }
        .book-head { padding: 0.65rem 1rem; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; }
        .book-body { padding: 1rem; flex: 1; display: flex; flex-direction: column; }
        .book-title { font-size: 0.95rem; font-weight: 600; color: #fff; margin-bottom: 0.4rem; line-height: 1.3; }
        .book-excerpt { font-size: 0.78rem; color: var(--muted); margin-bottom: 1rem; flex: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.5; }
        .badge { display: inline-block; padding: 0.2rem 0.55rem; border-radius: 999px; font-size: 0.68rem; font-weight: 600; }
        .badge-free { background: rgba(74,222,128,0.15); color: var(--success); }
        .badge-paid { background: rgba(251,191,36,0.15); color: var(--amber-text); }

        /* Reading */
        .back-link { display: inline-flex; align-items: center; gap: 0.5rem; color: var(--amber-text); text-decoration: none; font-size: 0.875rem; margin-bottom: 1.5rem; }
        .back-link:hover { text-decoration: underline; }
        .reading-layout { display: grid; grid-template-columns: 1fr 300px; gap: 2rem; }
        .reading-area { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; padding: 2.5rem; line-height: 1.8; }
        .book-title-large { font-size: 1.75rem; font-weight: 700; color: #fff; margin-bottom: 0.4rem; }
        .book-author-large { font-size: 0.9rem; color: var(--muted); margin-bottom: 1.75rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border); }
        .book-content { font-size: 1rem; color: var(--muted); text-align: justify; }
        .reading-sidebar { display: flex; flex-direction: column; gap: 1.25rem; }
        .sidebar-card { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 1rem; padding: 1.25rem; }
        .sidebar-card h3 { font-size: 0.9rem; font-weight: 600; color: #fff; margin-bottom: 0.85rem; }
        .form-control { width: 100%; padding: 0.65rem 0.9rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border); border-radius: 0.625rem; color: var(--text); font-family: 'Inter', sans-serif; font-size: 0.875rem; }
        .form-control:focus { outline: none; border-color: var(--amber); box-shadow: 0 0 0 3px var(--amber-ring); }
        .review-item { padding: 0.85rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .review-item:last-child { border-bottom: none; }
        .review-name { font-weight: 600; color: var(--text); font-size: 0.85rem; }
        .review-rating { color: var(--amber-text); font-size: 0.8rem; margin: 0.2rem 0; }
        .review-text { color: var(--muted); font-size: 0.8rem; }
        .empty-state { text-align: center; padding: 1.5rem; color: var(--muted2); }
        .empty-state .icon { font-size: 1.75rem; margin-bottom: 0.5rem; opacity: 0.5; }
        .ai-result { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.2); border-radius: 0.75rem; padding: 0.85rem; margin-bottom: 0.85rem; font-size: 0.875rem; color: var(--text); line-height: 1.6; }
        .ai-error { background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.25); border-radius: 0.75rem; padding: 0.85rem; margin-bottom: 0.85rem; font-size: 0.875rem; color: var(--danger); }

        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem; padding: 0.55rem 1.1rem; border-radius: 0.75rem; font-size: 0.85rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; }
        .btn-amber { background: var(--amber); color: #020617; }
        .btn-amber:hover { background: #fbbf24; }
        .btn-full { width: 100%; }

        @media (max-width: 768px) { .sidebar { width: 60px; } .sb-brand, .nav-item span:not(.nav-icon), .sb-footer { display: none; } .main { padding: 1.5rem; } .reading-layout { grid-template-columns: 1fr; } .catalog-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); } }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="sb-brand">
            <div class="sb-logo">Ano<span>Kind</span></div>
            <span class="sb-role">Reader</span>
        </div>
        <nav class="sb-nav">
            <a href="{{ route('reader.index') }}" class="nav-item active"><span class="nav-icon">📖</span><span>Katalog</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">📚</span><span>Koleksi</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">⭐</span><span>Favorit</span></a>
            <a href="#" class="nav-item"><span class="nav-icon">🔖</span><span>Bookmark</span></a>
        </nav>
        <div class="sb-footer">
            <strong>{{ Auth::user()->name }}</strong>
            {{ Auth::user()->email }}<br><br>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </div>
    </aside>

    <main class="main">
        {{-- ── KATALOG ── --}}
        @if($page == 'katalog')
            <div class="page-header">
                <h1>📖 Katalog Naskah Digital</h1>
                <p>Jelajahi karya-karya terbaik dari para penulis berbakat kami</p>
            </div>

            <div class="catalog-grid">
                @foreach($naskahs as $naskah)
                    <div class="book-card">
                        <div class="book-head">
                            <span class="badge {{ $naskah->price == 0 ? 'badge-free' : 'badge-paid' }}">
                                {{ $naskah->price == 0 ? 'Gratis' : 'Berbayar' }}
                            </span>
                            <span style="font-size:0.75rem; color:var(--muted2);">{{ $naskah->author->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="book-body">
                            <h3 class="book-title">{{ $naskah->title }}</h3>
                            <p class="book-excerpt">{{ Str::limit($naskah->content, 150) }}</p>
                            <a href="{{ route('reader.baca', $naskah->id) }}" class="btn btn-amber btn-full">Baca</a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(!$naskahs || $naskahs->count() == 0)
                <div class="empty-state" style="padding: 3rem;">
                    <div class="icon" style="font-size:2.5rem; opacity:0.4;">📝</div>
                    <p style="margin-top:0.75rem; font-size:0.9rem; color:var(--muted);">Belum ada naskah tersedia</p>
                </div>
            @endif

        {{-- ── RUANG BACA ── --}}
        @elseif($page == 'baca')
            <a href="{{ route('reader.index') }}" class="back-link">← Kembali ke Katalog</a>

            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif

            <div class="reading-layout">
                <div class="reading-area">
                    <h1 class="book-title-large">{{ $naskah->title }}</h1>
                    <p class="book-author-large">Karya: {{ $naskah->author->name ?? 'Unknown' }}</p>
                    <div class="book-content">{{ $naskah->content }}</div>
                </div>

                <div class="reading-sidebar">
                    {{-- AI Summary --}}
                    <div class="sidebar-card">
                        <h3>✨ Ringkas Cerita</h3>
                        <p style="font-size:0.8rem; color:var(--muted2); margin-bottom:0.85rem;">Gunakan AI untuk membuat ringkasan singkat dari naskah ini.</p>

                        @if(session('hasil_ai'))
                            <div class="ai-result">{{ session('hasil_ai') }}</div>
                        @endif

                        @if(session('error_ai'))
                            <div class="ai-error">{{ session('error_ai') }}</div>
                        @endif

                        <form action="{{ route('reader.summary', $naskah->id) }}" method="POST" style="display:flex; flex-direction:column; gap:0.75rem;">
                            @csrf
                            <input type="hidden" name="konten_naskah" value="{{ $naskah->content }}">
                            <button type="submit" class="btn btn-amber btn-full">Jalankan Summary</button>
                        </form>
                    </div>

                    {{-- Ulasan --}}
                    <div class="sidebar-card">
                        <h3>💬 Berikan Ulasan</h3>
                        <form action="{{ route('reader.review.store', $naskah->id) }}" method="POST" style="display:flex; flex-direction:column; gap:0.75rem;">
                            @csrf
                            <div>
                                <label style="display:block; font-size:0.7rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted2); margin-bottom:0.4rem;">Rating</label>
                                <select name="rating" class="form-control" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="5">⭐⭐⭐⭐⭐ Sempurna</option>
                                    <option value="4">⭐⭐⭐⭐ Bagus</option>
                                    <option value="3">⭐⭐⭐ Lumayan</option>
                                    <option value="2">⭐⭐ Kurang</option>
                                    <option value="1">⭐ Buruk</option>
                                </select>
                            </div>
                            <div>
                                <label style="display:block; font-size:0.7rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted2); margin-bottom:0.4rem;">Ulasan Anda</label>
                                <textarea name="komentar" rows="4" class="form-control" placeholder="Bagikan pendapat Anda..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-amber btn-full">Kirim Ulasan</button>
                        </form>
                    </div>

                    {{-- Daftar Ulasan --}}
                    <div class="sidebar-card">
                        <h3>📝 Ulasan Pembaca</h3>
                        @if($naskah->reviews && $naskah->reviews->count() > 0)
                            <div style="max-height: 400px; overflow-y: auto;">
                                @foreach($naskah->reviews as $rev)
                                    <div class="review-item">
                                        <div class="review-name">{{ $rev->user->name ?? 'Anonim' }}</div>
                                        <div class="review-rating">{{ str_repeat('★', $rev->rating) }}{{ str_repeat('☆', 5 - $rev->rating) }}</div>
                                        <div class="review-text">{{ $rev->komentar }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="icon">💬</div>
                                <p style="font-size:0.85rem;">Belum ada ulasan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </main>
</div>

</body>
</html>

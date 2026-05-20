<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reader Dashboard — AnoKind</title>
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

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .book-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
            border-color: var(--amber);
        }

        .book-header {
            background: var(--cream);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .book-badge {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .book-badge.free { background: #e8f5eb; color: var(--success); }
        .book-badge.paid { background: #fff3e0; color: #e65100; }

        .book-author {
            font-size: 0.75rem;
            color: var(--muted);
            text-align: right;
        }

        .book-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .book-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .book-excerpt {
            font-size: 0.8rem;
            color: var(--muted);
            margin-bottom: 1rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-footer {
            display: flex;
            gap: 0.5rem;
            margin-top: auto;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
            flex: 1;
        }

        .btn-primary  { background: var(--amber); color: white; }
        .btn-primary:hover { background: #b07020; }

        .reading-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
        }

        .reading-area {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2.5rem;
            font-family: 'Playfair Display', serif;
            line-height: 1.8;
        }

        .book-title-large {
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            color: var(--ink);
        }

        .book-author-large {
            font-size: 1rem;
            color: var(--muted);
            margin-bottom: 2rem;
            font-family: 'DM Sans', sans-serif;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }

        .book-content {
            font-size: 1rem;
            color: var(--ink);
            text-align: justify;
        }

        .reading-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .sidebar-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
        }

        .sidebar-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--ink);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--ink);
            background: var(--paper);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(200, 134, 42, 0.12);
            background: white;
        }

        .review-item {
            padding: 1rem;
            border-bottom: 1px solid var(--cream);
            font-size: 0.9rem;
        }

        .review-item:last-child { border-bottom: none; }

        .review-author { font-weight: 600; color: var(--ink); }

        .review-rating { color: var(--amber); font-size: 0.85rem; margin: 0.25rem 0; }

        .review-text { color: var(--muted); font-size: 0.85rem; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--amber);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            transition: all 0.2s;
        }

        .back-link:hover {
            gap: 0.75rem;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--muted);
        }

        .empty-state .icon { font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.5; }

        @media (max-width: 768px) {
            .sidebar { width: 60px; }
            .sidebar-brand, .nav-item span, .sidebar-footer { display: none; }
            .main { padding: 1.5rem; }
            .reading-layout { grid-template-columns: 1fr; }
            .catalog-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
        }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="sidebar-brand">
            AnoKind
            <span>Reader</span>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('reader.index') }}" class="nav-item {{ $page == 'katalog' ? 'active' : '' }}">
                <span class="nav-icon">📖</span>
                <span>Katalog</span>
            </a>
            <a href="{{ route('reader.koleksi') }}" class="nav-item {{ $page == 'koleksi' ? 'active' : '' }}">
                <span class="nav-icon">📚</span>
                <span>Koleksi</span>
            </a>
            <a href="{{ route('reader.favorit') }}" class="nav-item {{ $page == 'favorit' ? 'active' : '' }}">
                <span class="nav-icon">⭐</span>
                <span>Favorit</span>
            </a>
            <a href="{{ route('reader.bookmark') }}" class="nav-item {{ $page == 'bookmark' ? 'active' : '' }}">
                <span class="nav-icon">🔖</span>
                <span>Bookmark</span>
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
        {{-- ================= TAMPILAN KATALOG NASKAH ================= --}}
        @if($page == 'katalog')
            <div class="page-header">
                <h1>📖 Katalog Naskah Digital</h1>
                <p>Jelajahi karya-karya terbaik dari para penulis berbakat kami</p>
            </div>

            <div class="catalog-grid">
                @foreach($naskahs as $naskah)
                    <div class="book-card">
                        <div class="book-header">
                            <span class="book-badge {{ $naskah->price == 0 ? 'free' : 'paid' }}">
                                {{ $naskah->price == 0 ? 'Gratis' : 'Berbayar' }}
                            </span>
                            <span class="book-author">{{ $naskah->author->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="book-body">
                            <h3 class="book-title">{{ $naskah->title }}</h3>
                            <p class="book-excerpt">{{ Str::limit($naskah->content, 150) }}</p>
                            <div class="book-footer">
                                <a href="{{ route('reader.baca', $naskah->id) }}" class="btn btn-primary">Baca</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(!$naskahs || $naskahs->count() == 0)
                <div class="empty-state">
                    <div class="icon">📝</div>
                    <p>Belum ada naskah tersedia</p>
                </div>
            @endif

        {{-- ================= TAMPILAN RUANG BACA ================= --}}
        @elseif($page == 'baca')
            <a href="{{ route('reader.index') }}" class="back-link">
                ← Kembali ke Katalog
            </a>

            @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="reading-layout">
                <div class="reading-area">
                    <h1 class="book-title-large">{{ $naskah->title }}</h1>
                    <p class="book-author-large">Karya: {{ $naskah->author->name ?? 'Unknown' }}</p>
                    <div class="book-content">
                        {{ $naskah->content }}
                    </div>
                </div>

                <div class="reading-sidebar">
                    {{-- Ringkas Cerita --}}
                    <div class="sidebar-card">
                        <h3>Ringkas Cerita</h3>
                        <p style="font-size: 0.9rem; color: var(--muted); margin-bottom: 1rem;">Gunakan AI untuk membuat ringkasan singkat dan jelas dari naskah ini.</p>

                        @if(session('hasil_ai'))
                            <div style="background: #f9f5e9; border: 1px solid #e8d6b1; border-radius: 10px; padding: 1rem; margin-bottom: 1rem; color: var(--ink); font-size: 0.9rem; line-height: 1.5;">
                                {{ session('hasil_ai') }}
                            </div>
                        @endif

                        @if(session('error_ai'))
                            <div style="background: #fdecea; border: 1px solid #f5c6c6; border-radius: 10px; padding: 1rem; margin-bottom: 1rem; color: var(--danger); font-size: 0.9rem;">
                                {{ session('error_ai') }}
                            </div>
                        @endif

                        <form action="{{ route('reader.summary', $naskah->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                            @csrf
                            <input type="hidden" name="konten_naskah" value="{{ $naskah->content }}">
                            <button type="submit" class="btn btn-primary">Jalankan Summary</button>
                        </form>
                    </div>

                    {{-- Berikan Ulasan --}}
                    <div class="sidebar-card">
                        <h3>Berikan Ulasan</h3>

                        <form action="{{ route('reader.review.store', $naskah->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                            @csrf

                            <div>
                                <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">Rating</label>
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
                                <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">Ulasan Anda</label>
                                <textarea name="komentar" rows="4" class="form-control" placeholder="Bagikan pendapat Anda..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                        </form>
                    </div>

                    {{-- Daftar Ulasan --}}
                    <div class="sidebar-card">
                        <h3>Ulasan Pembaca</h3>

                        @if($naskah->reviews && $naskah->reviews->count() > 0)
                            <div style="max-height: 400px; overflow-y: auto;">
                                @foreach($naskah->reviews as $rev)
                                    <div class="review-item">
                                        <div class="review-author">{{ $rev->user->name ?? 'Anonim' }}</div>
                                        <div class="review-rating">
                                            {{ str_repeat('★', $rev->rating) }}{{ str_repeat('☆', 5 - $rev->rating) }}
                                        </div>
                                        <div class="review-text">{{ $rev->komentar }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state" style="padding: 1rem;">
                                <div class="icon">💬</div>
                                <p style="font-size: 0.9rem;">Belum ada ulasan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        {{-- ================= TAMPILAN KOLEKSI ================= --}}
        @elseif($page == 'koleksi')
            <div class="page-header">
                <h1>📚 Koleksi Saya</h1>
                <p>Buku-buku yang telah Anda baca dan berikan ulasan</p>
            </div>

            <div class="catalog-grid">
                @foreach($naskahs as $naskah)
                    <div class="book-card">
                        <div class="book-header">
                            <span class="book-badge {{ $naskah->price == 0 ? 'free' : 'paid' }}">
                                {{ $naskah->price == 0 ? 'Gratis' : 'Berbayar' }}
                            </span>
                            <span class="book-author">{{ $naskah->author->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="book-body">
                            <h3 class="book-title">{{ $naskah->title }}</h3>
                            <p class="book-excerpt">{{ Str::limit($naskah->content, 150) }}</p>
                            <div class="book-footer">
                                <a href="{{ route('reader.baca', $naskah->id) }}" class="btn btn-primary">Baca</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(!$naskahs || $naskahs->count() == 0)
                <div class="empty-state">
                    <div class="icon">📚</div>
                    <p>Koleksi Anda masih kosong</p>
                    <p style="font-size: 0.85rem; color: var(--muted);">Baca naskah dan berikan ulasan untuk menambahkan ke koleksi</p>
                </div>
            @endif

        {{-- ================= TAMPILAN FAVORIT ================= --}}
        @elseif($page == 'favorit')
            <div class="page-header">
                <h1>⭐ Buku Favorit Saya</h1>
                <p>Buku-buku yang Anda beri rating 5 bintang</p>
            </div>

            <div class="catalog-grid">
                @foreach($naskahs as $naskah)
                    <div class="book-card">
                        <div class="book-header">
                            <span class="book-badge {{ $naskah->price == 0 ? 'free' : 'paid' }}">
                                {{ $naskah->price == 0 ? 'Gratis' : 'Berbayar' }}
                            </span>
                            <span class="book-author">{{ $naskah->author->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="book-body">
                            <h3 class="book-title">{{ $naskah->title }}</h3>
                            <p class="book-excerpt">{{ Str::limit($naskah->content, 150) }}</p>
                            <div class="book-footer">
                                <a href="{{ route('reader.baca', $naskah->id) }}" class="btn btn-primary">Baca</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(!$naskahs || $naskahs->count() == 0)
                <div class="empty-state">
                    <div class="icon">⭐</div>
                    <p>Belum ada buku favorit</p>
                    <p style="font-size: 0.85rem; color: var(--muted);">Beri rating 5 bintang pada buku untuk menambahkan ke favorit</p>
                </div>
            @endif

        {{-- ================= TAMPILAN BOOKMARK ================= --}}
        @elseif($page == 'bookmark')
            <div class="page-header">
                <h1>🔖 Bookmark Saya</h1>
                <p>Buku-buku yang Anda anggap istimewa (rating 4-5 bintang)</p>
            </div>

            <div class="catalog-grid">
                @foreach($naskahs as $naskah)
                    <div class="book-card">
                        <div class="book-header">
                            <span class="book-badge {{ $naskah->price == 0 ? 'free' : 'paid' }}">
                                {{ $naskah->price == 0 ? 'Gratis' : 'Berbayar' }}
                            </span>
                            <span class="book-author">{{ $naskah->author->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="book-body">
                            <h3 class="book-title">{{ $naskah->title }}</h3>
                            <p class="book-excerpt">{{ Str::limit($naskah->content, 150) }}</p>
                            <div class="book-footer">
                                <a href="{{ route('reader.baca', $naskah->id) }}" class="btn btn-primary">Baca</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(!$naskahs || $naskahs->count() == 0)
                <div class="empty-state">
                    <div class="icon">🔖</div>
                    <p>Bookmark Anda masih kosong</p>
                    <p style="font-size: 0.85rem; color: var(--muted);">Beri rating 4-5 bintang pada buku untuk menyimpan ke bookmark</p>
                </div>
            @endif
        @endif
    </main>
</div>

</body>
</html>
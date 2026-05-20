<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — AnoKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:        #020617;   /* slate-950 */
            --surface:   #0f172a;   /* slate-900 */
            --surface2:  #1e293b;   /* slate-800 */
            --border:    rgba(255,255,255,0.1);
            --text:      #f1f5f9;   /* slate-100 */
            --muted:     #94a3b8;   /* slate-400 */
            --muted2:    #64748b;   /* slate-500 */
            --amber:     #f59e0b;
            --amber-dim: rgba(245,158,11,0.15);
            --amber-ring:rgba(245,158,11,0.2);
            --amber-text:#fcd34d;   /* amber-300 */
            --danger:    #f87171;
            --success:   #4ade80;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .wrap {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 3rem;
            max-width: 900px;
            width: 100%;
            align-items: center;
        }

        /* ── LEFT BRANDING ── */
        .brand { display: flex; flex-direction: column; gap: 1.5rem; }

        .logo {
            font-size: 2.25rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -1px;
        }

        .logo span { color: var(--amber-text); }

        .tagline { font-size: 1rem; color: var(--muted); line-height: 1.7; }

        .features { display: flex; flex-direction: column; gap: 1rem; }

        .feat {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            background: rgba(255,255,255,0.03);
        }

        .feat-icon { font-size: 1.25rem; flex-shrink: 0; }
        .feat-text { font-size: 0.85rem; color: var(--muted); line-height: 1.5; }
        .feat-text strong { color: var(--text); display: block; margin-bottom: 0.15rem; }

        /* ── CARD ── */
        .card {
            background: rgba(15,23,42,0.9);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            padding: 2rem;
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }

        .card-head { margin-bottom: 1.75rem; }

        .card-eyebrow {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--amber-text);
            margin-bottom: 0.5rem;
        }

        .card-title { font-size: 1.5rem; font-weight: 700; color: #fff; }
        .card-sub   { font-size: 0.875rem; color: var(--muted); margin-top: 0.3rem; }

        /* ── FORM ── */
        .form-group { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.5rem;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 0.7rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: 0.625rem;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--amber);
            box-shadow: 0 0 0 3px var(--amber-ring);
        }

        .form-error { font-size: 0.75rem; color: var(--danger); margin-top: 0.4rem; }

        .check-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .check-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--amber);
            cursor: pointer;
        }

        .check-row label {
            font-size: 0.85rem;
            color: var(--muted);
            text-transform: none;
            letter-spacing: 0;
            font-weight: 400;
            margin: 0;
            cursor: pointer;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem 1.5rem;
            border-radius: 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-amber {
            background: var(--amber);
            color: #020617;
        }

        .btn-amber:hover { background: #fbbf24; }

        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1.25rem 0;
        }

        .link-row {
            text-align: center;
            font-size: 0.875rem;
            color: var(--muted2);
        }

        .link-row a {
            color: var(--amber-text);
            text-decoration: none;
            font-weight: 500;
        }

        .link-row a:hover { text-decoration: underline; }

        .alert {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.85rem;
        }

        .alert-error   { background: rgba(248,113,113,0.1);  border: 1px solid rgba(248,113,113,0.3); color: var(--danger); }
        .alert-success { background: rgba(74,222,128,0.1);   border: 1px solid rgba(74,222,128,0.3);  color: var(--success); }

        @media (max-width: 700px) {
            .wrap { grid-template-columns: 1fr; }
            .brand { display: none; }
        }
    </style>
</head>
<body>

<div class="wrap">
    <div class="brand">
        <div class="logo">Ano<span>Kind</span></div>
        <p class="tagline">Platform digital untuk penulis, penerbit, dan pembaca buku naskah.</p>
        <div class="features">
            <div class="feat">
                <span class="feat-icon">📚</span>
                <div class="feat-text">
                    <strong>Terbitkan Karya Anda</strong>
                    Bagikan naskah Anda dengan pembaca di seluruh dunia
                </div>
            </div>
            <div class="feat">
                <span class="feat-icon">⭐</span>
                <div class="feat-text">
                    <strong>Dapatkan Ulasan</strong>
                    Terima feedback berharga dari komunitas pembaca
                </div>
            </div>
            <div class="feat">
                <span class="feat-icon">🏆</span>
                <div class="feat-text">
                    <strong>Raih Kesempatan</strong>
                    Jangan lewatkan peluang penerbitan dari penerbit profesional
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <p class="card-eyebrow">Masuk ke Akun</p>
            <h1 class="card-title">Selamat Datang Kembali</h1>
            <p class="card-sub">Akses dashboard sesuai peran Anda</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin-top: 0.4rem; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="check-row">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="btn btn-amber">Masuk ke Akun Saya</button>
        </form>

        <hr class="divider">

        @if (Route::has('password.request'))
            <div class="link-row" style="margin-bottom: 0.75rem;">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>
        @endif

        <div class="link-row">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>
</div>

</body>
</html>

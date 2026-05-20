<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — AnoKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:        #020617;
            --surface:   #0f172a;
            --surface2:  #1e293b;
            --border:    rgba(255,255,255,0.1);
            --text:      #f1f5f9;
            --muted:     #94a3b8;
            --muted2:    #64748b;
            --amber:     #f59e0b;
            --amber-dim: rgba(245,158,11,0.15);
            --amber-ring:rgba(245,158,11,0.2);
            --amber-text:#fcd34d;
            --danger:    #f87171;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 2rem 1.5rem;
        }

        .wrap { max-width: 760px; margin: 0 auto; }

        .header { text-align: center; margin-bottom: 2rem; }
        .logo { font-size: 2rem; font-weight: 700; color: #fff; letter-spacing: -1px; }
        .logo span { color: var(--amber-text); }
        .sub { font-size: 0.9rem; color: var(--muted); margin-top: 0.4rem; }

        .card {
            background: rgba(15,23,42,0.9);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            padding: 2rem 2.25rem;
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }

        .section-title {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--amber-text);
            margin-bottom: 1.25rem;
            margin-top: 0.25rem;
        }

        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1.5rem 0;
        }

        .form-group { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.4rem;
        }

        label .req { color: var(--amber); margin-left: 2px; }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
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

        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .role-opt { position: relative; }

        .role-opt input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .role-card {
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1rem;
            cursor: pointer;
            background: rgba(255,255,255,0.03);
            transition: all 0.2s;
        }

        .role-opt input[type="radio"]:checked + .role-card {
            border-color: var(--amber);
            background: var(--amber-dim);
            box-shadow: 0 0 0 3px var(--amber-ring);
        }

        .role-card:hover { border-color: rgba(245,158,11,0.4); }

        .role-icon { font-size: 1.5rem; margin-bottom: 0.4rem; }
        .role-name { font-size: 0.875rem; font-weight: 600; color: var(--text); }
        .role-desc { font-size: 0.75rem; color: var(--muted); margin-top: 0.2rem; line-height: 1.4; }

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

        .btn-amber { background: var(--amber); color: #020617; }
        .btn-amber:hover { background: #fbbf24; }

        .link-row {
            text-align: center;
            font-size: 0.875rem;
            color: var(--muted2);
            margin-top: 1.25rem;
        }

        .link-row a { color: var(--amber-text); text-decoration: none; font-weight: 500; }
        .link-row a:hover { text-decoration: underline; }

        .alert-error {
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.3);
            color: var(--danger);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }

        @media (max-width: 540px) {
            .role-grid { grid-template-columns: 1fr; }
            .card { padding: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="wrap">
    <div class="header">
        <div class="logo">Ano<span>Kind</span></div>
        <p class="sub">Bergabunglah dengan komunitas penulis, penerbit, dan pembaca naskah</p>
    </div>

    <div class="card">
        @if ($errors->any())
            <div class="alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin-top: 0.4rem; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Data Pribadi --}}
            <p class="section-title">Data Pribadi</p>

            <div class="form-group">
                <label for="name">Nama Lengkap <span class="req">*</span></label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email <span class="req">*</span></label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <hr class="divider">

            {{-- Pilih Role --}}
            <p class="section-title">Daftar Sebagai</p>

            <div class="role-grid">
                <label class="role-opt">
                    <input type="radio" name="role" value="reader" {{ old('role') === 'reader' ? 'checked' : '' }} required>
                    <div class="role-card">
                        <div class="role-icon">📖</div>
                        <div class="role-name">Pembaca</div>
                        <div class="role-desc">Baca dan ulasi naskah dari penulis berbakat</div>
                    </div>
                </label>
                <label class="role-opt">
                    <input type="radio" name="role" value="author" {{ old('role') === 'author' ? 'checked' : '' }}>
                    <div class="role-card">
                        <div class="role-icon">✍️</div>
                        <div class="role-name">Penulis</div>
                        <div class="role-desc">Terbitkan naskah Anda dan dapatkan ulasan</div>
                    </div>
                </label>
                <label class="role-opt">
                    <input type="radio" name="role" value="publisher" {{ old('role') === 'publisher' ? 'checked' : '' }}>
                    <div class="role-card">
                        <div class="role-icon">🏢</div>
                        <div class="role-name">Penerbit</div>
                        <div class="role-desc">Kelola penerbitan buku fisik dan digital</div>
                    </div>
                </label>
                <label class="role-opt">
                    <input type="radio" name="role" value="buyer" {{ old('role') === 'buyer' ? 'checked' : '' }}>
                    <div class="role-card">
                        <div class="role-icon">🛒</div>
                        <div class="role-name">Pembeli</div>
                        <div class="role-desc">Beli dan koleksi buku fisik berkualitas</div>
                    </div>
                </label>
            </div>
            @error('role') <div class="form-error" style="margin-bottom:1rem;">{{ $message }}</div> @enderror

            <hr class="divider">

            {{-- Keamanan --}}
            <p class="section-title">Keamanan</p>

            <div class="form-group">
                <label for="password">Password <span class="req">*</span></label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password <span class="req">*</span></label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-amber" style="margin-top: 0.5rem;">Daftar Akun Saya</button>
        </form>

        <div class="link-row">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>

</body>
</html>

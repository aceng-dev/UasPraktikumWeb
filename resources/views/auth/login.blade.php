<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — AnoKind</title>
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
            background: linear-gradient(135deg, var(--paper) 0%, #f9f7f3 100%);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            max-width: 900px;
            width: 100%;
            align-items: center;
        }

        .branding {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            color: var(--amber);
            letter-spacing: -1px;
        }

        .tagline {
            font-size: 1.1rem;
            color: var(--muted);
            line-height: 1.6;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }

        .feature {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .feature-icon {
            font-size: 1.5rem;
            color: var(--amber);
            flex-shrink: 0;
        }

        .feature-text {
            font-size: 0.9rem;
            color: var(--muted);
        }

        .login-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
        }

        .card-subtitle {
            color: var(--muted);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--ink);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(200, 134, 42, 0.12);
            background: white;
        }

        .form-error {
            font-size: 0.78rem;
            color: var(--danger);
            margin-top: 0.35rem;
        }

        .error-list {
            background: #fdecea;
            border: 1px solid #f5c6c6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            color: var(--danger);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--amber);
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: var(--muted);
            cursor: pointer;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-primary {
            background: var(--amber);
            color: white;
        }

        .btn-primary:hover {
            background: #b07020;
        }

        .auth-footer {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: var(--amber);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .forgot-password {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .forgot-password a {
            color: var(--amber);
            font-size: 0.85rem;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }

            .branding {
                display: none;
            }

            .logo {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="branding">
        <div class="logo">AnoKind</div>
        <div class="tagline">Platform digital untuk penulis, penerbit, dan pembaca buku naskah.</div>
        <div class="features">
            <div class="feature">
                <div class="feature-icon">📚</div>
                <div class="feature-text"><strong>Terbitkan Karya Anda</strong><br>Bagikan naskah Anda dengan pembaca di seluruh dunia</div>
            </div>
            <div class="feature">
                <div class="feature-icon">⭐</div>
                <div class="feature-text"><strong>Dapatkan Ulasan</strong><br>Terima feedback berharga dari komunitas pembaca</div>
            </div>
            <div class="feature">
                <div class="feature-icon">🏆</div>
                <div class="feature-text"><strong>Raih Kesempatan</strong><br>Jangan lewatkan peluang penerbitan dari penerbit profesional</div>
            </div>
        </div>
    </div>

    <div class="login-card">
        <div class="card-title">Masuk</div>
        <div class="card-subtitle">Akses akun AnoKind Anda</div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="error-list">
                <strong>❌ Terjadi kesalahan:</strong>
                <ul style="margin-top: 0.5rem; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Session Status --}}
        @if (session('status'))
            <div style="background: #e8f5eb; border: 1px solid #b8dfc0; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; color: var(--success); font-size: 0.9rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Address --}}
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="checkbox-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya di perangkat ini</label>
            </div>

            {{-- Login Button --}}
            <button type="submit" class="btn btn-primary">Masuk ke Akun Saya</button>

            {{-- Forgot Password --}}
            @if (Route::has('password.request'))
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                </div>
            @endif

            {{-- Register Link --}}
            <div class="auth-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

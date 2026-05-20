<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — AnoKind</title>
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
            padding: 2rem 1rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--amber);
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: var(--muted);
            font-size: 0.95rem;
        }

        .register-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--ink);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group:last-child {
            margin-bottom: 0;
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

        .form-label .required {
            color: var(--amber);
            margin-left: 2px;
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

        /* Role Selection */
        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .role-option {
            position: relative;
        }

        .role-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .role-card {
            border: 2px solid var(--border);
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            background: var(--cream);
        }

        .role-option input[type="radio"]:checked + .role-card {
            border-color: var(--amber);
            background: rgba(200, 134, 42, 0.05);
            box-shadow: 0 0 0 3px rgba(200, 134, 42, 0.12);
        }

        .role-card:hover {
            border-color: var(--amber-light);
        }

        .role-icon {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .role-name {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .role-description {
            font-size: 0.8rem;
            color: var(--muted);
            line-height: 1.4;
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

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            align-items: center;
            justify-content: space-between;
        }

        .form-actions .auth-link {
            text-align: center;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .form-actions a {
            color: var(--amber);
            text-decoration: none;
            font-weight: 500;
        }

        .form-actions a:hover {
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .role-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .register-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="logo">AnoKind</div>
        <p class="subtitle">Bergabunglah dengan komunitas penulis, penerbit, dan pembaca naskah</p>
    </div>

    <div class="register-card">
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Data Pribadi --}}
            <div class="form-section">
                <div class="section-title">Data Pribadi</div>

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Pilih Role --}}
            <div class="form-section">
                <div class="section-title">Daftar Sebagai</div>

                <div class="role-grid">
                    <label class="role-option">
                        <input type="radio" name="role" value="reader" {{ old('role') === 'reader' ? 'checked' : '' }} required>
                        <div class="role-card">
                            <div class="role-icon">📖</div>
                            <div class="role-name">Pembaca</div>
                            <div class="role-description">Baca dan ulasi naskah dari penulis berbakat</div>
                        </div>
                    </label>

                    <label class="role-option">
                        <input type="radio" name="role" value="author" {{ old('role') === 'author' ? 'checked' : '' }} required>
                        <div class="role-card">
                            <div class="role-icon">✍️</div>
                            <div class="role-name">Penulis</div>
                            <div class="role-description">Terbitkan naskah Anda dan dapatkan ulasan</div>
                        </div>
                    </label>

                    <label class="role-option">
                        <input type="radio" name="role" value="publisher" {{ old('role') === 'publisher' ? 'checked' : '' }} required>
                        <div class="role-card">
                            <div class="role-icon">🏢</div>
                            <div class="role-name">Penerbit</div>
                            <div class="role-description">Kelola penerbitan buku fisik dan digital</div>
                        </div>
                    </label>

                    <label class="role-option">
                        <input type="radio" name="role" value="buyer" {{ old('role') === 'buyer' ? 'checked' : '' }} required>
                        <div class="role-card">
                            <div class="role-icon">🛒</div>
                            <div class="role-name">Pembeli</div>
                            <div class="role-description">Beli dan koleksi buku fisik berkualitas</div>
                        </div>
                    </label>
                </div>

                @error('role')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-section">
                <div class="section-title">Keamanan</div>

                <div class="form-group">
                    <label for="password" class="form-label">Password <span class="required">*</span></label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="required">*</span></label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="flex: 1;">Daftar Akun Saya</button>
            </div>

            <div style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: var(--muted);">
                Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--amber); text-decoration: none; font-weight: 500;">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
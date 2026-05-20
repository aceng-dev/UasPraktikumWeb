<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnoKind — Selamat Datang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-96 bg-gradient-to-b from-slate-900 via-slate-950 to-transparent blur-3xl"></div>
        <div class="px-6 py-10 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-16 lg:grid-cols-[1.4fr_1fr] lg:items-center">
                    <div class="space-y-8">
                        <div class="max-w-2xl">
                            <p class="inline-flex rounded-full bg-amber-500/15 px-4 py-1 text-sm font-semibold text-amber-200 ring-1 ring-amber-500/20">Selamat Datang di AnoKind</p>
                            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">Platform Buku Digital untuk Penulis, Pembeli, Penerbit, dan Pembaca</h1>
                            <p class="mt-6 text-lg leading-8 text-slate-300">Kelola peran Anda dengan mulus: masuk sebagai Author, Reader, Publisher, Buyer, atau Admin untuk mengakses dashboard sesuai kebutuhan.</p>
                        </div>

                        <div class="grid gap-4 sm:max-w-xl sm:grid-cols-2">
                            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                                <p class="text-2xl">📚</p>
                                <h2 class="mt-4 text-xl font-semibold text-white">Penulis</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-300">Terbitkan naskah, kelola konten, dan dapatkan feedback dari pembaca.</p>
                            </div>
                            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                                <p class="text-2xl">🛒</p>
                                <h2 class="mt-4 text-xl font-semibold text-white">Pembeli</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-300">Temukan buku berkualitas dan kelola pesanan Anda dengan mudah.</p>
                            </div>
                            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                                <p class="text-2xl">🧑‍🤝‍🧑</p>
                                <h2 class="mt-4 text-xl font-semibold text-white">Pembaca</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-300">Baca naskah digital, beri ulasan, dan simpan buku favoritmu.</p>
                            </div>
                            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                                <p class="text-2xl">🏢</p>
                                <h2 class="mt-4 text-xl font-semibold text-white">Penerbit</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-300">Kelola penerbitan, katalog dan distribusi buku fisik secara profesional.</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-slate-900/90 p-8 shadow-2xl ring-1 ring-white/10 backdrop-blur-xl">
                        <div class="space-y-6">
                            <div class="space-y-3 text-center">
                                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-amber-300">Masuk atau Daftar</p>
                                <h2 class="text-2xl font-bold text-white">Akses Dashboard Anda</h2>
                                <p class="text-sm leading-6 text-slate-400">Gunakan akun Anda untuk masuk dan lanjutkan ke area peran yang sesuai.</p>
                            </div>

                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/' . Auth::user()->role . '/dashboard') }}" class="block rounded-2xl bg-amber-500 px-5 py-3 text-center text-sm font-semibold text-slate-950 transition hover:bg-amber-400">Lanjut ke Dashboard ({{ strtoupper(Auth::user()->role) }})</a>
                                @else
                                    <div class="grid gap-4">
                                        <a href="{{ route('login') }}" class="rounded-2xl bg-white px-5 py-3 text-center text-sm font-semibold text-slate-950 shadow-sm transition hover:bg-slate-100">Log In</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="rounded-2xl border border-white/10 bg-slate-800 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-700">Register Akun Baru</a>
                                        @endif
                                    </div>
                                @endauth
                            @endif

                            <div class="rounded-3xl border border-white/10 bg-slate-950/70 p-5">
                                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Fitur utamanya</p>
                                <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                                    <li class="flex items-start gap-3"><span class="mt-1 text-amber-300">✓</span> Multi-role dengan dashboard terpisah untuk setiap peran.</li>
                                    <li class="flex items-start gap-3"><span class="mt-1 text-amber-300">✓</span> Sistem autentikasi aman dengan register & login.</li>
                                    <li class="flex items-start gap-3"><span class="mt-1 text-amber-300">✓</span> Desain UI responsif untuk desktop dan mobile.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
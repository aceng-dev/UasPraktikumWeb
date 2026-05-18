<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Reader - Perpustakaan Digital</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <div class="max-w-6xl mx-auto px-4 py-8">
        
        {{-- ================= TAMPILAN KATALOG NASKAH ================= --}}
        @if($page == 'katalog')
            <header class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Katalog Naskah Digital</h1>
                <p class="text-gray-600">Jelajahi karya-karya terbaik dari para Author kami.</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($naskahs as $naskah)
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $naskah['tipe'] == 'Gratis' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $naskah['tipe'] }}
                                </span>
                                <span class="text-sm text-gray-500">Oleh: {{ $naskah['author'] }}</span>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $naskah['judul'] }}</h2>
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $naskah['sinopsis'] }}</p>
                        </div>
                        
                        <a href="{{ route('reader.baca', $naskah['id']) }}" class="w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition">
                            Baca Naskah
                        </a>
                    </div>
                @endforeach
            </div>

        {{-- ================= TAMPILAN RUANG BACA NYAMAN & REVIEW ================= --}}
        @elseif($page == 'baca')
            <a href="{{ route('reader.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:underline mb-6">
                ← Kembali ke Katalog
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-indigo-50 border border-indigo-200 shadow-xs rounded-lg overflow-hidden">
                        <div class="bg-indigo-600 px-6 py-3 flex justify-between items-center text-white">
                            <div class="flex items-center gap-2 font-semibold tracking-wide text-sm uppercase">
                                ✨ AI Academic Insight & Summary
                            </div>
                            
                            <form action="{{ route('reader.summary', $naskah['id']) }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="konten_naskah" value="{{ $naskah['konten'] }}">
                                <button type="submit" class="bg-white hover:bg-zinc-100 text-indigo-700 text-xs font-bold uppercase px-4 py-2 rounded-md shadow-sm transition flex items-center gap-1 cursor-pointer">
                                    🚀 Jalankan AI Summary
                                </button>
                            </form>
                        </div>

                        <div class="p-6 bg-white">
                            @if(session('hasil_ai'))
                                <article class="prose max-w-none text-zinc-700 text-sm leading-relaxed font-sans whitespace-pre-line">
                                    {!! nl2br(e(session('hasil_ai'))) !!}
                                </article>
                            @elseif(session('error_ai'))
                                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 text-sm">
                                    ⚠️ {{ session('error_ai') }}
                                </div>
                            @else
                                <p class="text-xs text-zinc-500 italic font-sans">
                                    Butuh waktu cepat untuk memahami isi cerita? Klik tombol **"Jalankan AI Summary"** di atas untuk merangkum naskah secara otomatis via Agent AI.
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-amber-50/40 border border-amber-100 rounded-xl p-8 shadow-sm">
                        <header class="border-b border-amber-200/60 pb-4 mb-6">
                            <h1 class="text-4xl font-serif font-bold text-gray-900 mb-2">{{ $naskah['judul'] }}</h1>
                            <p class="text-gray-600 font-medium">Karya: {{ $naskah['author'] }}</p>
                        </header>

                        <article class="prose prose-lg font-serif text-gray-800 leading-relaxed tracking-wide text-justify">
                            {{ $naskah['konten'] }}
                        </article>
                        
                        <div class="mt-8 pt-4 border-t border-amber-200/60 flex justify-end">
                            <button onclick="alert('Halaman berhasil ditandai (Bookmark)!')" class="inline-flex items-center text-sm bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded shadow-xs transition">
                                📌 Tandai Halaman Terakhir
                            </button>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Berikan Ulasan</h3>
                        
                        @if(session('success'))
                            <div class="bg-green-100 text-green-800 p-3 rounded-md text-sm mb-4">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('reader.review.store', $naskah['id']) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rating Bintang</label>
                                <select name="rating" class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Bagus)</option>
                                    <option value="4">⭐⭐⭐⭐ (4 - Bagus)</option>
                                    <option value="3">⭐⭐⭐ (3 - Lumayan)</option>
                                    <option value="2">⭐⭐ (2 - Kurang)</option>
                                    <option value="1">⭐ (1 - Buruk)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ulasan Anda</label>
                                <textarea name="komentar" rows="4" class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Tulis pendapatmu tentang naskah ini..." required></textarea>
                            </div>

                            <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded transition text-sm">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ulasan Pembaca</h3>
                        <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2">
                            @if(isset($naskah['reviews']) && count($naskah['reviews']) > 0)
                                @foreach($naskah['reviews'] as $rev)
                                    <div class="border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-sm text-gray-900">{{ $rev['user'] }}</span>
                                            <span class="text-amber-500 text-xs">
                                                {{ str_repeat('★', $rev['rating']) }}{{ str_repeat('☆', 5 - $rev['rating']) }}
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-xs leading-relaxed">{{ $rev['komentar'] }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-xs text-zinc-400 italic">Belum ada ulasan untuk naskah ini.</p>
                            @endif
                        </div>
                    </div>
                </div> </div>
        @endif

    </div>

</body>
</html>
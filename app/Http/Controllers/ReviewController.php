<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // 1. Menampilkan Halaman Katalog
    public function index()
    {
        $naskahs = collect([
            ['id' => 1, 'judul' => 'Misteri Kota Palu', 'author' => 'Dimas', 'tipe' => 'Gratis', 'sinopsis' => 'Kisah misteri di balik senja...'],
            ['id' => 2, 'judul' => 'Belajar Laravel Mobile', 'author' => 'Budi', 'tipe' => 'Berbayar', 'sinopsis' => 'Panduan lengkap dari nol sampai mahir.'],
        ]);

        return view('dashboards.reader', ['page' => 'katalog', 'naskahs' => $naskahs]);
    }

    // 2. Menampilkan Ruang Baca Nyaman
    public function baca($id)
    {
        $koleksiNaskah = [
            1 => [
                'id' => 1,
                'judul' => 'Misteri Kota Palu',
                'author' => 'Dimas',
                'konten' => 'Ini adalah isi konten untuk naskah Pertama tentang Misteri Kota Palu. Cerita dimulai pada suatu senja di Teluk Palu, di mana angin berhembus tidak seperti biasanya...',
                'reviews' => [
                    ['user' => 'Andi', 'rating' => 5, 'komentar' => 'Ceritanya seru banget, parah!'],
                    ['user' => 'Siti', 'rating' => 4, 'komentar' => 'Suka dengan gaya bahasanya yang mengalir.'],
                ]
            ],
            2 => [
                'id' => 2,
                'judul' => 'Belajar Laravel Mobile',
                'author' => 'Budi',
                'konten' => 'Ini adalah isi konten untuk naskah Kedua tentang Belajar Laravel Mobile. Pada bab ini, kita akan membedah bagaimana cara mengintegrasikan sistem backend Laravel dengan aplikasi mobile...',
                'reviews' => [
                    ['user' => 'Rian', 'rating' => 5, 'komentar' => 'Sangat membantu untuk tugas akhir saya!'],
                ]
            ]
        ];

        $naskah = $koleksiNaskah[$id] ?? [
            'id' => $id,
            'judul' => 'Naskah Tidak Ditemukan',
            'author' => 'Anonim',
            'konten' => 'Maaf, konten naskah digital ini belum tersedia.',
            'reviews' => []
        ];

        // AMBIL ULASAN TAMBAHAN DARI SESSION (JIKA ADA)
        // Kita ambil ulasan yang pernah di-submit user khusus untuk ID naskah ini
        $customReviews = session()->get("custom_reviews.{$id}", []);
        
        // Gabungkan ulasan bawaan dummy dengan ulasan baru dari session
        $naskah['reviews'] = array_merge($naskah['reviews'], $customReviews);

        return view('dashboards.reader', ['page' => 'baca', 'naskah' => $naskah]);
    }

    // 3. Menyimpan Rating dan Ulasan (Simulasi via Session)
    public function storeReview(Request $request, $naskah_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        // Ambil nama user yang sedang login, atau gunakan 'Pembaca Anonim' jika tidak ada
        $namaUser = auth()->user()->name ?? 'Pembaca Anonim';

        // Buat struktur data ulasan baru
        $newReview = [
            'user' => $namaUser,
            'rating' => (int)$request->rating,
            'komentar' => $request->komentar
        ];

        // Simpan ke dalam Session Array berdasarkan ID naskahnya
        session()->push("custom_reviews.{$naskah_id}", $newReview);

        return redirect()->back()->with('success', 'Ulasan dan rating berhasil dikirim!');
    }

    // 4. Ringkas naskah dengan fitur AI sederhana
    public function summary(Request $request, $id)
    {
        $request->validate([
            'konten_naskah' => 'required|string',
        ]);

        $konten = trim($request->input('konten_naskah'));
        $kalimat = preg_split('/(?<=[.?!])\s+/', $konten, -1, PREG_SPLIT_NO_EMPTY);

        if (!$konten || empty($kalimat)) {
            return redirect()->back()->with('error_ai', 'Konten naskah tidak tersedia untuk di-ringkas.');
        }

        $ringkasan = count($kalimat) <= 3
            ? implode(' ', $kalimat)
            : implode(' ', array_slice($kalimat, 0, 3));

        session()->flash('hasil_ai', "Ringkasan singkat:\n\n{$ringkasan}");
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Naskah; // Pastikan sesuaikan dengan nama Model naskah di proyek kalian
// use App\Models\Review; // Pastikan sesuaikan dengan nama Model review kalian

class ReviewController extends Controller
{
    // 1. Menampilkan Halaman Katalog
    public function index()
    {
        // Contoh data dummy jika model belum siap. 
        // Nanti ganti dengan: $naskahs = Naskah::where('status', 'published')->get();
        $naskahs = collect([
            ['id' => 1, 'judul' => 'Misteri Kota Palu', 'author' => 'Dimas', 'tipe' => 'Gratis', 'sinopsis' => 'Kisah misteri di balik senja...'],
            ['id' => 2, 'judul' => 'Belajar Laravel Mobile', 'author' => 'Budi', 'tipe' => 'Berbayar', 'sinopsis' => 'Panduan lengkap dari nol sampai mahir.'],
        ]);

        return view('reader', ['page' => 'katalog', 'naskahs' => $naskahs]);
    }

    // 2. Menampilkan Ruang Baca Nyaman
    public function baca($id)
    {
        // Nanti ganti dengan: $naskah = Naskah::findOrFail($id);
        // Contoh data dummy naskah detail:
        $naskah = [
            'id' => $id,
            'judul' => 'Misteri Kota Palu',
            'author' => 'Dimas',
            'konten' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'reviews' => [
                ['user' => 'Andi', 'rating' => 5, 'komentar' => 'Ceritanya seru banget, parah!'],
                ['user' => 'Siti', 'rating' => 4, 'komentar' => 'Suka dengan gaya bahasanya yang mengalir.'],
            ]
        ];

        return view('reader', ['page' => 'baca', 'naskah' => $naskah]);
    }

    // 3. Menyimpan Rating dan Ulasan
    public function storeReview(Request $request, $naskah_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        // Logika simpan ke database (sesuaikan dengan struktur table kalian)
        // Review::create([
        //     'user_id' => auth()->id(), // jika ada sistem login
        //     'naskah_id' => $naskah_id,
        //     'rating' => $request->rating,
        //     'komentar' => $request->komentar,
        // ]);

        return redirect()->back()->with('success', 'Ulasan dan rating berhasil dikirim!');
    }
}
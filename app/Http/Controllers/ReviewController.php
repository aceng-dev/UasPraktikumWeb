<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ReaderAgent;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // 1. Menampilkan Halaman Katalog - data dari database
    public function index()
    {
        $naskahs = Book::where('status', 'published')
                       ->with('author')
                       ->withAvg('reviews', 'rating')
                       ->latest()
                       ->get();

        return view('dashboards.reader', [
            'page'    => 'katalog',
            'naskahs' => $naskahs,
        ]);
    }

    // 2. Menampilkan Ruang Baca
    public function baca($id)
    {
        $naskah = Book::where('id', $id)
                      ->where('status', 'published')
                      ->with(['author', 'reviews.user'])
                      ->firstOrFail();

        return view('dashboards.reader', [
            'page'   => 'baca',
            'naskah' => $naskah,
        ]);
    }

    // 3. Simpan Review ke Database
    public function storeReview(Request $request, $naskah_id)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        // Cek apakah user sudah pernah review buku ini
        $sudahReview = Review::where('book_id', $naskah_id)
                             ->where('user_id', Auth::id())
                             ->exists();

        if ($sudahReview) {
            return redirect()->back()->with('error', 'Kamu sudah pernah memberikan ulasan untuk buku ini.');
        }

        Review::create([
            'book_id'  => $naskah_id,
            'user_id'  => Auth::id(),
            'rating'   => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Ulasan dan rating berhasil dikirim!');
    }

    // 4. Ringkas naskah menggunakan AI (ReaderAgent + Gemini)
    public function summary(Request $request, $id)
    {
        $request->validate([
            'konten_naskah' => 'required|string',
        ]);

        $konten = trim($request->input('konten_naskah'));

        if (!$konten) {
            return redirect()->back()->with('error_ai', 'Konten naskah tidak tersedia untuk diringkas.');
        }

        try {
            $ringkasan = ReaderAgent::make()->prompt(
                "Berikut adalah isi naskah yang perlu diringkas:\n\n{$konten}\n\nTolong buatkan ringkasan yang singkat, padat, dan mudah dipahami.",
                provider: 'gemini'
            );

            session()->flash('hasil_ai',(string) $ringkasan);
        } catch (\Exception $e) {
            session()->flash('error_ai', $e->getMessage());
        }
        return redirect()->back();
    }

    // 5. Menampilkan Koleksi - buku yang sudah user review
    public function koleksi()
    {
        $naskahs = Book::whereHas('reviews', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with('author')
        ->withAvg('reviews', 'rating')
        ->get();

        return view('dashboards.reader', [
            'page'    => 'koleksi',
            'naskahs' => $naskahs,
        ]);
    }

    // 6. Menampilkan Favorit - buku dengan rating 5 dari user
    public function favorit()
    {
        $naskahs = Book::whereHas('reviews', function ($query) {
            $query->where('user_id', Auth::id())
                  ->where('rating', 5);
        })
        ->with('author')
        ->withAvg('reviews', 'rating')
        ->get();

        return view('dashboards.reader', [
            'page'    => 'favorit',
            'naskahs' => $naskahs,
        ]);
    }

    // 7. Menampilkan Bookmark - buku dengan rating 4-5 dari user
    public function bookmark()
    {
        $naskahs = Book::whereHas('reviews', function ($query) {
            $query->where('user_id', Auth::id())
                  ->whereIn('rating', [4, 5]);
        })
        ->with('author')
        ->withAvg('reviews', 'rating')
        ->get();

        return view('dashboards.reader', [
            'page'    => 'bookmark',
            'naskahs' => $naskahs,
        ]);
    }
}
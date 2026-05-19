<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    // 1. Dashboard Author - tampilkan semua buku milik author yg login
    public function index()
    {
        $books = Book::where('author_id', Auth::id())
                     ->withCount('reviews')
                     ->withAvg('reviews', 'rating')
                     ->latest()
                     ->get();

        return view('dashboards.author', [
            'page'  => 'dashboard',
            'books' => $books,
        ]);
    }

    // 2. Form Tambah Buku Baru
    public function create()
    {
        return view('dashboards.author', ['page' => 'create']);
    }

    // 3. Simpan Buku Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'price'    => 'required|numeric|min:0',
            'coverUrl' => 'nullable|url|max:500',
            'status'   => 'required|in:draft,published',
        ]);

        Book::create([
            'author_id' => Auth::id(),
            'user_id'   => Auth::id(),
            'title'     => $request->input('title'),
            'content'   => $request->input('content'),
            'price'     => $request->input('price'),
            'coverUrl'  => $request->input('coverUrl'),
            'status'    => $request->input('status'),
        ]);

        return redirect()->route('author.dashboard')
                         ->with('success', 'Buku berhasil diterbitkan!');
    }

    // 4. Form Edit Buku
    public function edit($id)
    {
        $book = Book::where('id', $id)
                    ->where('author_id', Auth::id())
                    ->firstOrFail();

        return view('dashboards.author', [
            'page' => 'edit',
            'book' => $book,
        ]);
    }

    // 5. Update Buku di Database
    public function update(Request $request, $id)
    {
        $book = Book::where('id', $id)
                    ->where('author_id', Auth::id())
                    ->firstOrFail();

        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'price'    => 'required|numeric|min:0',
            'coverUrl' => 'nullable|url|max:500',
            'status'   => 'required|in:draft,published',
        ]);

        $book->update([
            'title'    => $request->input('title'),
            'content'  => $request->input('content'),
            'price'    => $request->input('price'),
            'coverUrl' => $request->input('coverUrl'),
            'status'   => $request->input('status'),
        ]);

        return redirect()->route('author.dashboard')
                         ->with('success', 'Buku berhasil diperbarui!');
    }

    // 6. Hapus Buku
    public function destroy($id)
    {
        $book = Book::where('id', $id)
                    ->where('author_id', Auth::id())
                    ->firstOrFail();

        $book->delete();

        return redirect()->route('author.dashboard')
                         ->with('success', 'Buku berhasil dihapus.');
    }
}
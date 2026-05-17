<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // =============================
    // KATALOG - Tampilkan semua buku
    // =============================
    public function katalog()
    {
        $books = Book::all();
        return view('dashboards.buyer', compact('books'));
    }

    // =============================
    // CART - Tampilkan isi keranjang
    // =============================
    public function keranjang()
    {
        $carts = Cart::with('book')
                    ->where('user_id', Auth::id())
                    ->get();

        return view('dashboards.buyer', compact('carts'));
    }

    // =============================
    // CART - Tambah buku ke keranjang
    // =============================
    public function tambahKeKeranjang(Request $request)
    {
        $request->validate([
            'book_id'  => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cek apakah buku sudah ada di keranjang
        $cart = Cart::where('user_id', Auth::id())
                    ->where('book_id', $request->book_id)
                    ->first();

        if ($cart) {
            // Kalau sudah ada, tambah quantity saja
            $cart->increment('quantity', $request->quantity);
        } else {
            // Kalau belum ada, buat baru
            Cart::create([
                'user_id'  => Auth::id(),
                'book_id'  => $request->book_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    // =============================
    // CART - Hapus dari keranjang
    // =============================
    public function hapusDariKeranjang($id)
    {
        $cart = Cart::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $cart->delete();

        return redirect()->back()->with('success', 'Buku dihapus dari keranjang!');
    }

    // =============================
    // ORDER - Proses Checkout
    // =============================
    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
        ]);

        // Ambil semua item di keranjang milik user ini
        $carts = Cart::with('book')
                    ->where('user_id', Auth::id())
                    ->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong!');
        }

        // Buat order untuk setiap item di keranjang
        foreach ($carts as $cart) {
            Order::create([
                'user_id'          => Auth::id(),
                'book_id'          => $cart->book_id,
                'quantity'         => $cart->quantity,
                'total_price'      => $cart->book->price * $cart->quantity,
                'status'           => 'pending',
                'shipping_address' => $request->shipping_address,
            ]);
        }

        // Kosongkan keranjang setelah checkout
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }

    // =============================
    // ORDER - Riwayat pembelian
    // =============================
    public function riwayat()
    {
        $orders = Order::with('book')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('dashboards.buyer', compact('orders'));
    }
}
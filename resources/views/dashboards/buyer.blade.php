<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer - Toko Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

{{-- NAVBAR --}}
<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">📚 Toko Buku</h1>
    <div class="flex gap-4">
        <a href="{{ route('buyer.katalog') }}" class="text-gray-600 hover:text-blue-600">Katalog</a>
        <a href="{{ route('buyer.keranjang') }}" class="text-gray-600 hover:text-blue-600">🛒 Keranjang</a>
        <a href="{{ route('buyer.riwayat') }}" class="text-gray-600 hover:text-blue-600">Riwayat</a>
    </div>
</nav>

<div class="max-w-5xl mx-auto px-4 py-8">

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif


    {{-- ================================ --}}
    {{-- HALAMAN KATALOG --}}
    {{-- ================================ --}}
    @isset($books)
    <h2 class="text-2xl font-bold mb-6">📖 Katalog Buku</h2>

    @if($books->isEmpty())
        <p class="text-gray-500">Belum ada buku tersedia.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($books as $book)
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-bold text-lg">{{ $book->title }}</h3>
                <p class="text-gray-500 text-sm mb-1">{{ $book->author ?? '-' }}</p>
                <p class="text-blue-600 font-semibold mb-4">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </p>

                {{-- Form tambah ke keranjang --}}
                <form action="{{ route('buyer.cart.tambah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div class="flex items-center gap-2 mb-3">
                        <label class="text-sm text-gray-600">Qty:</label>
                        <input type="number" name="quantity" value="1" min="1"
                            class="w-16 border rounded px-2 py-1 text-sm">
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 text-sm">
                        + Keranjang
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    @endif
    @endisset


    {{-- ================================ --}}
    {{-- HALAMAN KERANJANG --}}
    {{-- ================================ --}}
    @isset($carts)
    <h2 class="text-2xl font-bold mb-6">🛒 Keranjang Belanja</h2>

    @if($carts->isEmpty())
        <p class="text-gray-500">Keranjang kamu kosong. <a href="{{ route('buyer.katalog') }}" class="text-blue-600 underline">Belanja sekarang</a></p>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left px-4 py-3">Buku</th>
                        <th class="text-center px-4 py-3">Qty</th>
                        <th class="text-right px-4 py-3">Subtotal</th>
                        <th class="text-center px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carts as $cart)
                    @php $subtotal = $cart->book->price * $cart->quantity; $total += $subtotal; @endphp
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <p class="font-semibold">{{ $cart->book->title }}</p>
                            <p class="text-gray-400">Rp {{ number_format($cart->book->price, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-4 py-3 text-center">{{ $cart->quantity }}</td>
                        <td class="px-4 py-3 text-right font-semibold">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('buyer.cart.hapus', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="2" class="px-4 py-3 font-bold">Total</td>
                        <td class="px-4 py-3 text-right font-bold text-blue-600">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Form Checkout --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-bold text-lg mb-4">Proses Checkout</h3>
            <form action="{{ route('buyer.checkout') }}" method="POST">
                @csrf
                <label class="block text-sm text-gray-600 mb-1">Alamat Pengiriman</label>
                <textarea name="shipping_address" rows="3" required
                    class="w-full border rounded px-3 py-2 mb-4 text-sm"
                    placeholder="Masukkan alamat lengkap..."></textarea>
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    ✅ Checkout Sekarang
                </button>
            </form>
        </div>
    @endif
    @endisset


    {{-- ================================ --}}
    {{-- HALAMAN RIWAYAT ORDER --}}
    {{-- ================================ --}}
    @isset($orders)
    <h2 class="text-2xl font-bold mb-6">📋 Riwayat Pesanan</h2>

    @if($orders->isEmpty())
        <p class="text-gray-500">Belum ada pesanan. <a href="{{ route('buyer.katalog') }}" class="text-blue-600 underline">Mulai belanja</a></p>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-bold">{{ $order->book->title }}</p>
                        <p class="text-sm text-gray-500">Qty: {{ $order->quantity }}</p>
                        <p class="text-sm text-gray-500">Alamat: {{ $order->shipping_address }}</p>
                        <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-600">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </p>
                        <span class="inline-block mt-1 px-2 py-1 text-xs rounded-full
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $order->status === 'paid' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $order->status === 'shipped' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @endisset

</div>
</body>
</html>
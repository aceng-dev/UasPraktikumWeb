<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

{{-- NAVBAR --}}
<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">📚 Admin</h1>
    <div class="flex gap-4">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
        </form>
    </div>
</nav>

<div class="max-w-6xl mx-auto px-4 py-8">

    {{-- FLASH MESSAGES --}}
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

    {{-- STATISTIK CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Total User</p>
            <p class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Admin</p>
            <p class="text-2xl font-bold text-green-600">{{ $totalAdmins }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Reader</p>
            <p class="text-2xl font-bold text-purple-600">{{ $totalReaders }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Author</p>
            <p class="text-2xl font-bold text-orange-600">{{ $totalAuthors }}</p>
        </div>
    </div>

    {{-- MANAJEMEN USER --}}
    <h2 class="text-2xl font-bold mb-4">📋 Manajemen User</h2>

    {{-- Filter & Pencarian --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm text-gray-600 mb-1">Cari Nama/Email</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..."
                   class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <div class="w-40">
            <label class="block text-sm text-gray-600 mb-1">Role</label>
            <select name="role" class="w-full border rounded px-3 py-2 text-sm">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="reader" {{ request('role')=='reader' ? 'selected' : '' }}>Reader</option>
                <option value="author" {{ request('role')=='author' ? 'selected' : '' }}>Author</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Filter</button>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-300 ml-2">Reset</a>
        </div>
    </form>

    {{-- Tabel User --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="text-left px-4 py-3">ID</th>
                    <th class="text-left px-4 py-3">Nama</th>
                    <th class="text-left px-4 py-3">Email</th>
                    <th class="text-left px-4 py-3">Role</th>
                    <th class="text-center px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $user->id }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-2 py-1 text-xs rounded-full
                            @if($user->role == 'admin') bg-blue-100 text-blue-700
                            @elseif($user->role == 'reader') bg-purple-100 text-purple-700
                            @else bg-orange-100 text-orange-700 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($user->role != 'admin' || auth()->id() != $user->id)
                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Hapus</button>
                        </form>
                        @else
                        <span class="text-gray-400 text-xs">Diri sendiri</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr class="border-t">
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Tidak ada user ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->withQueryString()->links() }}
    </div>
</div>

</body>
</html>
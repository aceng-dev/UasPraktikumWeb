<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method untuk halaman dashboard + manajemen user
    public function index(Request $request)
    {
        // Query user dengan filter dan pencarian
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik untuk dashboard
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalReaders = User::where('role', 'reader')->count();
        $totalAuthors = User::where('role', 'author')->count();

        // Kirim semua variabel ke view
        return view('dashboards.admin', compact('users', 'totalUsers', 'totalAdmins', 'totalReaders', 'totalAuthors'));
    }

    // Hapus user
    public function deleteUser(int $id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
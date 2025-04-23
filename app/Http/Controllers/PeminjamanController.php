<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\peminjam;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function peminjaman()
    {
        $buku = buku::all();
        return view('user.peminjaman.peminjaman', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function riwayatpeminjaman()
    {
        $peminjamans = Peminjaman::with(['buku', 'user'])
            ->where('id_user', Auth::id())
            ->latest()
            ->get();

        return view('user.peminjaman.riwayatpeminjaman', compact('peminjamans'));
    }

    public function prosespeminjaman(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'tanggal_pengembalian' => 'required|date|after:today',
        ]);
        // Cek stok buku
        $book = Buku::find($request->id_buku);
        if (!$book || $book->stok < 1) {
            return redirect()->route('peminjaman')->with('error', 'Stok buku habis, tidak dapat dipinjam.');
        }
        // Simpan peminjaman
        $peminjaman = Peminjaman::create([
            'id_user' => Auth::id(), // User yang login
            'id_buku' => $request->id_buku,
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman' => 'Dipinjam',
        ]);

        // Kurangi stok buku jika ada


        $book->stok -= 1;
        $book->save();


        return redirect()->route('riwayatpeminjaman')->with('success', 'Buku berhasil dipinjam!');
    }

    public function kembalikanbuku($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->tanggal_pengembalian = Carbon::now();

        // Hitung denda
        $dueDate = $peminjaman->tanggal_peminjaman->copy()->addDays(7);
        if (Carbon::now()->gt($dueDate)) {
            $daysLate = Carbon::now()->diffInDays($dueDate);
            $peminjaman->denda = $daysLate * 1000; // Misalnya, denda Rp. 1000 per hari
            $peminjaman->status_peminjaman = 'Terlambat';
        } else {
            $peminjaman->denda = 0;
            $peminjaman->status_peminjaman = 'Dikembalikan';
        }

        $peminjaman->save();

        // Tambahkan kembali stok buku
        $book = Buku::find($peminjaman->id_buku);
        if ($book) {
            $book->stok += 1;
            $book->save();

            return redirect()->route('dashboard')->with('success', 'Buku berhasil dikembalikan.');
        }
    }

    public function index() 
    {
        $peminjaman=Peminjaman::paginate(1);
        return view('admin.peminjaman.datapeminjaman',compact('peminjaman'));
    }
}

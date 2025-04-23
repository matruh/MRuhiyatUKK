<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\KoleksiPribadi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class KoleksiPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function koleksipribadi()
    {
        $koleksi = KoleksiPribadi::with('buku')->where('id_user', Auth::id())->get();
        $buku = Buku::all();
        return view('user.koleksibuku.koleksipribadi',compact('buku','koleksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahkoleksi()
    {
        $koleksi = KoleksiPribadi::with('buku')->where('id_user', Auth::id())->get();
        $buku = Buku::all();
        return view('user.koleksibuku.tambahkoleksi',compact('buku','koleksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function proseskoleksi(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:bukus,id',
        ]);

        KoleksiPribadi::firstOrCreate([
            'id_user' => Auth::id(),
            'id_buku' => $request->id_buku,
        ]);

        return redirect()->route('koleksipribadi')->with('success', 'Buku berhasil ditambahkan ke koleksi pribadi.');
    }

    public function hapuskoleksi($id)
    {
        $koleksi = KoleksiPribadi::where('id_user', Auth::id())->findOrFail($id);
        $koleksi->delete();

        return redirect()->route('koleksipribadi')->with('success', 'Buku berhasil dihapus dari koleksi pribadi.');
    }

    public function index()
    {
        $koleksi=koleksipribadi::paginate(1);
        return view('admin.koleksi.datakoleksi',compact('koleksi'));
    }
}

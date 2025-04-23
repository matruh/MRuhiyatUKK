<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\UlasaBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UlasaBukuController extends Controller
{
    // Display a listing of the reviews
    public function ulasanbuku()
    {
        $ulasan = UlasaBuku::with(['user', 'buku'])->get();
        $bukus = Buku::all();
        return view('user.ulasan.ulasanbuku', compact('ulasan', 'bukus'));
    }

    // Show the form for creating a new review
    public function tambahulasan($id)
    {
        // Assuming you have a Buku model to fetch books
        
        $bukus = Buku::all();
        $buku = Buku::with('ulasan.user')->findOrFail($id);
        return view('user.ulasan.tambahulasan', compact('bukus','buku'));
    }

    // Store a newly created review in storage
    public function prosesulasan(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'Ulasan' => 'nullable|string',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        UlasaBuku::create([
            'id_user' => Auth::id(),
            'id_buku' => $request->id_buku,
            'Ulasan' => $request->Ulasan,
            'Rating' => $request->Rating,
        ]);

        return redirect()->route('ulasanbuku')->with('success', 'Ulasan berhasil ditambahkan.');
    }

    // Display the specified review
    public function tampilkanulasan($id)
    {
        $buku = Buku::with('ulasan.user')->findOrFail($id);
        $ulasan = $buku->ulasan;
        return view('user.ulasan.tampilkanulasan', compact('buku', 'ulasan'));
    }




    // Show the form for editing the specified review
    public function editulasan($id)
    {
        $ulasan = UlasaBuku::findOrFail($id);
        $buku = Buku::with('ulasan.user')->findOrFail($id);
        $bukus = Buku::all();
        return view('user.ulasan.editulasan', compact('ulasan', 'bukus','buku'));
    }

    // Update the specified review in storage
    public function updateulasan(Request $request, $id)
    {
        $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'Ulasan' => 'nullable|string',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        $ulasan = UlasaBuku::findOrFail($id);
        $ulasan->update([
            'id_buku' => $request->id_buku,
            'Ulasan' => $request->Ulasan,
            'Rating' => $request->Rating,
        ]);

        return redirect()->route('ulasanbuku')->with('success', 'Ulasan berhasil diperbarui.');
    }

    // Remove the specified review from storage
    // public function destroy($id)
    // {
    //     $ulasan = UlasaBuku::findOrFail($id);
    //     $ulasan->delete();

    //     return redirect()->route('ulasanbuku')->with('success', 'Ulasan berhasil dihapus.');
    // }

    public function index()
    {
        $ulasan=UlasaBuku::paginate(1);
        return view('admin.ulasan.dataulasan',compact('ulasan'));
    }
}

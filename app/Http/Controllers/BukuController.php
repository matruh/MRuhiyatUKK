<?php

namespace App\Http\Controllers;

use view;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $buku=Buku::all();
        $buku = Buku::paginate(5);
        return view('admin.buku.databuku',compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.buku.tambahbuku');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $buku = Buku::create($request->all());
        // $buku->kategoris()->attach($request->kategori);
        if ($request->hasfile('foto')) {
            $request->file('foto')->move('fotobuku/', $request->file('foto')->getClientOriginalName());
            $buku->foto = $request->file('foto')->getClientOriginalName();
            $buku->save();
        }
        return redirect()->route('databuku')->with('success',' Buku Berhasil Ditambah');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku=Buku::find($id);
        return view('admin.buku.editbuku', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $buku=Buku::find($id);
        $buku->update($request->all());
        if ($request->hasfile('foto')) {
            $request->file('foto')->move('fotobuku/', $request->file('foto')->getClientOriginalName());
            $buku->foto = $request->file('foto')->getClientOriginalName();
            $buku->save();
        }

        return redirect()->route('databuku')->with('success','Buku Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $buku=Buku::find($id);
        $buku->delete();

        return redirect()->route('databuku')->with('success','Buku Berhasil Dihapus');

    }

    public function eksporpdf()
    {
        $buku = buku::all();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.buku.databukupdf', compact('buku'));
        return $pdf->download();
    }
}

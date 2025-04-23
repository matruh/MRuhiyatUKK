<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::paginate(1);
        return view('admin.user.datauser',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.tambahuser');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buku = User::create($request->all());
        // $buku->kategoris()->attach($request->kategori);
        if ($request->hasfile('foto')) {
            $request->file('foto')->move('fotobuku/', $request->file('foto')->getClientOriginalName());
            $buku->foto = $request->file('foto')->getClientOriginalName();
            $buku->save();
        }
        return redirect()->route('datauser')->with('success','user berhasil ditambah guys');
    }

    /**
     * Display the specified resource.
     */
    public function show(pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengguna $pengguna,$id)
    {
        $user=User::find($id);
        return view('admin.user.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->update($request->all());
        if ($request->hasfile('foto')) {
            $request->file('foto')->move('fotouser/', $request->file('foto')->getClientOriginalName());
            $user->foto = $request->file('foto')->getClientOriginalName();
            $user->save();
        }

        return redirect()->route('datauser')->with('success','user berhasil di update guys');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengguna $pengguna  ,$id)
    {
        $user=User::find($id);
        $user->delete();

        return redirect()->route('datauser')->with('success','User berhasil di delete guys');

    }
}

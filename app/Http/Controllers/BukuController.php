<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_buku = Buku::all();
        //$data_buku = Buku::all()->sortByDesc('id');
        //$data_buku = Buku::orderBy('id', 'desc')->get();
        $jumlah_buku = Buku::count(); // Menghitung total jumlah buku
        $total_harga = Buku::sum('harga'); // Menghitung total harga semua buku

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->save();

        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id); // Temukan data buku berdasarkan ID
        return view('buku.edit', compact('buku')); // Kirim data buku ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
        ]);

        // Temukan data buku berdasarkan ID
        $buku = Buku::find($id);

        // Update data buku
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->save();

        // Redirect setelah update berhasil
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }
}

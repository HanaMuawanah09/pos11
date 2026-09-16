<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Menampilkan semua data jenis.
     */
    public function index()
    {
        $jenis = Jenis::latest()->get();

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Menampilkan form tambah jenis.
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Menyimpan jenis baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail jenis.
     */
    public function show(Jenis $jenis)
    {
        return view('jenis.show', compact('jenis'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Jenis $jenis)
    {
        return view('jenis.edit', compact('jenis'));
    }

    /**
     * Mengupdate jenis.
     */
    public function update(Request $request, Jenis $jenis)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis berhasil diperbarui.');
    }

    /**
     * Menghapus jenis.
     */
    public function destroy(Jenis $jenis)
    {
        $jenis->delete();

        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis berhasil dihapus.');
    }
}

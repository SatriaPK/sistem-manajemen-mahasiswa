<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdiRequest;
use App\Models\Fakultas;
use App\Models\Prodi;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::with('fakultas')->withCount('mahasiswas')->orderBy('nama')->get();
        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama')->get();
        return view('prodi.create', compact('fakultas'));
    }

    public function store(ProdiRequest $request)
    {
        Prodi::create($request->validated());
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::orderBy('nama')->get();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    public function update(ProdiRequest $request, Prodi $prodi)
    {
        $prodi->update($request->validated());
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        if ($prodi->mahasiswas()->count() > 0) {
            return redirect()->route('prodi.index')
                ->with('error', 'Tidak dapat menghapus prodi yang masih memiliki mahasiswa.');
        }
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
use App\Models\Fakultas;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('prodi.fakultas')->orderBy('nama')->paginate(15);
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $fakultas = Fakultas::with('prodis')->orderBy('nama')->get();
        return view('mahasiswa.create', compact('fakultas'));
    }

    public function store(MahasiswaRequest $request)
    {
        Mahasiswa::create($request->validated());
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi.fakultas');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $fakultas = Fakultas::with('prodis')->orderBy('nama')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'fakultas'));
    }

    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->validated());
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}

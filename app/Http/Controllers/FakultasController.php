<?php

namespace App\Http\Controllers;

use App\Http\Requests\FakultasRequest;
use App\Models\Fakultas;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::withCount('prodis')->orderBy('nama')->get();
        return view('fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(FakultasRequest $request)
    {
        Fakultas::create($request->validated());
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    public function show(Fakultas $fakulta)
    {
        $fakulta->load(['prodis' => function ($q) {
            $q->withCount('mahasiswas')->orderBy('nama');
        }]);
        return view('fakultas.show', ['fakultas' => $fakulta]);
    }

    public function edit(Fakultas $fakulta)
    {
        return view('fakultas.edit', ['fakultas' => $fakulta]);
    }

    public function update(FakultasRequest $request, Fakultas $fakulta)
    {
        $fakulta->update($request->validated());
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil diperbarui.');
    }

    public function destroy(Fakultas $fakulta)
    {
        if ($fakulta->prodis()->count() > 0) {
            return redirect()->route('fakultas.index')
                ->with('error', 'Tidak dapat menghapus fakultas yang masih memiliki prodi.');
        }
        $fakulta->delete();
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}

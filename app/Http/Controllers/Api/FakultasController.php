<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FakultasController extends Controller
{
    public function index()
    {
        $data = Fakultas::withCount('prodis')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data fakultas berhasil diambil.',
            'data'    => $data->map(fn($f) => [
                'id'          => $f->id,
                'nama'        => $f->nama,
                'prodi_count' => $f->prodis_count,
            ]),
        ]);
    }

    public function show(Fakultas $fakultas)
    {
        $fakultas->load('prodis');

        return response()->json([
            'success' => true,
            'message' => 'Detail data fakultas berhasil diambil.',
            'data'    => [
                'id'    => $fakultas->id,
                'nama'  => $fakultas->nama,
                'prodis'=> $fakultas->prodis->map(fn($p) => [
                    'id'          => $p->id,
                    'nama'        => $p->nama,
                    'fakultas_id' => $p->fakultas_id,
                ]),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('fakultas', 'nama')],
        ], [
            'nama.required' => 'Nama fakultas wajib diisi.',
            'nama.unique'   => 'Nama fakultas sudah terdaftar.',
            'nama.max'      => 'Nama fakultas maksimal 255 karakter.',
        ]);

        $fakultas = Fakultas::create(['nama' => $request->nama]);

        return response()->json([
            'success' => true,
            'message' => 'Data fakultas berhasil ditambahkan.',
            'data'    => [
                'id'          => $fakultas->id,
                'nama'        => $fakultas->nama,
                'prodi_count' => 0,
            ],
        ], 201);
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('fakultas', 'nama')->ignore($fakultas->id)],
        ], [
            'nama.required' => 'Nama fakultas wajib diisi.',
            'nama.unique'   => 'Nama fakultas sudah terdaftar.',
            'nama.max'      => 'Nama fakultas maksimal 255 karakter.',
        ]);

        $fakultas->update(['nama' => $request->nama]);

        return response()->json([
            'success' => true,
            'message' => 'Data fakultas berhasil diperbarui.',
            'data'    => [
                'id'   => $fakultas->id,
                'nama' => $fakultas->nama,
            ],
        ]);
    }

    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data fakultas berhasil dihapus.',
        ]);
    }
}
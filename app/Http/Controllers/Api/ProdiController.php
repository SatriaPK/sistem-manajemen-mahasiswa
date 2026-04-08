<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdiController extends Controller
{
    public function index()
    {
        $data = Prodi::with('fakultas')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data prodi berhasil diambil.',
            'data'    => $data->map(fn($p) => $this->format($p)),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => ['required', 'string', 'max:255'],
            'fakultas_id' => ['required', 'exists:fakultas,id'],
        ], [
            'nama.required'        => 'Nama prodi wajib diisi.',
            'nama.max'             => 'Nama prodi maksimal 255 karakter.',
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
            'fakultas_id.exists'   => 'Fakultas yang dipilih tidak valid.',
        ]);

        $prodi = Prodi::create($request->only('nama', 'fakultas_id'));
        $prodi->load('fakultas');

        return response()->json([
            'success' => true,
            'message' => 'Data prodi berhasil ditambahkan.',
            'data'    => $this->format($prodi),
        ], 201);
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama'        => ['required', 'string', 'max:255', Rule::unique('prodis', 'nama')->ignore($prodi->id)],
            'fakultas_id' => ['required', 'exists:fakultas,id'],
        ], [
            'nama.required'        => 'Nama prodi wajib diisi.',
            'nama.unique'          => 'Nama prodi sudah terdaftar.',
            'nama.max'             => 'Nama prodi maksimal 255 karakter.',
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
            'fakultas_id.exists'   => 'Fakultas yang dipilih tidak valid.',
        ]);

        $prodi->update($request->only('nama', 'fakultas_id'));
        $prodi->load('fakultas');

        return response()->json([
            'success' => true,
            'message' => 'Data prodi berhasil diperbarui.',
            'data'    => $this->format($prodi),
        ]);
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data prodi berhasil dihapus.',
        ]);
    }

    private function format(Prodi $p): array
    {
        return [
            'id'          => $p->id,
            'nama'        => $p->nama,
            'fakultas_id' => $p->fakultas_id,
            'fakultas'    => $p->fakultas ? [
                'id'   => $p->fakultas->id,
                'nama' => $p->fakultas->nama,
            ] : null,
        ];
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::with(['prodi.fakultas'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diambil.',
            'data'    => $data->map(fn($m) => $this->format($m)),
        ]);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi.fakultas');

        return response()->json([
            'success' => true,
            'message' => 'Detail data mahasiswa berhasil diambil.',
            'data'    => $this->format($mahasiswa),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nim'      => 'required|string|max:20|unique:mahasiswas,nim',
            'prodi_id' => 'required|exists:prodis,id',
        ], [
            'nama.required'     => 'Nama mahasiswa wajib diisi.',
            'nim.required'      => 'NIM wajib diisi.',
            'nim.unique'        => 'NIM sudah terdaftar.',
            'prodi_id.required' => 'Prodi wajib dipilih.',
            'prodi_id.exists'   => 'Prodi yang dipilih tidak valid.',
        ]);

        $mahasiswa = Mahasiswa::create($request->only('nama', 'nim', 'prodi_id'));
        $mahasiswa->load('prodi.fakultas');

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan.',
            'data'    => $this->format($mahasiswa),
        ], 201);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'nim'      => ['required', 'string', 'max:20', Rule::unique('mahasiswas', 'nim')->ignore($mahasiswa->id)],
            'prodi_id' => ['required', 'exists:prodis,id'],
        ], [
            'nama.required'     => 'Nama mahasiswa wajib diisi.',
            'nim.required'      => 'NIM wajib diisi.',
            'nim.unique'        => 'NIM sudah terdaftar.',
            'prodi_id.required' => 'Prodi wajib dipilih.',
            'prodi_id.exists'   => 'Prodi yang dipilih tidak valid.',
        ]);

        $mahasiswa->update($request->only('nama', 'nim', 'prodi_id'));
        $mahasiswa->load('prodi.fakultas');

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diperbarui.',
            'data'    => $this->format($mahasiswa),
        ]);
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus.',
        ]);
    }

    private function format(Mahasiswa $m): array
    {
        return [
            'id'       => $m->id,
            'nama'     => $m->nama,
            'nim'      => $m->nim,
            'prodi_id' => $m->prodi_id,
            'prodi'    => $m->prodi ? [
                'id'          => $m->prodi->id,
                'nama'        => $m->prodi->nama,
                'fakultas_id' => $m->prodi->fakultas_id,
                'fakultas'    => $m->prodi->fakultas ? [
                    'id'   => $m->prodi->fakultas->id,
                    'nama' => $m->prodi->fakultas->nama,
                ] : null,
            ] : null,
        ];
    }
}
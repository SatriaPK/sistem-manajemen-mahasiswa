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
        $mahasiswas = Mahasiswa::with('prodi.jurusan')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diambil',
            'data'    => $mahasiswas,
        ], 200);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('prodi.jurusan')->find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data mahasiswa berhasil diambil',
            'data'    => $mahasiswa,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'nim'      => ['required', 'string', 'max:20', 'unique:mahasiswas,nim'],
            'prodi_id' => ['required', 'exists:prodis,id'],
        ], [
            'nama.required'     => 'Nama mahasiswa wajib diisi.',
            'nim.required'      => 'NIM wajib diisi.',
            'nim.unique'        => 'NIM sudah terdaftar.',
            'prodi_id.required' => 'Prodi wajib dipilih.',
            'prodi_id.exists'   => 'Prodi yang dipilih tidak valid.',
        ]);

        $mahasiswa = Mahasiswa::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'data'    => $mahasiswa,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
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

        $mahasiswa->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diperbarui',
            'data'    => $mahasiswa->fresh('prodi.jurusan'),
        ], 200);
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus',
        ], 200);
    }
}

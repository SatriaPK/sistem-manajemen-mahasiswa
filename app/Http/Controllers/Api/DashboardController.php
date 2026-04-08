<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function index()
    {
        $recentMahasiswa = Mahasiswa::with(['prodi.fakultas'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($m) => [
                'id'       => $m->id,
                'nama'     => $m->nama,
                'nim'      => $m->nim,
                'prodi_id' => $m->prodi_id,
                'prodi'    => $m->prodi ? [
                    'id'         => $m->prodi->id,
                    'nama'       => $m->prodi->nama,
                    'fakultas_id'=> $m->prodi->fakultas_id,
                    'fakultas'   => $m->prodi->fakultas ? [
                        'id'   => $m->prodi->fakultas->id,
                        'nama' => $m->prodi->fakultas->nama,
                    ] : null,
                ] : null,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Data dashboard.',
            'data'    => [
                'total_mahasiswa'   => Mahasiswa::count(),
                'total_fakultas'    => Fakultas::count(),
                'total_prodi'       => Prodi::count(),
                'recent_mahasiswa'  => $recentMahasiswa,
            ],
        ]);
    }
}

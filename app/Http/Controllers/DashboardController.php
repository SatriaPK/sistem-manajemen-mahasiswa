<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa  = Mahasiswa::count();
        $totalFakultas   = Fakultas::count();
        $totalProdi      = Prodi::count();
        $recentMahasiswa = Mahasiswa::with('prodi.fakultas')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMahasiswa', 'totalFakultas', 'totalProdi', 'recentMahasiswa'
        ));
    }
}

<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Teknik'           => ['Teknik Informatika', 'Teknik Elektro', 'Teknik Mesin'],
            'MIPA'             => ['Matematika', 'Fisika', 'Kimia'],
            'Ekonomi & Bisnis' => ['Manajemen', 'Akuntansi', 'Ekonomi Pembangunan'],
            'Ilmu Sosial'      => ['Sosiologi', 'Ilmu Komunikasi'],
        ];

        foreach ($data as $fakultasNama => $prodis) {
            $fakultas = Fakultas::where('nama', $fakultasNama)->first();
            foreach ($prodis as $prodi) {
                Prodi::create(['nama' => $prodi, 'fakultas_id' => $fakultas->id]);
            }
        }
    }
}

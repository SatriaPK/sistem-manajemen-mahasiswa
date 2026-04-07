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
            'Ekonomika dan Bisnis'           => ['S1 Manajemen', 'S1 Akuntansi'],
            'Sains dan Teknologi'            => ['S1 Informatika', 'S1 Rekayasa Perangkat Lunak', 'S1 Sistem Informasi'],
            'Sosial dan Humaniora'           => ['S1 Bahasa Inggris', 'S1 Pariwisata', 'D3 Bahasa Inggris'],
        ];

        foreach ($data as $fakultasNama => $prodis) {
            $fakultas = Fakultas::where('nama', $fakultasNama)->first();
            foreach ($prodis as $prodi) {
                Prodi::create(['nama' => $prodi, 'fakultas_id' => $fakultas->id]);
            }
        }
    }
}

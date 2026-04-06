<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = [
            ['nama' => 'Satria Putra Kurniawan',  'nim' => '243016016', 'prodi' => 'S1 Informatika'],
            ['nama' => 'Bening Radiktya',         'nim' => '243016024', 'prodi' => 'S1 Informatika'],
            ['nama' => 'Avalent Divasea',         'nim' => '243016019', 'prodi' => 'S1 Informatika']
        ];

        foreach ($mahasiswas as $data) {
            $prodi = Prodi::where('nama', $data['prodi'])->first();
            Mahasiswa::create([
                'nama'     => $data['nama'],
                'nim'      => $data['nim'],
                'prodi_id' => $prodi->id,
            ]);
        }
    }
}

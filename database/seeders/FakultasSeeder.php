<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        $items = ['Ekonomika dan Bisnis', 'Sains dan Teknologi', 'Sosial dan Humaniora'];
        foreach ($items as $nama) {
            Fakultas::create(['nama' => $nama]);
        }
    }
}

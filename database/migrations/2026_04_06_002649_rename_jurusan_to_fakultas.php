<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename table jurusans → fakultas
        Schema::rename('jurusans', 'fakultas');

        // Rename FK column jurusan_id → fakultas_id in prodis
        Schema::table('prodis', function (Blueprint $table) {
            $table->renameColumn('jurusan_id', 'fakultas_id');
        });
    }

    public function down(): void
    {
        Schema::table('prodis', function (Blueprint $table) {
            $table->renameColumn('fakultas_id', 'jurusan_id');
        });
        Schema::rename('fakultas', 'jurusans');
    }
};

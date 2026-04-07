@extends('layouts.app')

@section('title', 'PRODI // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">PRODI</div>
    <a href="{{ route('prodi.create') }}" class="game-btn game-btn-primary">+ TAMBAH PRODI</a>
</div>

<div class="game-card">
    <div class="table-wrap">
    <table class="game-table">
        <thead>
            <tr>
                <th style="width:50px;">NO</th>
                <th>NAMA PRODI</th>
                <th>FAKULTAS</th>
                <th style="width:150px;">JUMLAH MAHASISWA</th>
                <th style="width:160px;">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($prodis as $i => $prodi)
            <tr>
                <td style="color:#555555;">{{ $i + 1 }}</td>
                <td>{{ $prodi->nama }}</td>
                <td style="color:#888888;">{{ $prodi->fakultas->nama ?? '-' }}</td>
                <td style="color:#888888;">{{ $prodi->mahasiswas_count }} mahasiswa</td>
                <td>
                    <div style="display:flex;gap:0.4rem;">
                        <a href="{{ route('prodi.edit', $prodi) }}" class="game-btn game-btn-sm">EDIT</a>
                        <button type="button" class="game-btn game-btn-sm game-btn-danger"
                            onclick="openDeleteModal('{{ route('prodi.destroy', $prodi) }}', '{{ addslashes($prodi->nama) }}', 'prodi')">
                            HAPUS
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="color:#555555;text-align:center;padding:2rem;">NO DATA FOUND</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'FAKULTAS // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">FAKULTAS</div>
    <a href="{{ route('fakultas.create') }}" class="game-btn game-btn-primary">+ TAMBAH FAKULTAS</a>
</div>

<div class="game-card">
    <table class="game-table">
        <thead>
            <tr>
                <th style="width:50px;">NO</th>
                <th>NAMA FAKULTAS</th>
                <th style="width:140px;">JUMLAH PRODI</th>
                <th style="width:210px;">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fakultas as $i => $item)
            <tr>
                <td style="color:#555555;">{{ $i + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td style="color:#888888;">{{ $item->prodis_count }} prodi</td>
                <td>
                    <div style="display:flex;gap:0.4rem;">
                        <a href="{{ route('fakultas.show', $item) }}" class="game-btn game-btn-sm">VIEW</a>
                        <a href="{{ route('fakultas.edit', $item) }}" class="game-btn game-btn-sm">EDIT</a>
                        <button type="button" class="game-btn game-btn-sm game-btn-danger"
                            onclick="openDeleteModal('{{ route('fakultas.destroy', $item) }}', '{{ addslashes($item->nama) }}', 'fakultas')">
                            HAPUS
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="color:#555555;text-align:center;padding:2rem;">NO DATA FOUND</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('title', 'MAHASISWA // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">MAHASISWA</div>
    <a href="{{ route('mahasiswa.create') }}" class="game-btn game-btn-primary">+ TAMBAH MAHASISWA</a>
</div>

<div class="game-card">
    <table class="game-table">
        <thead>
            <tr>
                <th style="width:50px;">NO</th>
                <th>NAMA</th>
                <th style="width:120px;">NIM</th>
                <th>PRODI</th>
                <th>FAKULTAS</th>
                <th style="width:210px;">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswas as $i => $mhs)
            <tr>
                <td style="color:#555555;">{{ $mahasiswas->firstItem() + $i }}</td>
                <td>{{ $mhs->nama }}</td>
                <td style="color:#888888;font-size:11px;">{{ $mhs->nim }}</td>
                <td>{{ $mhs->prodi->nama ?? '-' }}</td>
                <td style="color:#888888;">{{ $mhs->prodi->fakultas->nama ?? '-' }}</td>
                <td>
                    <div style="display:flex;gap:0.4rem;">
                        <a href="{{ route('mahasiswa.show', $mhs) }}" class="game-btn game-btn-sm">VIEW</a>
                        <a href="{{ route('mahasiswa.edit', $mhs) }}" class="game-btn game-btn-sm">EDIT</a>
                        <button type="button" class="game-btn game-btn-sm game-btn-danger"
                            onclick="openDeleteModal('{{ route('mahasiswa.destroy', $mhs) }}', '{{ addslashes($mhs->nama) }}', 'mahasiswa')">
                            HAPUS
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="color:#555555;text-align:center;padding:2rem;">NO DATA FOUND</td></tr>
            @endforelse
        </tbody>
    </table>

    @if ($mahasiswas->hasPages())
    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:1rem;padding-top:1rem;border-top:1px solid #2a2a2a;">
        <div style="font-family:'JetBrains Mono',monospace;font-size:11px;color:#555555;">
            SHOWING {{ $mahasiswas->firstItem() }}–{{ $mahasiswas->lastItem() }} OF {{ $mahasiswas->total() }}
        </div>
        {{ $mahasiswas->links() }}
    </div>
    @endif
</div>
@endsection

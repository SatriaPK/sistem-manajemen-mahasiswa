@extends('layouts.app')

@section('title', 'DETAIL FAKULTAS // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">DETAIL FAKULTAS</div>
    <div style="display:flex;gap:0.5rem;">
        <a href="{{ route('fakultas.edit', $fakultas) }}" class="game-btn game-btn-primary">EDIT</a>
        <a href="{{ route('fakultas.index') }}" class="game-btn">&#x2190; KEMBALI</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:1rem;max-width:960px;">

    {{-- Kolom kiri: info + tabel prodi --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">

        {{-- Card: Identitas Fakultas --}}
        <div class="game-card">
            <div style="font-family:'Press Start 2P',monospace;font-size:8px;color:#555555;letter-spacing:0.1em;margin-bottom:1.25rem;">
                &gt; IDENTITAS FAKULTAS
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem 2rem;">
                <div>
                    <div class="form-label">NAMA FAKULTAS</div>
                    <div style="font-family:'JetBrains Mono',monospace;font-size:16px;color:#f0f0f0;">
                        {{ $fakultas->nama }}
                    </div>
                </div>
                <div>
                    <div class="form-label">TOTAL PRODI</div>
                    <div style="font-family:'Press Start 2P',monospace;font-size:14px;color:#f0f0f0;">
                        {{ $fakultas->prodis->count() }}
                        <span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:#555555;">PRODI</span>
                    </div>
                </div>
                <div>
                    <div class="form-label">TOTAL MAHASISWA</div>
                    <div style="font-family:'Press Start 2P',monospace;font-size:14px;color:#f0f0f0;">
                        {{ $fakultas->prodis->sum('mahasiswas_count') }}
                        <span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:#555555;">MHS</span>
                    </div>
                </div>
                <div>
                    <div class="form-label">ID RECORD</div>
                    <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#555555;">
                        #{{ $fakultas->id }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Daftar Prodi --}}
        <div class="game-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                <div style="font-family:'Press Start 2P',monospace;font-size:8px;color:#555555;letter-spacing:0.1em;">
                    &gt; DAFTAR PRODI
                </div>
                <a href="{{ route('prodi.create') }}" class="game-btn game-btn-sm game-btn-primary">+ TAMBAH PRODI</a>
            </div>

            @if ($fakultas->prodis->isEmpty())
                <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#555555;text-align:center;padding:2rem 0;">
                    NO DATA FOUND — belum ada prodi di fakultas ini.
                </div>
            @else
                <table class="game-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">NO</th>
                            <th>NAMA PRODI</th>
                            <th style="width:130px;">JML MAHASISWA</th>
                            <th style="width:110px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fakultas->prodis as $i => $prodi)
                        <tr>
                            <td style="color:#555555;">{{ $i + 1 }}</td>
                            <td>{{ $prodi->nama }}</td>
                            <td style="color:#888888;">{{ $prodi->mahasiswas_count }} mhs</td>
                            <td>
                                <div style="display:flex;gap:0.4rem;">
                                    <a href="{{ route('prodi.edit', $prodi) }}" class="game-btn game-btn-sm">EDIT</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    {{-- Kolom kanan: metadata + aksi --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">

        {{-- Card: Metadata --}}
        <div class="game-card">
            <div style="font-family:'Press Start 2P',monospace;font-size:8px;color:#555555;letter-spacing:0.1em;margin-bottom:1.25rem;">
                &gt; METADATA
            </div>
            <div style="display:flex;flex-direction:column;gap:0.85rem;">
                <div>
                    <div class="form-label">DIBUAT</div>
                    <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#888888;">
                        {{ $fakultas->created_at->format('Y-m-d H:i:s') }}
                    </div>
                </div>
                <div>
                    <div class="form-label">DIPERBARUI</div>
                    <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#888888;">
                        {{ $fakultas->updated_at->format('Y-m-d H:i:s') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Aksi --}}
        <div class="game-card">
            <div style="font-family:'Press Start 2P',monospace;font-size:8px;color:#555555;letter-spacing:0.1em;margin-bottom:1.25rem;">
                &gt; AKSI
            </div>
            <div style="display:flex;flex-direction:column;gap:0.6rem;">
                <a href="{{ route('fakultas.edit', $fakultas) }}" class="game-btn game-btn-primary" style="justify-content:center;">
                    &#x270E; EDIT FAKULTAS
                </a>
                @if ($fakultas->prodis->isEmpty())
                <button type="button" class="game-btn game-btn-danger" style="justify-content:center;"
                    onclick="openDeleteModal('{{ route('fakultas.destroy', $fakultas) }}', '{{ addslashes($fakultas->nama) }}', 'fakultas')">
                    &#x2717; HAPUS FAKULTAS
                </button>
                @else
                <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555555;border:1px solid #2a2a2a;padding:0.5rem 0.75rem;text-align:center;">
                    HAPUS TIDAK TERSEDIA<br>
                    <span style="color:#333333;">masih ada {{ $fakultas->prodis->count() }} prodi</span>
                </div>
                @endif
                <a href="{{ route('fakultas.index') }}" class="game-btn" style="justify-content:center;">
                    &#x2190; KEMBALI KE LIST
                </a>
            </div>
        </div>

    </div>

</div>
@endsection

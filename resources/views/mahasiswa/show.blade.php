@extends('layouts.app')

@section('title', 'DETAIL MAHASISWA // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">DETAIL MAHASISWA</div>
    <div style="display:flex;gap:0.5rem;">
        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="game-btn game-btn-primary">EDIT</a>
        <a href="{{ route('mahasiswa.index') }}" class="game-btn">&#x2190; KEMBALI</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;max-width:900px;">

    {{-- Card: Identitas --}}
    <div class="game-card" style="grid-column:1 / -1;">
        <div style="font-family:'Press Start 2P',monospace;font-size:8px;color:#555555;letter-spacing:0.1em;margin-bottom:1.25rem;">
            &gt; IDENTITAS MAHASISWA
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem 2rem;">
            {{-- NIM --}}
            <div>
                <div class="form-label">NIM</div>
                <div style="font-family:'JetBrains Mono',monospace;font-size:18px;color:#f0f0f0;letter-spacing:0.08em;">
                    {{ $mahasiswa->nim }}
                </div>
            </div>

            {{-- Nama --}}
            <div>
                <div class="form-label">NAMA LENGKAP</div>
                <div style="font-family:'JetBrains Mono',monospace;font-size:16px;color:#f0f0f0;">
                    {{ $mahasiswa->nama }}
                </div>
            </div>

            {{-- Prodi --}}
            <div>
                <div class="form-label">PROGRAM STUDI</div>
                <div style="font-family:'JetBrains Mono',monospace;font-size:13px;color:#f0f0f0;">
                    {{ $mahasiswa->prodi->nama ?? '-' }}
                </div>
            </div>

            {{-- Fakultas --}}
            <div>
                <div class="form-label">FAKULTAS</div>
                <div style="font-family:'JetBrains Mono',monospace;font-size:13px;color:#888888;">
                    {{ $mahasiswa->prodi->fakultas->nama ?? '-' }}
                </div>
            </div>
        </div>
    </div>

    {{-- Card: Metadata --}}
    <div class="game-card">
        <div style="font-family:'Press Start 2P',monospace;font-size:8px;color:#555555;letter-spacing:0.1em;margin-bottom:1.25rem;">
            &gt; METADATA
        </div>
        <div style="display:flex;flex-direction:column;gap:0.85rem;">
            <div>
                <div class="form-label">DIBUAT</div>
                <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#888888;">
                    {{ $mahasiswa->created_at->format('Y-m-d H:i:s') }}
                </div>
            </div>
            <div>
                <div class="form-label">DIPERBARUI</div>
                <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#888888;">
                    {{ $mahasiswa->updated_at->format('Y-m-d H:i:s') }}
                </div>
            </div>
            <div>
                <div class="form-label">ID RECORD</div>
                <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#555555;">
                    #{{ $mahasiswa->id }}
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
            <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="game-btn game-btn-primary" style="justify-content:center;">
                &#x270E; EDIT DATA
            </a>
            <button type="button" class="game-btn game-btn-danger" style="justify-content:center;"
                onclick="openDeleteModal('{{ route('mahasiswa.destroy', $mahasiswa) }}', '{{ addslashes($mahasiswa->nama) }}', 'mahasiswa')">
                &#x2717; HAPUS DATA
            </button>
            <a href="{{ route('mahasiswa.index') }}" class="game-btn" style="justify-content:center;">
                &#x2190; KEMBALI KE LIST
            </a>
        </div>
    </div>

</div>
@endsection

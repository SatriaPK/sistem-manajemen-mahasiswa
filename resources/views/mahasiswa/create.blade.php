@extends('layouts.app')

@section('title', 'TAMBAH MAHASISWA // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">TAMBAH MAHASISWA</div>
</div>

<div class="game-card" style="max-width:520px;">
    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="nama">NAMA LENGKAP</label>
            <input class="game-input" type="text" id="nama" name="nama"
                   value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso"
                   style="{{ $errors->has('nama') ? 'border-color:#ff3333' : '' }}">
            @error('nama') <div class="form-error">&#x2717; {{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="nim">NIM</label>
            <input class="game-input" type="text" id="nim" name="nim"
                   value="{{ old('nim') }}" placeholder="Contoh: 2024001" maxlength="20"
                   style="{{ $errors->has('nim') ? 'border-color:#ff3333' : '' }}">
            @error('nim') <div class="form-error">&#x2717; {{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="prodi_id">PROGRAM STUDI</label>
            <select class="game-input" id="prodi_id" name="prodi_id"
                    style="{{ $errors->has('prodi_id') ? 'border-color:#ff3333' : '' }}">
                <option value="">-- PILIH PRODI --</option>
                @foreach ($fakultas as $fak)
                    <optgroup label="{{ $fak->nama }}">
                        @foreach ($fak->prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('prodi_id') <div class="form-error">&#x2717; {{ $message }}</div> @enderror
        </div>

        <div style="display:flex;gap:0.75rem;margin-top:1.5rem;">
            <button type="submit" class="game-btn game-btn-primary">SIMPAN</button>
            <a href="{{ route('mahasiswa.index') }}" class="game-btn">BATAL</a>
        </div>
    </form>
</div>
@endsection

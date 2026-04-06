@extends('layouts.app')

@section('title', 'TAMBAH PRODI // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">TAMBAH PRODI</div>
</div>

<div class="game-card" style="max-width:500px;">
    <form method="POST" action="{{ route('prodi.store') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="fakultas_id">FAKULTAS</label>
            <select class="game-input" id="fakultas_id" name="fakultas_id"
                    style="{{ $errors->has('fakultas_id') ? 'border-color:#ff3333' : '' }}">
                <option value="">-- PILIH FAKULTAS --</option>
                @foreach ($fakultas as $fak)
                    <option value="{{ $fak->id }}" {{ old('fakultas_id') == $fak->id ? 'selected' : '' }}>
                        {{ $fak->nama }}
                    </option>
                @endforeach
            </select>
            @error('fakultas_id') <div class="form-error">&#x2717; {{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="nama">NAMA PRODI</label>
            <input class="game-input" type="text" id="nama" name="nama"
                   value="{{ old('nama') }}" placeholder="Contoh: Teknik Informatika"
                   style="{{ $errors->has('nama') ? 'border-color:#ff3333' : '' }}">
            @error('nama') <div class="form-error">&#x2717; {{ $message }}</div> @enderror
        </div>

        <div style="display:flex;gap:0.75rem;margin-top:1.5rem;">
            <button type="submit" class="game-btn game-btn-primary">SIMPAN</button>
            <a href="{{ route('prodi.index') }}" class="game-btn">BATAL</a>
        </div>
    </form>
</div>
@endsection

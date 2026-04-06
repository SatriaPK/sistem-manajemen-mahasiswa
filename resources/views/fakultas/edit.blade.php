@extends('layouts.app')

@section('title', 'EDIT FAKULTAS // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">EDIT FAKULTAS</div>
</div>

<div class="game-card" style="max-width:500px;">
    <form method="POST" action="{{ route('fakultas.update', $fakultas) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label" for="nama">NAMA FAKULTAS</label>
            <input class="game-input" type="text" id="nama" name="nama"
                   value="{{ old('nama', $fakultas->nama) }}" placeholder="Contoh: Teknik"
                   style="{{ $errors->has('nama') ? 'border-color:#ff3333' : '' }}">
            @error('nama') <div class="form-error">&#x2717; {{ $message }}</div> @enderror
        </div>

        <div style="display:flex;gap:0.75rem;margin-top:1.5rem;">
            <button type="submit" class="game-btn game-btn-primary">SIMPAN</button>
            <a href="{{ route('fakultas.index') }}" class="game-btn">BATAL</a>
        </div>
    </form>
</div>
@endsection

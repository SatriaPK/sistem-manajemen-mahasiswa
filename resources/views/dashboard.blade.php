@extends('layouts.app')

@section('title', 'DASHBOARD // MAHASISWA SYS')

@section('content')
<div class="page-header">
    <div class="page-title">DASHBOARD</div>
    <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555;">
        SYSTEM OVERVIEW
    </div>
</div>

<!-- Stat Cards -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem;">
    <div class="game-card" style="text-align:center;">
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555555;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.75rem;">TOTAL MAHASISWA</div>
        <div style="font-family:'Press Start 2P',monospace;font-size:2rem;color:#f0f0f0;line-height:1;">{{ $totalMahasiswa }}</div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555555;margin-top:0.5rem;">RECORDS</div>
    </div>
    <div class="game-card" style="text-align:center;">
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555555;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.75rem;">TOTAL FAKULTAS</div>
        <div style="font-family:'Press Start 2P',monospace;font-size:2rem;color:#f0f0f0;line-height:1;">{{ $totalFakultas }}</div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555555;margin-top:0.5rem;">DEPARTMENTS</div>
    </div>
    <div class="game-card" style="text-align:center;">
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555555;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.75rem;">TOTAL PRODI</div>
        <div style="font-family:'Press Start 2P',monospace;font-size:2rem;color:#f0f0f0;line-height:1;">{{ $totalProdi }}</div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#555555;margin-top:0.5rem;">PROGRAMS</div>
    </div>
</div>

<!-- Bar Chart -->
<div class="game-card" style="margin-bottom:1.5rem;">
    <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#888;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:1rem;">DISTRIBUSI DATA</div>
    <div style="display:flex;align-items:flex-end;gap:1.5rem;height:80px;">
        @php $maxVal = max($totalMahasiswa, $totalFakultas, $totalProdi, 1); @endphp
        @foreach([['label'=>'MHS','val'=>$totalMahasiswa],['label'=>'FAK','val'=>$totalFakultas],['label'=>'PRD','val'=>$totalProdi]] as $bar)
        <div style="display:flex;flex-direction:column;align-items:center;gap:0.3rem;flex:1;">
            <span style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#888;">{{ $bar['val'] }}</span>
            <div style="width:100%;background:#ffffff;height:{{ max(4, intval(($bar['val']/$maxVal)*60)) }}px;"></div>
            <span style="font-family:'JetBrains Mono',monospace;font-size:9px;color:#555555;text-transform:uppercase;">{{ $bar['label'] }}</span>
        </div>
        @endforeach
    </div>
</div>

<!-- Recent Table -->
<div class="game-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#888;text-transform:uppercase;letter-spacing:0.08em;">MAHASISWA TERBARU</div>
        <a href="/mahasiswa" class="game-btn game-btn-sm">VIEW ALL &gt;</a>
    </div>
    <table class="game-table">
        <thead>
            <tr>
                <th>#</th>
                <th>NAMA</th>
                <th>NIM</th>
                <th>PRODI</th>
                <th>FAKULTAS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentMahasiswa as $i => $mhs)
            <tr>
                <td style="color:#555555;">{{ $i + 1 }}</td>
                <td>{{ $mhs->nama }}</td>
                <td style="color:#888888;">{{ $mhs->nim }}</td>
                <td>{{ $mhs->prodi->nama ?? '-' }}</td>
                <td style="color:#888888;">{{ $mhs->prodi->fakultas->nama ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="color:#555555;text-align:center;">NO DATA FOUND</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

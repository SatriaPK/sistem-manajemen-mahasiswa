<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MAHASISWA SYS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body { height: 100%; margin: 0; }
        .app-layout {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background: #0a0a0a;
        }
        /* Sidebar */
        .sidebar {
            width: 220px;
            min-width: 220px;
            background: #141414;
            border-right: 1px solid #2a2a2a;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid #2a2a2a;
        }
        .sidebar-brand-text {
            font-family: 'Press Start 2P', monospace;
            font-size: 8px;
            color: #f0f0f0;
            line-height: 1.8;
            letter-spacing: 0.05em;
        }
        .sidebar-brand-sub {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            color: #555555;
            margin-top: 0.4rem;
        }
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
        }
        .sidebar-section {
            font-family: 'JetBrains Mono', monospace;
            font-size: 9px;
            color: #555555;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.75rem 1.25rem 0.25rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.5rem 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #888888;
            text-decoration: none;
            transition: color 0.1s, background 0.1s;
            border-left: 2px solid transparent;
        }
        .sidebar-link:hover {
            color: #f0f0f0;
            background: #1e1e1e;
        }
        .sidebar-link.active {
            color: #f0f0f0;
            border-left-color: #ffffff;
            background: #1e1e1e;
        }
        .sidebar-link .indicator {
            font-size: 10px;
            color: #ffffff;
            opacity: 0;
            transition: opacity 0.1s;
        }
        .sidebar-link.active .indicator,
        .sidebar-link:hover .indicator { opacity: 1; }
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid #2a2a2a;
        }
        /* Main content */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .main-header {
            background: #141414;
            border-bottom: 1px solid #2a2a2a;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .main-header-greeting {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #888888;
        }
        .main-header-greeting span {
            color: #f0f0f0;
        }
        .main-header-right {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            color: #555555;
        }
        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }
        /* Page header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #2a2a2a;
        }
        .page-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 10px;
            color: #f0f0f0;
            letter-spacing: 0.05em;
        }
        /* Flash messages */
        .flash-success {
            background: #0f1f0f;
            border: 1px solid #a0a0a0;
            color: #a0a0a0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            padding: 0.6rem 0.9rem;
            margin-bottom: 1rem;
        }
        .flash-error {
            background: #1a0000;
            border: 1px solid #ff3333;
            color: #ff3333;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            padding: 0.6rem 0.9rem;
            margin-bottom: 1rem;
        }
        /* Table */
        .game-table { width: 100%; border-collapse: collapse; }
        .game-table th {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #888888;
            padding: 0.6rem 0.75rem;
            border-bottom: 2px solid #2a2a2a;
            text-align: left;
            background: #141414;
        }
        .game-table td {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #f0f0f0;
            padding: 0.6rem 0.75rem;
            border-bottom: 1px solid #1e1e1e;
        }
        .game-table tr:nth-child(even) td { background: #0d0d0d; }
        .game-table tr:hover td { background: #1e1e1e; }
        /* Card */
        .game-card {
            background: #141414;
            border: 1px solid #2a2a2a;
            padding: 1.25rem;
        }
        /* Form */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.4rem;
        }
        .form-error {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #ff3333;
            margin-top: 0.3rem;
        }
    </style>
</head>
<body>
<div class="app-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-text">MHS<br>SYS</div>
            <div class="sidebar-brand-sub">// v1.0.0</div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section">MAIN</div>
            <a href="/dashboard" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <span class="indicator">&gt;</span> HOME
            </a>
            <a href="/mahasiswa" class="sidebar-link {{ request()->is('mahasiswa*') ? 'active' : '' }}">
                <span class="indicator">&gt;</span> MAHASISWA
            </a>

            <div class="sidebar-section" style="margin-top:0.5rem;">DATA</div>
            <a href="/fakultas" class="sidebar-link {{ request()->is('fakultas*') ? 'active' : '' }}">
                <span class="indicator">&gt;</span> FAKULTAS
            </a>
            <a href="/prodi" class="sidebar-link {{ request()->is('prodi*') ? 'active' : '' }}">
                <span class="indicator">&gt;</span> PRODI
            </a>

            <div class="sidebar-section" style="margin-top:0.5rem;">SYSTEM</div>
            <a href="#" class="sidebar-link" style="opacity:0.4;cursor:not-allowed;">
                <span class="indicator">&gt;</span> SETTINGS
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="game-btn game-btn-danger" style="width:100%;justify-content:center;">
                    LOGOUT
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="main-area">
        <header class="main-header">
            <div class="main-header-greeting">
                HELLO, <span>{{ strtoupper(Auth::user()->name) }}</span>
            </div>
            <div class="main-header-right">
                {{ now()->format('Y-m-d H:i') }} &nbsp;|&nbsp; SESSION ACTIVE
            </div>
        </header>

        <main class="main-content">
            @if (session('success'))
                <div class="flash-success">&#x2713; {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="flash-error">&#x2717; {{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" style="
    display:none; position:fixed; inset:0; z-index:10000;
    background:rgba(0,0,0,0.75); align-items:center; justify-content:center;">
    <div style="
        background:#141414; border:2px solid #ff3333;
        padding:2rem; max-width:400px; width:90%; position:relative;">
        <div style="font-family:'Press Start 2P',monospace;font-size:9px;color:#ff3333;margin-bottom:1rem;letter-spacing:0.05em;">
            &#x26A0; KONFIRMASI HAPUS
        </div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#f0f0f0;margin-bottom:0.5rem;">
            Yakin ingin menghapus data ini?
        </div>
        <div id="deleteModalTarget" style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#ff3333;margin-bottom:1.5rem;word-break:break-all;"></div>
        <div style="display:flex;gap:0.75rem;">
            <form id="deleteModalForm" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="game-btn game-btn-danger">YA, HAPUS</button>
            </form>
            <button type="button" class="game-btn" onclick="closeDeleteModal()">BATAL</button>
        </div>
    </div>
</div>

<script>
function openDeleteModal(action, name, type) {
    const modal = document.getElementById('deleteModal');
    const form  = document.getElementById('deleteModalForm');
    const label = document.getElementById('deleteModalTarget');

    form.action = action;
    label.textContent = '"' + name + '"';
    modal.style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN // MAHASISWA SYS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background: #0a0a0a;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrap {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }
        .login-card {
            background: #141414;
            border: 2px solid #ffffff;
            padding: 2.5rem 2rem;
        }
        .login-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            color: #f0f0f0;
            text-align: center;
            margin-bottom: 0.5rem;
            letter-spacing: 0.05em;
        }
        .login-sub {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #555555;
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.4rem;
        }
        .form-error {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #ff3333;
            margin-top: 0.35rem;
        }
        .login-footer {
            margin-top: 1.5rem;
            border-top: 1px solid #2a2a2a;
            padding-top: 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            color: #555555;
            text-align: center;
        }
        .cursor { display: inline-block; width: 8px; height: 14px; background: #f0f0f0; vertical-align: middle; animation: blink 1s step-end infinite; }
        @keyframes blink { 0%,100%{opacity:1}50%{opacity:0} }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-card">
            <div class="login-title">ENTER SYSTEM <span class="cursor"></span></div>
            <div class="login-sub">// MAHASISWA MANAGEMENT v1.0</div>

            @if ($errors->has('email'))
                <div style="background:#1a0000;border:1px solid #ff3333;padding:0.6rem 0.8rem;margin-bottom:1rem;font-family:'JetBrains Mono',monospace;font-size:11px;color:#ff3333;">
                    &#x2717; {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">[ EMAIL ]</label>
                    <input
                        class="game-input"
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@mahasiswa.app"
                        autocomplete="email"
                        autofocus
                    >
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">[ PASSWORD ]</label>
                    <input
                        class="game-input"
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                    >
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="game-btn game-btn-primary" style="width:100%;justify-content:center;margin-top:0.5rem;">
                    &gt; LOGIN
                </button>
            </form>

            <div class="login-footer">
                &copy; {{ date('Y') }} MAHASISWA.SYS &mdash; ALL RIGHTS RESERVED
            </div>
        </div>
    </div>
</body>
</html>

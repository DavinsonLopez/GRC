<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NexoDesk')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    @verbatim
    <style>
        :root {
            --bg-0: #f3ead7;
            --bg-1: #f6f2e9;
            --ink: #1c1a18;
            --muted: #605447;
            --brand: #b3472f;
            --brand-dark: #7f2f1f;
            --ok-bg: #dff4de;
            --ok-ink: #225f1f;
            --warn-bg: #fde6de;
            --warn-ink: #7f2f1f;
            --panel: #fffdf8;
            --stroke: #e4d5bd;
            --radius: 14px;
            --shadow-soft: 0 10px 30px rgba(70, 38, 20, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 10%, #ffd9a8 0%, transparent 28%),
                radial-gradient(circle at 86% 16%, #ffb48a 0%, transparent 26%),
                linear-gradient(160deg, var(--bg-0) 0%, var(--bg-1) 65%);
            min-height: 100vh;
        }

        .shell {
            max-width: 1080px;
            margin: 0 auto;
            padding: 26px 18px 60px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            background: rgba(255, 253, 248, 0.76);
            border: 1px solid var(--stroke);
            border-radius: calc(var(--radius) + 4px);
            padding: 10px;
            box-shadow: var(--shadow-soft);
            backdrop-filter: blur(4px);
        }

        .brand {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 0 6px;
        }

        .brand strong {
            font-size: 1.06rem;
        }

        .brand small {
            color: var(--muted);
            font-family: "IBM Plex Mono", monospace;
            font-size: 0.78rem;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .menu a,
        .btn,
        .menu button {
            border: 1px solid var(--stroke);
            background: #fff8ee;
            color: var(--ink);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: transform .18s ease, background-color .18s ease, border-color .18s ease;
        }

        .menu a:hover,
        .btn:hover,
        .menu button:hover {
            transform: translateY(-1px);
            border-color: #d1b086;
        }

        .btn-primary {
            background: var(--brand);
            border-color: var(--brand-dark);
            color: #fff;
        }

        .hero {
            margin-top: 16px;
            background: var(--panel);
            border: 1px solid var(--stroke);
            border-radius: calc(var(--radius) + 2px);
            padding: 18px;
            box-shadow: var(--shadow-soft);
            animation: rise .45s ease;
        }

        .hero h1 {
            margin: 0;
            font-size: 1.6rem;
            line-height: 1.2;
        }

        .hero p {
            margin: 10px 0 0;
            color: var(--muted);
        }

        .session {
            margin-top: 12px;
            font-family: "IBM Plex Mono", monospace;
            background: #fff4e6;
            border: 1px dashed #d8bb93;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 0.86rem;
            color: #4d3c2f;
        }

        .msg {
            margin-top: 14px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid;
            animation: rise .32s ease;
        }

        .error {
            background: var(--warn-bg);
            color: var(--warn-ink);
            border-color: #f3baa9;
        }

        .ok {
            background: var(--ok-bg);
            color: var(--ok-ink);
            border-color: #abd8a9;
        }

        .content {
            margin-top: 16px;
            animation: rise .45s ease;
        }

        .panel {
            border: 1px solid var(--stroke);
            border-radius: var(--radius);
            background: var(--panel);
            box-shadow: var(--shadow-soft);
            padding: 16px;
        }

        .stack {
            display: grid;
            gap: 14px;
        }

        .grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .card {
            border: 1px solid var(--stroke);
            border-radius: 12px;
            background: #fffefb;
            padding: 14px;
        }

        .meta {
            color: var(--muted);
            font-size: .9rem;
        }

        .field {
            display: grid;
            gap: 6px;
            margin-bottom: 10px;
        }

        label {
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"],
        textarea {
            width: 100%;
            border: 1px solid #dbc4a0;
            border-radius: 10px;
            padding: 10px;
            font-family: inherit;
            background: #fff;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .inline {
            display: inline;
        }

        img {
            max-width: 100%;
            border-radius: 10px;
            border: 1px solid var(--stroke);
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 820px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 1.35rem;
            }
        }
    </style>
    @endverbatim
</head>
<body>
    <div class="shell">
        <header class="topbar">
            <div class="brand">
                <strong>NexoDesk</strong>
                <small>Plataforma de reportes e incidencias</small>
            </div>

            <nav class="menu">
                @if(session('user_id'))
                    <a href="/dashboard">Dashboard</a>
                    <a href="/reportes">Incidencias</a>
                    <a href="/reportes/create">Nueva incidencia</a>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit">Cerrar sesion</button>
                    </form>
                @else
                    <a href="/login">Login</a>
                @endif
            </nav>
        </header>

        <section class="hero">
            <h1>@yield('page_heading', 'Gestion de incidencias en un solo lugar')</h1>
            <p>@yield('page_subheading', 'Accede a tu dashboard para revisar actividad, crear casos y dar seguimiento.') </p>

        </section>

        @if(session('error'))
            <div class="msg error">{{ session('error') }}</div>
        @endif

        @if(session('status'))
            <div class="msg ok">{{ session('status') }}</div>
        @endif

        <main class="content">
            @yield('content')
        </main>
    </div>
</body>
</html>

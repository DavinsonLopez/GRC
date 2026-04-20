<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion | NexoDesk</title>
    <style>
        :root {
            --bg-a: #f5efe2;
            --bg-b: #f9f5ee;
            --ink: #191815;
            --muted: #62574b;
            --brand: #b74b33;
            --brand-dark: #8f3724;
            --card: #fffdf8;
            --stroke: #e8d8bf;
            --shadow: 0 16px 40px rgba(73, 39, 22, 0.12);
            --danger-bg: #fde6de;
            --danger-ink: #7f2f1f;
            --ok-bg: #dff4de;
            --ok-ink: #225f1f;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 10%, #ffd9a8 0%, transparent 28%),
                radial-gradient(circle at 86% 16%, #ffb48a 0%, transparent 26%),
                linear-gradient(160deg, var(--bg-a) 0%, var(--bg-b) 65%);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            background: var(--card);
            border: 1px solid var(--stroke);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 22px;
        }

        h1 {
            margin: 0;
            font-size: 1.5rem;
        }

        .meta {
            margin-top: 8px;
            color: var(--muted);
        }

        .msg {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid;
        }

        .error {
            background: var(--danger-bg);
            color: var(--danger-ink);
            border-color: #f3baa9;
        }

        .ok {
            background: var(--ok-bg);
            color: var(--ok-ink);
            border-color: #abd8a9;
        }

        .field {
            display: grid;
            gap: 6px;
            margin-top: 12px;
        }

        label {
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 1px solid #dbc4a0;
            border-radius: 10px;
            padding: 10px;
            font-family: inherit;
            background: #fff;
        }

        .actions {
            margin-top: 14px;
        }

        button {
            border: 1px solid var(--brand-dark);
            background: var(--brand);
            color: #fff;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            width: 100%;
        }

        .back {
            margin-top: 12px;
            text-align: center;
        }

        .back a {
            color: var(--muted);
            text-decoration: none;
            font-size: .95rem;
        }

        .links {
            margin-top: 14px;
            display: grid;
            gap: 8px;
            text-align: center;
        }

        .links a {
            color: var(--muted);
            text-decoration: none;
            font-size: .95rem;
        }
    </style>
</head>
<body>
    <section class="login-card">
        <h1>Iniciar sesion</h1>
        <p class="meta">Accede para continuar al dashboard.</p>

        @if(session('error'))
            <div class="msg error">{{ session('error') }}</div>
        @endif

        @if(session('status'))
            <div class="msg ok">{{ session('status') }}</div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="usuario@empresa.com">
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Tu contrasena">
            </div>

            <div class="actions">
                <button type="submit">Entrar</button>
            </div>
        </form>

        <div class="links">
            <a href="/register">No tienes cuenta? Registrate</a>
        </div>

        <div class="back">
            <a href="/">Volver a inicio</a>
        </div>
    </section>
</body>
</html>

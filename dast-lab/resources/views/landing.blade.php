<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexoDesk | Plataforma de incidencias</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Space Grotesk", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 14%, #ffddb0 0%, transparent 30%),
                radial-gradient(circle at 88% 12%, #ffbe98 0%, transparent 27%),
                linear-gradient(160deg, var(--bg-a) 0%, var(--bg-b) 65%);
            min-height: 100vh;
        }

        .wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 20px 54px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: rgba(255, 252, 246, 0.8);
            border: 1px solid var(--stroke);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .logo {
            font-size: 1.05rem;
            font-weight: 700;
        }

        .login-btn {
            text-decoration: none;
            background: var(--brand);
            color: #fff;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid var(--brand-dark);
            font-weight: 600;
        }

        .hero {
            margin-top: 18px;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 16px;
        }

        .panel {
            background: var(--card);
            border: 1px solid var(--stroke);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 20px;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.7rem, 3vw, 2.5rem);
            line-height: 1.15;
        }

        p {
            color: var(--muted);
            line-height: 1.6;
        }

        .kpis {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 8px;
        }

        .kpi {
            border: 1px solid var(--stroke);
            border-radius: 12px;
            padding: 12px;
            background: #fff;
        }

        .kpi strong {
            display: block;
            font-size: 1.2rem;
        }

        .cta {
            margin-top: 16px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            border-radius: 999px;
            padding: 10px 14px;
            font-weight: 600;
            border: 1px solid var(--stroke);
            color: var(--ink);
            background: #fff8ee;
        }

        .btn-primary {
            background: var(--brand);
            border-color: var(--brand-dark);
            color: #fff;
        }

        .list {
            margin: 0;
            padding-left: 18px;
            color: var(--muted);
            line-height: 1.8;
        }

        @media (max-width: 850px) {
            .hero {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="top">
            <div class="logo">NexoDesk</div>
            <a class="login-btn" href="/login">Iniciar sesion</a>
        </header>

        <section class="hero">
            <article class="panel">
                <h1>Gestiona incidencias y reportes en un solo flujo</h1>
                <p>
                    NexoDesk centraliza la gestion de incidencias operativas para equipos internos.
                    Registra casos, agrega evidencias, comenta avances y mantén trazabilidad
                    desde un dashboard simple y claro.
                </p>

                <div class="kpis">
                    <div class="kpi">
                        <strong>Vista unificada</strong>
                        <span>Panel central para toda la operacion.</span>
                    </div>
                    <div class="kpi">
                        <strong>Seguimiento continuo</strong>
                        <span>Comentarios y actualizaciones por caso.</span>
                    </div>
                    <div class="kpi">
                        <strong>Evidencia adjunta</strong>
                        <span>Archivos y contexto en cada incidencia.</span>
                    </div>
                    <div class="kpi">
                        <strong>Flujo simple</strong>
                        <span>Login -> Dashboard -> Gestion de casos.</span>
                    </div>
                </div>

                <div class="cta">
                    <a class="btn btn-primary" href="/login">Comenzar ahora</a>
                </div>
            </article>

            <aside class="panel">
                <h2 style="margin-top:0;">Que puedes hacer</h2>
                <ul class="list">
                    <li>Registrar y priorizar incidencias.</li>
                    <li>Consultar el historial de cada caso.</li>
                    <li>Colaborar con comentarios del equipo.</li>
                    <li>Acceder rapidamente al dashboard.</li>
                </ul>
            </aside>
        </section>
    </div>
</body>
</html>

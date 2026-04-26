# Laboratorio DAST con Laravel 8

Este repositorio contiene un laboratorio de seguridad ofensiva/defensiva para observar y comparar resultados de pruebas DAST (Dynamic Application Security Testing) sobre la misma aplicacion en dos estados:

- `dast-lab`: version intencionalmente vulnerable.
- `dast-lab-seguro`: version corregida/asegurada para contrastar hallazgos.

El objetivo es ejecutar escaneos con herramientas como OWASP ZAP o Burp Suite y evidenciar:

- Que vulnerabilidades detecta el analisis dinamico en la app vulnerable.
- Que alertas disminuyen o desaparecen en la app segura.
- Como cambia la superficie de ataque despues de aplicar mitigaciones.

## Estructura del laboratorio

- `dast-lab/`
  - Proyecto Laravel 8 vulnerable para entrenamiento de seguridad.
- `dast-lab-seguro/`
  - Proyecto Laravel 8 con medidas de correccion para comparativa.

## Flujo recomendado de uso

1. Levanta primero `dast-lab` y ejecuta un escaneo DAST completo.
2. Documenta hallazgos (severidad, endpoint afectado, evidencia).
3. Levanta `dast-lab-seguro` con el mismo alcance de escaneo.
4. Compara resultados entre ambos reportes.
5. Concluye que controles reducen riesgo y cuales faltan.

## Ejecucion basica (cada proyecto)

Desde la carpeta del proyecto correspondiente:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Nota: Ajusta credenciales de base de datos en `.env` (PostgreSQL) antes de migrar.

## Alcance de pruebas DAST sugerido

- Flujos de autenticacion: registro, login, logout.
- CRUD de reportes.
- Comentarios en reportes.
- Endpoints web y API expuestos.
- Subida y acceso de archivos en `public/uploads`.

## Importante

Este entorno esta disenado exclusivamente para fines academicos y de entrenamiento en un ambiente local y controlado.

No debe exponerse a Internet ni utilizarse en produccion.

# Informe de Subsanacion de Seguridad (ZAP)

## 1. Contexto
Este documento describe los cambios aplicados en la copia endurecida del proyecto:

- Proyecto original (vulnerable): `dast-lab`
- Proyecto subsanado: `dast-lab-seguro`

Objetivo: reducir hallazgos detectados por OWASP ZAP (SQLi, XSS, CSRF, exposicion de datos, cabeceras de seguridad, etc.) sin romper el flujo funcional de la aplicacion.

## 2. Resumen ejecutivo
Se realizaron medidas de mitigacion en 4 capas:

1. Capa de autenticacion y sesion
2. Capa de autorizacion y logica de negocio
3. Capa de entrada/salida de datos (validacion y encoding)
4. Capa de hardening HTTP (cabeceras, CORS, debug)

Resultado esperado en ZAP:

- Disminucion significativa de alertas High/Medium.
- Eliminacion de hallazgos criticos previos (SQLi en login, XSS por render sin escape, CSRF en formularios clave, endpoint publico sensible).

## 3. Matriz de hallazgos -> subsanacion

### 3.1 SQL Injection (login)
- Hallazgo original: autenticacion con SQL concatenado.
- Subsanacion aplicada:
  - Se elimino query SQL manual.
  - Se usa consulta Eloquent por email + verificacion de hash (`Hash::check`).
- Archivo:
  - `app/Http/Controllers/AuthController.php`

### 3.2 XSS reflejado/persistente
- Hallazgo original: salida sin escape en vistas (`{!! !!}`) para titulo, descripcion y comentarios.
- Subsanacion aplicada:
  - Se reemplazo por salida escapada con `{{ }}`.
  - Se agrego validacion de longitud/tipo en entradas de comentarios y reportes.
- Archivos:
  - `resources/views/reportes/index.blade.php`
  - `resources/views/reportes/show.blade.php`
  - `resources/views/dashboard.blade.php`
  - `app/Http/Controllers/ComentarioController.php`
  - `app/Http/Controllers/ReporteController.php`

### 3.3 Ausencia de token Anti-CSRF
- Hallazgo original: formularios sensibles sin `@csrf` + URIs excluidas en middleware.
- Subsanacion aplicada:
  - Se removieron exclusiones inseguras en `VerifyCsrfToken`.
  - Se agrego `@csrf` en login, registro y comentarios.
- Archivos:
  - `app/Http/Middleware/VerifyCsrfToken.php`
  - `resources/views/auth/login.blade.php`
  - `resources/views/auth/register.blade.php`
  - `resources/views/reportes/show.blade.php`

### 3.4 Exposicion de datos sensibles (`/api/users`)
- Hallazgo original: endpoint publico retornando usuarios completos.
- Subsanacion aplicada:
  - Se protege endpoint con validacion de sesion.
  - Se restaura ocultamiento de `password` y `remember_token` en modelo.
- Archivos:
  - `routes/api.php`
  - `app/Models/User.php`

### 3.5 IDOR (acceso por ID sin control de propietario)
- Hallazgo original: acceso/edicion/eliminacion por id sin verificar pertenencia.
- Subsanacion aplicada:
  - Verificacion explicita de `user_id` propietario en `show`, `edit`, `update`, `destroy`.
  - Si no coincide: `403`.
- Archivo:
  - `app/Http/Controllers/ReporteController.php`

### 3.6 Subida de archivos insegura
- Hallazgo original: upload sin restricciones, nombre original y almacenamiento publico directo.
- Subsanacion aplicada:
  - Validacion de archivo: tipo (`jpg,jpeg,png,webp`) y tamano max (`2MB`).
  - Nombre aleatorio (`uniqid`) y almacenamiento por `Storage` en `public`.
- Archivo:
  - `app/Http/Controllers/ReporteController.php`

### 3.7 Broken Authentication / Session management
- Hallazgo original: token de sesion predecible y logout incompleto.
- Subsanacion aplicada:
  - Login: `session()->regenerate()`.
  - Logout: `invalidate()` + `regenerateToken()`.
  - Registro con hash de password (`Hash::make`).
- Archivo:
  - `app/Http/Controllers/AuthController.php`

### 3.8 Cabeceras HTTP faltantes o debiles (CSP, anti-clickjacking, sniffing, etc.)
- Hallazgo original: falta de cabeceras de hardening.
- Subsanacion aplicada:
  - Nuevo middleware global `SecureHeaders` con:
    - `Content-Security-Policy`
    - `X-Frame-Options: DENY`
    - `X-Content-Type-Options: nosniff`
    - `Referrer-Policy`
    - `Permissions-Policy`
    - `Cross-Origin-Resource-Policy`
    - `Cross-Origin-Opener-Policy`
    - HSTS condicional en HTTPS
  - Registro del middleware en `Kernel`.
- Archivos:
  - `app/Http/Middleware/SecureHeaders.php`
  - `app/Http/Kernel.php`

### 3.9 CORS demasiado permisivo
- Hallazgo original: `allowed_origins` y `allowed_headers` abiertos con `*`.
- Subsanacion aplicada:
  - Restriccion de origen a localhost.
  - Restriccion de metodos y headers.
- Archivo:
  - `config/cors.php`

### 3.10 Divulgacion de informacion por modo debug
- Hallazgo original: `APP_DEBUG=true`.
- Subsanacion aplicada:
  - `APP_DEBUG=false` en entorno subsanado.
- Archivo:
  - `.env`

### 3.11 Recursos externos sin SRI
- Hallazgo original: fuentes externas (Google Fonts) sin integridad.
- Subsanacion aplicada:
  - Eliminacion de dependencias de fuentes remotas.
  - Uso de fuentes del sistema.
- Archivos:
  - `resources/views/layouts/app.blade.php`
  - `resources/views/landing.blade.php`
  - `resources/views/auth/login.blade.php`

## 4. Lista de archivos modificados/creados

### 4.1 Archivos de backend
- `app/Http/Controllers/AuthController.php`
- `app/Http/Controllers/ReporteController.php`
- `app/Http/Controllers/ComentarioController.php`
- `app/Http/Middleware/VerifyCsrfToken.php`
- `app/Http/Middleware/SecureHeaders.php` (nuevo)
- `app/Http/Kernel.php`
- `app/Models/User.php`
- `routes/api.php`
- `config/cors.php`
- `.env`

### 4.2 Archivos de frontend (Blade)
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/reportes/index.blade.php`
- `resources/views/reportes/show.blade.php`
- `resources/views/dashboard.blade.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/landing.blade.php`

## 5. Verificacion tecnica realizada
Se ejecuto en `dast-lab-seguro`:

- `php artisan config:clear`
- `php artisan view:clear`
- `php artisan route:list`

Resultado: aplicacion operativa, sin errores de compilacion en vistas/controladores.

## 6. Instrucciones para re-escaneo en ZAP
1. Levantar proyecto subsanado.
2. URL base: `http://127.0.0.1:8000`.
3. Ejecutar Spider (anonimo + autenticado).
4. Ejecutar Active Scan sobre rutas:
   - `/login`
   - `/register`
   - `/dashboard`
   - `/reportes`
   - `/reportes/{id}`
   - `/api/users`
5. Comparar baseline vs re-escaneo por severidad y cantidad de alertas.

## 7. Alertas residuales posibles
Dependiendo de configuracion local de PHP/servidor y politicas de ZAP, pueden mantenerse alertas informativas o de baja severidad.

Ejemplo:
- `X-Powered-By` puede depender de `php.ini` (`expose_php=Off`) y no solo del codigo.
- Hallazgos tipo `GET for POST`, fingerprinting o metadata pueden persistir como informativos.

## 8. Conclusion
La copia `dast-lab-seguro` incorpora un set de controles base de seguridad para mitigar hallazgos tipicos de DAST, elevando sustancialmente el nivel de seguridad frente al proyecto original.
